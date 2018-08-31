<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/20/17
 * Time: 5:30 PM
 */

namespace AnbWidgets;


class ThankyouPageNextSteps_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'thankyoupage_nextsteps_widget', // Base ID
			esc_html__( 'Thankyou page next steps Widget', 'thankyoupage_nextsteps_widget_domain' ), // Name
			array( 'description' => esc_html__( 'A Thankyou page next steps Widget', 'thankyoupage_nextsteps_widget_domain' ), ) // Args
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
		//echo esc_html__( 'Hello, World!', 'thankyoupage_nextsteps_widget_domain' );
        $linkHtml = '';

		if(!empty($instance['link_label'])) {
		    $linkHtml = "<a href='".pll__($instance['link_url'])."'>".pll__($instance['link_label'])."</a>";
        }

		echo "<li>
                <i class='fa fa-".pll__($instance['image'])."'></i>
                <h3>".pll__($instance['title'])."</h3>
                <p>".pll__($instance['description'])."</p>
                <a href='".pll__($instance['link_url'])."'>".pll__($instance['link_label'])."</a>
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'thankyoupage_nextsteps_widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'thankyoupage_nextsteps_widget_domain' );
		$btnLabel = ! empty( $instance['link_label'] ) ? $instance['link_label'] : esc_html__( '', 'thankyoupage_nextsteps_widget_domain' );
		$btnLink = ! empty( $instance['link_url'] ) ? $instance['link_url'] : esc_html__( '', 'thankyoupage_nextsteps_widget_domain' );
		$image = ! empty( $instance['image'] ) ? $instance['image'] : esc_html__( '', 'thankyoupage_nextsteps_widget_domain' );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'thankyoupage_nextsteps_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_attr_e( 'Image:', 'thankyoupage_nextsteps_widget_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>">
                <option value="" <?php if(empty($image)){echo "selected";}?>><?php echo esc_html__( 'No Icon', 'thankyoupage_nextsteps_widget_domain' )?></option>
                <option value="check" <?php if("check" == $image){echo "selected";}?>><?php echo esc_html__( 'Tick', 'thankyoupage_nextsteps_widget_domain' )?></option>
                <option value="comment" <?php if("comment" == $image){echo "selected";}?>><?php echo esc_html__( 'Comment', 'thankyoupage_nextsteps_widget_domain' )?></option>
                <option value="gears" <?php if("gears" == $image){echo "selected";}?>><?php echo esc_html__( 'Settings', 'thankyoupage_nextsteps_widget_domain' )?></option>
                <option value="credit-card-alt" <?php if("credit-card-alt" == $image){echo "selected";}?>><?php echo esc_html__( 'Card', 'thankyoupage_nextsteps_widget_domain' )?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'thankyoupage_nextsteps_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_label' ) ); ?>"><?php esc_attr_e( 'Link Label:', 'thankyoupage_nextsteps_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_label' ) ); ?>" type="text" value="<?php echo esc_attr( $btnLabel ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>"><?php esc_attr_e( 'Link Url:', 'thankyoupage_nextsteps_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url' ) ); ?>" type="text" value="<?php echo esc_attr( $btnLink ); ?>">
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
		$instance['link_label'] = ( ! empty( $new_instance['link_label'] ) ) ? strip_tags( $new_instance['link_label'] ) : '';
		$instance['link_url'] = ( ! empty( $new_instance['link_url'] ) ) ? strip_tags( $new_instance['link_url'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';

		return $instance;
	}
}
