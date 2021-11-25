<?php

namespace Webhd\Helpers;

class Text {
	/**
	 * @param string $text
	 * @param int $limit
	 * @param bool $splitWords
	 * @param string $showMore
	 *
	 * @return string
	 */
	public static function excerpt( $text, int $limit = 55, $splitWords = true, $showMore = '...' ) {
		$text        = static::normalize( $text );
		$splitLength = $limit;
		if ( $splitWords ) {
			$splitLength = extension_loaded( 'intl' )
				? static::excerptIntlSplit( $text, $limit )
				: static::excerptSplit( $text, $limit );
		}
		$hiddenText = mb_substr( $text, $splitLength );
		if ( ! empty( $hiddenText ) ) {
			$text = ltrim( mb_substr( $text, 0, $splitLength ) ) . $showMore;
		}
		$text = nl2br( $text );
		$text = wptexturize( $text );
		$text = preg_replace( '/(\v|\s){1,}/u', ' ', $text ); // replace all multiple-space and carriage return characters with a space

		return $text;
	}

	/**
	 * @param string $text
	 *
	 * @return string
	 */
	public static function normalize( $text ): string {
		$allowedHtml         = wp_kses_allowed_html();
		$allowedHtml['mark'] = []; // allow using the <mark> tag to highlight text
		$text                = wp_kses( $text, $allowedHtml );
		$text                = strip_shortcodes( $text );
		$text                = excerpt_remove_blocks( $text ); // just in case...
		$text                = convert_smilies( $text );
		$text                = str_replace( ']]>', ']]&gt;', $text );
		$text                = preg_replace( '/(\v){2,}/u', '$1', $text );

		return $text;
	}

	/**
	 * @param string $text
	 *
	 * @return string
	 */
	public static function text( string $text ): string {
		$text = static::normalize( $text );
		$text = nl2br( $text );
		$text = wptexturize( $text );
		$text = preg_replace( '/(\v|\s){1,}/u', ' ', $text ); // replace all multiple-space and carriage return characters with a space

		return $text;
	}

	/**
	 * @param string $text
	 * @param int $limit
	 *
	 * @return int
	 */
	protected static function excerptIntlSplit( string $text, int $limit ): int {
		$words = \IntlRuleBasedBreakIterator::createWordInstance( '' );
		$words->setText( $text );
		$count = 0;
		foreach ( $words as $offset ) {
			if ( \IntlRuleBasedBreakIterator::WORD_NONE === $words->getRuleStatus() ) {
				continue;
			}
			++ $count;
			if ( $count != $limit ) {
				continue;
			}

			return $offset;
		}

		return strlen( $text );
	}

	/**
	 * @param string $text
	 * @param int $limit
	 *
	 * @return int
	 */
	protected static function excerptSplit( string $text, int $limit ): int {
		if ( str_word_count( $text, 0 ) > $limit ) {
			$words = array_keys( str_word_count( $text, 2 ) );

			return $words[ $limit ];
		}

		return strlen( $text );
	}
}