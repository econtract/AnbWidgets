<?php

namespace AnbWidgets;

/**
 * Class HomePageBanner_Widget
 * @package AnbWidgets
 */
class HomePageBanner_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'homePageBanner_widget', // Base ID
			esc_html__( 'Home Page Banner Widget Text', 'homePageBanner_widget_domain' ), // Name
			array( 'description' => esc_html__( 'Home Page Banner Widget Text Beneath Logo', 'homePageBanner_widget_domain' ), ) // Args
		);
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
		if ( ! empty( $instance['missionStatement'] ) ) {
			//echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo "<h1>".pll__($instance['missionStatement'])."</h1>
				<ul class='list-inline home-banner-list'>
                               <li><i class='icon-tick'></i> ".pll__($instance['attribute'])."</li>
                               <li><i class='icon-tick'></i> {$instance['attribute1']}</li>
                               <li><i class='icon-tick'></i> {$instance['attribute2']}</li>
               </ul>";

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return  it will save form
	 */
	public function form( $instance ) {
		$missionStatement = ! empty( $instance['missionStatement'] ) ? $instance['missionStatement'] : esc_html__( 'New Mission Statement', 'homePageBanner_widget_domain' );
		$attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : esc_html__( 'New Attribute', 'homePageBanner_widget_domain' );
		$attribute1 = ! empty( $instance['attribute1'] ) ? $instance['attribute1'] : esc_html__( 'New Attribute1', 'homePageBanner_widget_domain' );
		$attribute2 = ! empty( $instance['attribute2'] ) ? $instance['attribute2'] : esc_html__( 'New Attribute2', 'homePageBanner_widget_domain' );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'missionStatement' ) ); ?>"><?php esc_attr_e( 'Mission Statement:', 'homePageBanner_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'missionStatement' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'missionStatement' ) ); ?>" type="text" value="<?php echo esc_attr( $missionStatement ); ?>">
        </p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"><?php esc_attr_e( 'First Attribute Text:', 'homePageBanner_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>" type="text" value="<?php echo esc_attr( $attribute ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'attribute1' ) ); ?>"><?php esc_attr_e( 'Second Attribute Text:', 'homePageBanner_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'attribute1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'attribute1' ) ); ?>" type="text" value="<?php echo esc_attr( $attribute1 ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'attribute2' ) ); ?>"><?php esc_attr_e( 'Third Attribute Text:', 'homePageBanner_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'attribute2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'attribute2' ) ); ?>" type="text" value="<?php echo esc_attr( $attribute2 ); ?>">
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
		$instance['missionStatement'] = ( ! empty( $new_instance['missionStatement'] ) ) ? strip_tags( $new_instance['missionStatement'] ) : '';
		$instance['attribute'] = ( ! empty( $new_instance['attribute'] ) ) ? strip_tags( $new_instance['attribute'] ) : '';
		$instance['attribute1'] = ( ! empty( $new_instance['attribute1'] ) ) ? strip_tags( $new_instance['attribute1'] ) : '';
		$instance['attribute2'] = ( ! empty( $new_instance['attribute2'] ) ) ? strip_tags( $new_instance['attribute2'] ) : '';

		return $instance;
	}
}
