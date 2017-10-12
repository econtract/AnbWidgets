<?php

namespace AnbWidgets;

/**
 * Class HomePageBudget_Widget
 * @package AnbWidgets
 */
class HomePageBudget_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'homePageBudget_Widget', // Base ID
			esc_html__( 'Home Page Budget', 'homePageBudget_widget_domain' ), // Name
			array( 'description' => esc_html__( 'Home Page Budget Widget', 'homePageBudget_widget_domain' ), ) // Args
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
		echo "<div class='row'>
                           <div class='col-md-6'>
                               <div class='budget-control-content'>
                                   <div class='icon-wrapper'>
                                       <img src='".get_template_directory_uri()."/images/common/icons/home-page/line-chart.png' alt=''>
                                   </div>
                                   <h6>{$instance['tagline']}</h6>
                                   <h1>{$instance['text_left']}</h1>
                               </div>
                           </div>

                           <div class='col-md-6'>
                               <div class='yearly-saving-content'>
                                   <h1>{$instance['text_right']}</h1>
                                   <p>{$instance['description']}</p>
                                   <a href='{$instance['btn_link']}' class='btn btn-outline all-caps'>{$instance['btn_text']}</a>
                               </div>
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

		$tagline = ! empty( $instance['tagline'] ) ? $instance['tagline'] : esc_html__( 'New tagline', 'homePageBudget_widget_domain' );
		$text_left = ! empty( $instance['text_left'] ) ? $instance['text_left'] : esc_html__( 'New text left', 'homePageBudget_widget_domain' );
		$text_right = ! empty( $instance['text_right'] ) ? $instance['text_right'] : esc_html__( 'New text right', 'homePageBudget_widget_domain' );
		$btnText = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : esc_html__( 'New Button Text', 'homePageBudget_widget_domain' );
		$btnLink = ! empty( $instance['btn_link'] ) ? $instance['btn_link'] : esc_html__( '/', 'homePageBudget_widget_domain' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'New description', 'homePageBudget_widget_domain' );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tagline' ) ); ?>"><?php esc_attr_e( 'Tagline:', 'homePageBudget_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tagline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tagline' ) ); ?>" type="text" value="<?php echo esc_attr( $tagline ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_left' ) ); ?>"><?php esc_attr_e( 'Text Left:', 'homePageBudget_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_left' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_left' ) ); ?>" type="text" value="<?php echo esc_attr( $text_left ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_right' ) ); ?>"><?php esc_attr_e( 'Text Right:', 'homePageBudget_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_right' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_right' ) ); ?>" type="text" value="<?php echo esc_attr( $text_right ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php esc_attr_e( 'Button Text:', 'homePageBudget_widget_domain' ); ?>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" type="text" value="<?php echo esc_attr( $btnText ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn_link' ) ); ?>"><?php esc_attr_e( 'Button Link:', 'homePageBudget_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_link' ) ); ?>" type="text" value="<?php echo esc_attr( $btnLink ); ?>">
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'homePageBudget_widget_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>"><?php echo esc_html( $description ); ?></textarea>
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
		$instance['tagline'] = ( ! empty( $new_instance['tagline'] ) ) ? strip_tags( $new_instance['tagline'] ) : '';
		$instance['text_left'] = ( ! empty( $new_instance['text_left'] ) ) ? strip_tags( $new_instance['text_left'] ) : '';
		$instance['text_right'] = ( ! empty( $new_instance['text_right'] ) ) ? strip_tags( $new_instance['text_right'] ) : '';
		$instance['btn_link'] = ( ! empty( $new_instance['btn_link'] ) ) ? strip_tags( $new_instance['btn_link'] ) : '';
		$instance['btn_text'] = ( ! empty( $new_instance['btn_text'] ) ) ? strip_tags( $new_instance['btn_text'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

		return $instance;
	}
}
