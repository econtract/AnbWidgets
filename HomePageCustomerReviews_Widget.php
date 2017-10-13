<?php

namespace AnbWidgets;

/**
 * Class HomePageCustomerReviews_Widget
 * @package AnbWidgets
 */
class HomePageCustomerReviews_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'homePageCustomerReviews_Widget', // Base ID
			esc_html__( 'Home Page Customer Reviews', 'homePageCustomerReviews_widget_domain' ), // Name
			array( 'description' => esc_html__( 'Home Page Customer Reviews Widget', 'homePageCustomerReviews_widget_domain' ), ) // Args
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
                <div class='col-md-4'>
                    <div class='headingPanel'>
                        <div class='iconWrapper'>
                            <i class='fa fa-thumbs-o-up fa-5x'></i>
                        </div>
                        <div class='caption'>{$instance['title']}</div>
                        <h4>{$instance['tagline']}</h4>
                    </div>
                </div>
            
                <div class='col-md-7 col-md-offset-1'>
                    <ul class='row reviews-content'>
            
                        <li class='col-md-6'>
                            <h3>{$instance['review_text']}</h3>
                            <p>{$instance['review_description']}</p>
                            <span class='author-name'>{$instance['review_author']}</span>
                        </li>
            
                        <li class='col-md-6'>
                            <h3>{$instance['another_review_text']}</h3>
                            <p>{$instance['another_review_description']}</p>
                            <span class='author-name'>{$instance['another_review_author']}</span>
                        </li>
            
                    </ul>
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'homePageCustomerReviews_widget_domain' );
		$tagline = ! empty( $instance['tagline'] ) ? $instance['tagline'] : esc_html__( 'New tagline', 'homePageCustomerReviews_widget_domain' );
		$review_text = ! empty( $instance['review_text'] ) ? $instance['review_text'] : esc_html__( 'New Review Text', 'homePageCustomerReviews_widget_domain' );
		$review_description = ! empty( $instance['review_description'] ) ? $instance['review_description'] : esc_html__( 'New Review description', 'homePageCustomerReviews_widget_domain' );
        $review_author = ! empty( $instance['review_author'] ) ? $instance['review_author'] : esc_html__( 'New Review Text', 'homePageCustomerReviews_widget_domain' );
		$another_review_text = ! empty( $instance['another_review_text'] ) ? $instance['another_review_text'] : esc_html__( '', 'homePageCustomerReviews_widget_domain' );
		$another_review_description = ! empty( $instance['another_review_description'] ) ? $instance['another_review_description'] : esc_html__( 'Other Review description', 'homePageCustomerReviews_widget_domain' );
        $another_review_author = ! empty( $instance['another_review_author'] ) ? $instance['another_review_author'] : esc_html__( '', 'homePageCustomerReviews_widget_domain' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'homePageCustomerReviews_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tagline' ) ); ?>"><?php esc_attr_e( 'Tagline:', 'homePageCustomerReviews_widget_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tagline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tagline' ) ); ?>" type="text" value="<?php echo esc_attr( $tagline ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'review_text' ) ); ?>"><?php esc_attr_e( 'Review Text:', 'homePageCustomerReviews_widget_domain' ); ?>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'review_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'review_text' ) ); ?>" type="text" value="<?php echo esc_attr( $review_text ); ?>">
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'review_description' ) ); ?>"><?php esc_attr_e( 'Review Description:', 'homePageCustomerReviews_widget_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('review_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('review_description') ); ?>"><?php echo esc_html( $review_description ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'review_author' ) ); ?>"><?php esc_attr_e( 'Review Author:', 'homePageCustomerReviews_widget_domain' ); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'review_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'review_author' ) ); ?>" type="text" value="<?php echo esc_attr( $review_author ); ?>">
        </p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'another_review_text' ) ); ?>"><?php esc_attr_e( 'Other Review Text:', 'homePageCustomerReviews_widget_domain' ); ?>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'another_review_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'another_review_text' ) ); ?>" type="text" value="<?php echo esc_attr( $another_review_text ); ?>">
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'another_review_description' ) ); ?>"><?php esc_attr_e( 'Other Review Description:', 'homePageCustomerReviews_widget_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('another_review_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('another_review_description') ); ?>"><?php echo esc_html( $another_review_description ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'another_review_author' ) ); ?>"><?php esc_attr_e( 'Other Review Author:', 'homePageCustomerReviews_widget_domain' ); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'another_review_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'another_review_author' ) ); ?>" type="text" value="<?php echo esc_attr( $another_review_author ); ?>">
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
		$instance['tagline'] = ( ! empty( $new_instance['tagline'] ) ) ? strip_tags( $new_instance['tagline'] ) : '';
		$instance['review_text'] = ( ! empty( $new_instance['review_text'] ) ) ? strip_tags( $new_instance['review_text'] ) : '';
		$instance['review_description'] = ( ! empty( $new_instance['review_description'] ) ) ? strip_tags( $new_instance['review_description'] ) : '';
		$instance['another_review_text'] = ( ! empty( $new_instance['another_review_text'] ) ) ? strip_tags( $new_instance['another_review_text'] ) : '';
        $instance['review_author'] = ( ! empty( $new_instance['review_author'] ) ) ? strip_tags( $new_instance['review_author'] ) : '';
		$instance['another_review_description'] = ( ! empty( $new_instance['another_review_description'] ) ) ? strip_tags( $new_instance['another_review_description'] ) : '';
		$instance['another_review_author'] = ( ! empty( $new_instance['another_review_author'] ) ) ? strip_tags( $new_instance['another_review_author'] ) : '';


		return $instance;
	}
}
