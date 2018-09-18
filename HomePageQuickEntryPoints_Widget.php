<?php

namespace AnbWidgets;

/**
 * Class HomePageQuickEntryPoints_Widget
 * @package AnbWidgets
 */
class HomePageQuickEntryPoints_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'homePageQuickEntryPoints_Widget', // Base ID
			esc_html__( 'Home Page Quick Entry Points Widget', 'homePageQuickEntryPoints_Widget_domain' ), // Name
			array( 'description' => esc_html__( 'Home Page Quick Entry Points Widget', 'homePageQuickEntryPoints_Widget_domain' ), ) // Args
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

		echo "<div class='col-xs-12 col-sm-4 col-md-4'>
				<div class='entryPoint'>
					<div class='iconWrapper'>
						<img src='".esc_url($instance['image_uri'])."' alt='".pll__($instance['title'])."' />
					</div>
					<h3>".pll__($instance['title'])."</h3>
					<p>".pll__($instance['description'])."</p>
					 <a href='".esc_url(pll__($instance['page_link']))."' title='".pll__($instance['label'])."' class='all-caps btn btn-primary'>".pll__($instance['label'])."</a>
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
		$image_uri = ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : esc_html__( 'Choose image', 'homePageQuickEntryPoints_Widget_domain' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'homePageQuickEntryPoints_Widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'homePageQuickEntryPoints_Widget_domain' );
		$label = ! empty( $instance['label'] ) ? $instance['label'] : esc_html__( 'Button Label', 'homePageQuickEntryPoints_Widget_domain' );
		$pageLink = ! empty( $instance['page_link'] ) ? $instance['page_link'] : esc_html__( '#', 'homePageQuickEntryPoints_Widget_domain' );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_attr_e( 'Icon Image:', 'homePageQuickEntryPoints_Widget_domain' ); ?></label>
            <input type="text" class="img widefat" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo esc_attr($image_uri); ?>" />
            <input type="button" class="select-img button" value="Select Image" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'homePageQuickEntryPoints_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'homePageQuickEntryPoints_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_attr_e( 'Button Label:', 'homePageQuickEntryPoints_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'page_link' ) ); ?>"><?php esc_attr_e( 'Button Link:', 'homePageQuickEntryPoints_Widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_link' ) ); ?>" type="text" value="<?php echo esc_attr( $pageLink ); ?>">
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
		$instance['label'] = ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';
		$instance['page_link'] = ( ! empty( $new_instance['page_link'] ) ) ? strip_tags( $new_instance['page_link'] ) : '';

		return $instance;
	}
}
