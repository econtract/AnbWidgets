<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/20/17
 * Time: 5:30 PM
 */

namespace AnbWidgets;


class HowItWorks_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'how_it_works_widget', // Base ID
			esc_html__( 'How It Works Widget', 'how_it_works_widget_domain' ), // Name
			array( 'description' => esc_html__( 'A How It Works Widget', 'how_it_works_widget_domain' ), ) // Args
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
		if ( ! empty( $instance['title'] ) ) {
			//echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		//echo esc_html__( 'Hello, World!', 'how_it_works_widget_domain' );

		echo "<li class='col-lg-3 col-sm-6'>
                <div class='iconWrapper'>
                <img src='".esc_url($instance['image_uri'])."' alt='{$instance['title']}' />
                </div>
                <div class='how-it-content'>
                <h4>{$instance['title']}</h4>
                <p>{$instance['description']}</p>
                <a href='".esc_url($instance['video_link'])."' title='{$instance['video_label']}' class='all-caps'>{$instance['video_label']}</a>
                </div>
              </li>";

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$image_uri = ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : esc_html__( 'Choose image', 'how_it_works_widget_domain' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'how_it_works_widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'how_it_works_widget_domain' );
		$videoLbl = ! empty( $instance['video_label'] ) ? $instance['video_label'] : esc_html__( 'Video Label', 'how_it_works_widget_domain' );
		$videoLink = ! empty( $instance['video_link'] ) ? $instance['video_link'] : esc_html__( '#', 'how_it_works_widget_domain' );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_attr_e( 'Icon Image:', 'how_it_works_widget_domain' ); ?></label>
            <input type="text" class="img widefat" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo esc_attr($image_uri); ?>" />
            <input type="button" class="select-img button" value="Select Image" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'how_it_works_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'how_it_works_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'video_label' ) ); ?>"><?php esc_attr_e( 'Video Label:', 'how_it_works_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_label' ) ); ?>" type="text" value="<?php echo esc_attr( $videoLbl ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'video_link' ) ); ?>"><?php esc_attr_e( 'Video Link:', 'how_it_works_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_link' ) ); ?>" type="text" value="<?php echo esc_attr( $videoLink ); ?>">
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
		$instance['video_label'] = ( ! empty( $new_instance['video_label'] ) ) ? strip_tags( $new_instance['video_label'] ) : '';
		$instance['video_link'] = ( ! empty( $new_instance['video_link'] ) ) ? strip_tags( $new_instance['video_link'] ) : '';

		return $instance;
	}
}
