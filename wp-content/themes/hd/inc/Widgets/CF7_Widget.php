<?php

namespace Webhd\Widgets;

use Webhd\Helpers\Cast;
use Webhd\Helpers\Str;

if (!class_exists('Cf7_Widget')) {
	class Cf7_Widget extends Widget
	{
		/**
		 * {@inheritdoc}
		 */
		protected function widgetName()
		{
			return __('W - CF7 Form', 'hd');
		}

		/**
		 * {@inheritdoc}
		 */
		protected function widgetDescription()
		{
            return __('Contact Form 7 + Custom Fields', 'hd');
		}

		/**
		 * @param array $args
		 * @param array $instance
		 */
		public function widget($args, $instance)
		{
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = (!empty($instance['title'])) ? $instance['title'] : '';
			$title = apply_filters('widget_title', $title, $instance, $this->id_base);

			// ACF attributes
			$ACF = $this->acf_fields('widget_' . $args['widget_id']);
			if (is_null($ACF)) {
				wp_die(__('Required: "Advanced Custom Fields" plugin', 'hd'));
			}

			// class
			$_class = $this->id;
			if ($ACF->css_class) {
				$_class = $_class . ' ' . $ACF->css_class;
			}
			?>
            <section class="section cf7-section <?= $_class ?>">
                <div class="grid-container">
					<?php
					if ($title) : ?>
                        <h2 class="heading-title"><?php echo $title; ?></h2>
					<?php endif;
					if (Str::stripSpace($ACF->html_title)) :
						echo $ACF->html_title;
					endif;
					if (Str::stripSpace($ACF->html_desc)) :
						echo '<div class="desc">';
						echo $ACF->html_desc;
						echo '</div>';
					endif;
					if ($ACF->form) :
						$form = get_post($ACF->form);
						echo do_shortcode('[contact-form-7 id="' . $form->ID . '" title="' . esc_attr($form->post_title) . '"]');
					endif;
					?>
                </div>
            </section>
			<?php
		}

		/**
		 * Outputs the settings update form.
		 *
		 * @since 2.8.0
		 *
		 * @param array $instance Current settings.
		 * @return void
		 */
		public function form($instance)
		{
			$instance = wp_parse_args(
				Cast::toArray($instance),
				[
					'title' => '',
				]
			);
			$this->widgetArgs = $instance;
			?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'hd'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>
			<?php
		}

		/**
		 * @param array $newInstance
		 * @param array $oldInstance
		 * @return array
		 */
		public function update($newInstance, $oldInstance)
        {
			$newInstance['title'] = sanitize_text_field($newInstance['title']);
			return parent::update($newInstance, $oldInstance);
		}
	}
}