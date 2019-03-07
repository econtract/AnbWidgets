<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/20/17
 * Time: 5:30 PM
 */

namespace AnbWidgets;


class Sector_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sector_widget', // Base ID
			esc_html__( 'Sector Widget', 'sector_widget_domain' ), // Name
			array( 'description' => esc_html__( 'A Sector Widget', 'sector_widget_domain' ), ) // Args
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
		if ( ! empty( $instance['title'] ) ) {
			//echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		//echo esc_html__( 'Hello, World!', 'sector_widget_domain' );

		echo "<li class='col-sm-6 col-md-3'>
                <div class='placeholder'>
                    <div class='save-badge'>
                        <span>".pll__($instance['badge_text'])."</span>
                        <span class='bold'>".pll__($instance['badge_cost'])."</span>
                    </div>
                    <div class='icon-wrapper'>
                        <svg class='svg-".$instance['image']."'> 
                            <use xlink:href='".get_bloginfo('template_url')."/images/svg-sprite.svg#svg-".$instance['image']."'></use> 
                        </svg>
                    </div>
                    <h2>".pll__($instance['title'])."</h2>
                    <p>".pll__($instance['description'])."</p>
                    <a href='".pll__($instance['btn_link'])."' class='btn btn-primary all-caps'>".pll__($instance['btn_label'])."</a>
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'sector_widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'sector_widget_domain' );
		$btnLabel = ! empty( $instance['btn_label'] ) ? $instance['btn_label'] : esc_html__( 'New label', 'sector_widget_domain' );
		$btnLink = ! empty( $instance['btn_link'] ) ? $instance['btn_link'] : esc_html__( '/contact-us', 'sector_widget_domain' );
		$badgeText = ! empty( $instance['badge_text'] ) ? $instance['badge_text'] : esc_html__( 'Save', 'sector_widget_domain' );
		$badgeCost = ! empty( $instance['badge_cost'] ) ? $instance['badge_cost'] : esc_html__( '100€', 'sector_widget_domain' );
		$image = ! empty( $instance['image'] ) ? $instance['image'] : esc_html__( 'Choose Image', 'sector_widget_domain' );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_attr_e( 'Image:', 'sector_widget_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>">
                <option value="energy" <?php if("energy" == $image){echo "selected";}?>><?php echo esc_html__( 'Energy', 'sector_widget_domain' )?></option>
                <option value="mobile" <?php if("mobile" == $image){echo "selected";}?>><?php echo esc_html__( 'Mobile', 'sector_widget_domain' )?></option>
                <option value="tv" <?php if("tv" == $image){echo "selected";}?>><?php echo esc_html__( 'Tv', 'sector_widget_domain' )?></option>
                <option value="all-services" <?php if("all-services" == $image){echo "selected";}?>><?php echo esc_html__( 'Move All Services', 'sector_widget_domain' )?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_label' ) ); ?>"><?php esc_attr_e( 'Button Label:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_label' ) ); ?>" type="text" value="<?php echo esc_attr( $btnLabel ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_link' ) ); ?>"><?php esc_attr_e( 'Button Link:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_link' ) ); ?>" type="text" value="<?php echo esc_attr( $btnLink ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'badge_text' ) ); ?>"><?php esc_attr_e( 'Badge Text:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'badge_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'badge_text' ) ); ?>" type="text" value="<?php echo esc_attr( $badgeText ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'badge_cost' ) ); ?>"><?php esc_attr_e( 'Badge Cost:', 'sector_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'badge_cost' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'badge_cost' ) ); ?>" type="text" value="<?php echo esc_attr( $badgeCost ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['btn_label'] = ( ! empty( $new_instance['btn_label'] ) ) ? strip_tags( $new_instance['btn_label'] ) : '';
		$instance['btn_link'] = ( ! empty( $new_instance['btn_link'] ) ) ? strip_tags( $new_instance['btn_link'] ) : '';
		$instance['badge_text'] = ( ! empty( $new_instance['badge_text'] ) ) ? strip_tags( $new_instance['badge_text'] ) : '';
		$instance['badge_cost'] = ( ! empty( $new_instance['badge_cost'] ) ) ? strip_tags( $new_instance['badge_cost'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';

		return $instance;
	}
}
