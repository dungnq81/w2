<?php

namespace Webhd\Helpers;

class Str
{
    /**
     * @param string $string
     * @return string
     */
    public static function camelCase(string $string): string {
        $string = ucwords(str_replace(['-', '_'], ' ', trim($string)));
        return str_replace(' ', '', $string);
    }

    /**
     * @param string $path
     * @param string $prefix
     * @return string
     */
    public static function convertPathToName(string $path, string $prefix = ''): string {
        $levels = explode('.', $path);
        return array_reduce($levels, function ($result, $value) {
            return $result .= '[' . $value . ']';
        }, $prefix);
    }

    /**
     * @param string $path
     * @param string $prefix
     * @return string
     */
    public static function convertPathToId(string $path, string $prefix = ''): string {
        return str_replace(['[', ']'], ['-', ''], static::convertPathToName($path, $prefix));
    }

    /**
     * @param string $name
     * @param string $initialPunctuation
     * @return string
     */
    public static function convertToInitials(string $name, string $initialPunctuation = ''): string {
        preg_match_all('/(?<=\s|\b)\pL/u', $name, $matches);
        $result = array_reduce($matches[0], function ($carry, $word) use ($initialPunctuation) {
            $initial = mb_substr($word, 0, 1, 'UTF-8');
            $initial = mb_strtoupper($initial, 'UTF-8');
            return $carry . $initial . $initialPunctuation;
        });
        return trim($result);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function dashCase(string $string): string {
        return str_replace('_', '-', static::snakeCase($string));
    }

    /**
     * @param int $length
     * @return string
     */
    public static function random(int $length = 8): string {
        $text = base64_encode(wp_generate_password());
        return substr(str_replace(['/', '+', '='], '', $text), 0, $length);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function snakeCase(string $string): string {
        if (!ctype_lower($string)) {
            $string = preg_replace('/\s+/u', '', $string);
            $string = preg_replace('/(.)(?=[A-Z])/u', '$1_', $string);
            $string = mb_strtolower($string, 'UTF-8');
        }
        return str_replace('-', '_', $string);
    }

    /**
     * @param string $string
     * @param string $prefix
     * @param string|null $trim
     * @return string
     */
    public static function prefix(string $string, string $prefix, $trim = null): ?string {
        if ('' === $string) {
            return $string;
        }
        if (null === $trim) {
            $trim = $prefix;
        }
        return $prefix . trim(static::removePrefix($string, $trim));
    }

    /**
     * @param string $prefix
     * @param string $string
     * @return string
     */
    public static function removePrefix(string $string, string $prefix): string {
        return static::startsWith($prefix, $string)
            ? substr($string, strlen($prefix))
            : $string;
    }

    /**
     * @param string|string[] $needles
     * @param string $haystack
     * @return bool
     */
    public static function startsWith($needles, $haystack): bool {
        $needles = array_filter(Cast::toArray($needles), 'is_not_empty');
        foreach ($needles as $needle) {
            if (substr($haystack, 0, strlen(Cast::toString($needle))) === $needle) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string|string[] $needles
     * @param string $haystack
     * @return bool
     */
    public static function endsWith($needles, $haystack): bool {
        $needles = array_filter(Cast::toArray($needles), 'is_not_empty');
        foreach ($needles as $needle) {
            if (substr($haystack, -strlen(Cast::toString($needle))) === $needle) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $string
     * @param string $suffix
     * @return string
     */
    public static function suffix($string, $suffix): string {
        if (!static::endsWith($suffix, $string)) {
            return $string . $suffix;
        }
        return $string;
    }

    /**
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    public static function replaceFirst($search, $replace, $subject): string {
        if ($search == '') {
            return $subject;
        }
        $position = strpos($subject, $search);
        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }
        return $subject;
    }

    /**
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    public static function replaceLast($search, $replace, $subject): string {
        $position = strrpos($subject, $search);
        if ('' !== $search && false !== $position) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }
        return $subject;
    }

    /**
     * Strpos over an array.
     *
     * @param $haystack
     * @param $needles
     * @param int $offset
     *
     * @return bool
     */
    public static function strposOffset($haystack, $needles, int $offset = 0): bool {
        if (!is_array($needles)) {
            $needles = array($needles);
        }

        foreach ($needles as $query) {
            if (strpos($haystack, $query, $offset) !== false) {
                // stop on first true result.
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function titleCase($string): string {
        $value = str_replace(['-', '_'], ' ', $string);
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * Keywords
     *
     * Takes multiple words separated by spaces and changes them to keywords
     * Makes sure the keywords are separated by a comma followed by a space.
     *
     * @param string $str The keywords as a string, separated by whitespace.
     *
     * @return string The list of keywords in a comma separated string form.
     */
    public static function keyWords(string $str): string {
        $str = preg_replace('/(\v|\s){1,}/u', ' ', $str);
        return preg_replace('/[\s]+/', ', ', trim($str));
    }

    /**
     * @param string $value
     * @param int $length
     * @param string $end
     * @return string
     */
    public static function truncate($value, $length, $end = ''): string {
        return mb_strwidth($value, 'UTF-8') > $length
            ? mb_substr($value, 0, $length, 'UTF-8') . $end
            : $value;
    }

	/**
	 * @param $string
	 *
	 * @return array|string|string[]|null
	 */
    public static function stripSpace($string)
    {
        $string = preg_replace(
            '/(\v|\s){1,}/u',
            '',
            $string
        );
        //$string = preg_replace('/\s+/', '', $string);
        $string = preg_replace('~\x{00a0}~', '', $string);
        return $string;
    }
}