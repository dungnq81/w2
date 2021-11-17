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
			return __('W - CF7 Form', W_TEXTDOMAIN);
		}

		/**
		 * {@inheritdoc}
		 */
		protected function widgetDescription()
		{
			return __('Contact Form 7 + Custom Fields', W_TEXTDOMAIN);
		}

		/**
		 * @param string $id
		 */
		private function _acf_fields($id)
		{
			$_acf = function_exists('get_field') ? true : false;
			return (object) [
				'html_title' => $_acf ? get_field('html_title', $id) : '',
				'html_desc' => $_acf ? get_field('html_desc', $id) : '',
				'css_class' => $_acf ? get_field('css_class', $id) : '',
				'form' => $_acf ? get_field('form', $id) : '',
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
					if (Str::stripSpace($ACF->html_title)) : ?>
						<?php echo $ACF->html_title; ?>
					<?php endif;
					if (Str::stripSpace($ACF->html_desc)) : ?>
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
		 * @param array $instance
		 *
		 * @return string|void
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
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', W_TEXTDOMAIN); ?></label>
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
