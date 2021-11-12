<?php

namespace Webhd\Widgets;


if (!class_exists('CF7Widget')) {
	class CF7Widget extends Widget
	{
		public function __construct()
		{
			$widget_ops = array(
				'classname'                   => 'cf7_widget',
				'description'                 => __('Contact Form 7', W_TEXTDOMAIN),
				'customize_selective_refresh' => true,
			);

			parent::__construct('cf7-widget', __('W - CF7 Form', W_TEXTDOMAIN), $widget_ops);
		}

		/**
		 * @param string $id
		 */
		private function _acf_fields($id)
		{
			return (object) [
				'html_title' => get_field('html_title', $id),
				'html_desc' => get_field('html_desc', $id),
				'css_class' => get_field('css_class', $id),
				'form' => get_field('form', $id),
			];
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
			$ACF = $this->_acf_fields('widget_' . $args['widget_id']);

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
					if (strip_whitespace($ACF->html_title)) : ?>
						<?php echo $ACF->html_title; ?>
					<?php endif;
					if (strip_whitespace($ACF->html_desc)) : ?>
						<?php echo $ACF->html_desc; ?>
					<?php endif; ?>
					<?php
					if ($ACF->form) {
						$form = get_post($ACF->form);
						echo do_shortcode('[contact-form-7 id="' . $form->ID . '" title="' . esc_attr($form->post_title) . '"]');
					}
					?>
				</div>
			</section>
		<?php
		}

		/**
		 * @param array $new_instance
		 * @param array $old_instance
		 *
		 * @return array
		 */
		public function update($new_instance, $old_instance)
		{
			$instance              = $old_instance;
			$instance['title']     = sanitize_text_field($new_instance['title']);
			return $instance;
		}

		/**
		 * @param array $instance
		 *
		 * @return string|void
		 */
		public function form($instance)
		{
			$instance = wp_parse_args((array) $instance, array('title' => ''));
			$title    = $instance['title'];
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', W_TEXTDOMAIN); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
<?php
		}
	}
}
