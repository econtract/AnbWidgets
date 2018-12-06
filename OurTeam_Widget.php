<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/20/17
 * Time: 5:30 PM
 */

namespace AnbWidgets;


class OurTeam_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'our_team_widget', // Base ID
			esc_html__( 'Our Team Widget', 'our_team_widget_domain' ), // Name
			array( 'description' => esc_html__( 'A Our Team Widget', 'our_team_widget_domain' ), ) // Args
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
		//echo esc_html__( 'Hello, World!', 'our_team_widget_domain' );

		echo '<li class="col-md-4 col-sm-6">
                    <div class="placeholder">
                        <img src="'.esc_url($instance['image_uri']).'" alt="'.$instance['name'].'" />
                        <div class="about-team-member">
                            <h4>'.$instance['name'].'</h4>
                            <p>'.$instance['job_title'].'</p>
                            <a class="btn btn-outline" title="contact" href="#" data-toggle="modal" data-target="#MailUs">contact '.explode(' ', $instance['name'])[0].'</a>
                        </div>
                    </div>
                </li>';

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
		$image_uri = ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : esc_html__( 'Choose image', 'our_team_widget_domain' );
		$name = ! empty( $instance['name'] ) ? $instance['name'] : esc_html__( 'Name', 'our_team_widget_domain' );
		$jobTitle = ! empty( $instance['job_title'] ) ? $instance['job_title'] : esc_html__( 'Job title', 'our_team_widget_domain' );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_attr_e( 'Picture:', 'our_team_widget_domain' ); ?></label>
            <input type="text" class="img widefat" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo esc_attr($image_uri); ?>" />
            <input type="button" class="select-img button" value="Select Picture" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_attr_e( 'Name:', 'our_team_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'job_title' ) ); ?>"><?php esc_attr_e( 'Job Title:', 'our_team_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'job_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'job_title' ) ); ?>" type="text" value="<?php echo esc_attr( $jobTitle ); ?>">
        </p>
        <?php /*?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'video_link' ) ); ?>"><?php esc_attr_e( 'Video Link:', 'our_team_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_link' ) ); ?>" type="text" value="<?php echo esc_attr( $videoLink ); ?>">
        </p>
		<?php
        */
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
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['job_title'] = ( ! empty( $new_instance['job_title'] ) ) ? strip_tags( $new_instance['job_title'] ) : '';

		return $instance;
	}
}
