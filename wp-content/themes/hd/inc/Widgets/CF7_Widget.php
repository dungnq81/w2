<?php

namespace Webhd\Widgets;

use Webhd\Helpers\Cast;
use Webhd\Helpers\Str;

if ( ! class_exists( 'Cf7_Widget' ) ) {
	class Cf7_Widget extends Widget {
		public function __construct() {
			parent::__construct();

			$this->_localFields();
		}

		/**
		 * {@inheritdoc}
		 */
		protected function widgetName() {
			return __( 'W - CF7 Form', 'hd' );
		}

		/**
		 * {@inheritdoc}
		 */
		protected function widgetDescription() {
			return __( 'Contact Form 7 + Custom Fields', 'hd' );
		}

		/**
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			// ACF attributes
			$ACF = $this->acfFields( 'widget_' . $args['widget_id'] );
			if ( is_null( $ACF ) ) {
				wp_die( __( 'Required: "Advanced Custom Fields" plugin', 'hd' ) );
			}

			// class
			$_class = $this->id;
			if ( $ACF->css_class ) {
				$_class = $_class . ' ' . $ACF->css_class;
			}

			?>
            <section class="section cf7-section <?= $_class ?>">
                <div class="grid-container">
					<?php
					if ( $title ) : ?>
                        <h2 class="heading-title"><?php echo $title; ?></h2>
					<?php endif;
					if ( Str::stripSpace( $ACF->html_title ) ) :
						echo $ACF->html_title;
					endif;
					if ( Str::stripSpace( $ACF->html_desc ) ) :
						echo '<div class="desc">';
						echo $ACF->html_desc;
						echo '</div>';
					endif;
					if ( $ACF->form ) :
						$form = get_post( $ACF->form );
						echo do_shortcode( '[contact-form-7 id="' . $form->ID . '" title="' . esc_attr( $form->post_title ) . '"]' );
					endif;
					?>
                </div>
            </section>
			<?php
		}

		/**
		 * Outputs the settings update form.
		 *
		 * @param array $instance Current settings.
		 *
		 * @return void
		 * @since 2.8.0
		 *
		 */
		public function form( $instance ) {
			$instance         = wp_parse_args(
				Cast::toArray( $instance ),
				[
					'title' => '',
				]
			);
			$this->widgetArgs = $instance;
			?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'hd' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
            </p>
			<?php
		}

		/**
		 * @param array $newInstance
		 * @param array $oldInstance
		 *
		 * @return array
		 */
		public function update( $newInstance, $oldInstance ) {
			$newInstance['title'] = sanitize_text_field( $newInstance['title'] );

			return parent::update( $newInstance, $oldInstance );
		}

		/**
		 * @retun void
		 */
		private function _localFields() {
			if ( ! class_exists( '\ACF' ) ) {
				return;
			}

			acf_add_local_field_group( [
				'key'                   => 'group_6186a90559be7',
				//'title'                 => __( 'CF7 - Widget', 'hd' ),
				'fields'                => [
					[
						'key'               => 'field_6186a924e6986',
						'label'             => __( 'Title extended', 'hd' ),
						'name'              => 'html_title',
						'type'              => 'wysiwyg',
						'required'          => 0,
						'conditional_logic' => 0,
						'default_value'     => '',
						'tabs'              => 'text',
						'media_upload'      => 0,
						'toolbar'           => 'minimal',
						'delay'             => 0,
					],
					[
						'key'               => 'field_619607d46e816',
						'label'             => __( 'Description', 'hd' ),
						'name'              => 'html_desc',
						'type'              => 'wysiwyg',
						'required'          => 0,
						'conditional_logic' => 0,
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'minimal',
						'media_upload'      => 0,
						'delay'             => 0,
					],
					[
						'key'               => 'field_6186a939e6987',
						'label'             => __( 'Form', 'hd' ),
						'name'              => 'form',
						'type'              => 'post_object',
						'required'          => 0,
						'conditional_logic' => 0,
						'post_type'         => [
							0 => 'wpcf7_contact_form',
						],
						'taxonomy'          => '',
						'allow_null'        => 1,
						'multiple'          => 0,
						'return_format'     => 'id',
						'ui'                => 1,
					],
					[
						'key'               => 'field_6186a98ae6988',
						'label'             => __( 'CSS Class', 'hd' ),
						'name'              => 'css_class',
						'type'              => 'text',
						'required'          => 0,
						'conditional_logic' => 0,
						'default_value'     => '',
						'placeholder'       => '',
					],
				],
				'location'              => [
					[
						[
							'param'    => 'widget',
							'operator' => '==',
							'value'    => 'w-cf7',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'field',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 1,
			] );
		}
	}
}