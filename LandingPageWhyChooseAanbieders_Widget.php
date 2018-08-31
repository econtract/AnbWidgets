<?php

namespace AnbWidgets;

/**
 * Class LandingPageQuickEntryPoints_Widget
 * @package AnbWidgets
 */
class LandingPageWhyChooseAanbieders_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'landingPageWhyChooseAanbieders_Widget', // Base ID
			esc_html__( 'Landing Page Why Choose Aanbieders Widget', 'landingPageWhyChooseAanbieders_Widget_domain' ), // Name
			array( 'description' => esc_html__( 'Landing Page Why Choose Aanbieders Widget', 'landingPageWhyChooseAanbieders_Widget_domain' ), ) // Args
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );
	}

	/**
	 * enqueue ajax scripts
	 */
	function enqueueScripts() {
	    //for image upload
        //wp_enqueue_media();
		wp_enqueue_script('media-upload');
		wp_enqueue_style('thickbox');
		// moved the js to an external file, you may want to change the path
		wp_enqueue_script( 'anbWidgets', plugins_url( '/js/widgets.js', __FILE__ ), array( 'jquery' ), '1.0' );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		echo "<div class='col-xs-12 col-sm-6 col-md-3 telecom-widget'>
					<div class='iconWrapper'>
						<img src='".esc_url($instance['image_uri'])."' alt='{$instance['title']}' />
					</div>
					<div class='whyaainbieder-content'>
					<h4>{$instance['title']}</h4>
					<p>{$instance['description']}</p>
					</div>
			</div>";

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return it will return form with default values
	 */
	public function form( $instance ) {
		$image_uri = ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : esc_html__( 'Choose image', 'landingPageWhyChooseAanbieders_Widget_domain' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'landingPageWhyChooseAanbieders_Widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'landingPageWhyChooseAanbieders_Widget_domain' );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_attr_e( 'Icon Image:', 'landingPageWhyChooseAanbieders_Widget_domain' ); ?></label>
            <input type="text" class="img widefat" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo esc_attr($image_uri); ?>" />
            <input type="button" class="select-img button" value="Select Image" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'landingPageWhyChooseAanbieders_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'landingPageWhyChooseAanbieders_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ) ? strip_tags( $new_instance['image_uri'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

		return $instance;
	}
}
