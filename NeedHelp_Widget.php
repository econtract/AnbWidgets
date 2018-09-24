<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/20/17
 * Time: 5:30 PM
 */

namespace AnbWidgets;


class NeedHelp_Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'need_help_widget', // Base ID
			esc_html__( 'Need Help Widget', 'need_help_widget_domain' ), // Name
			array( 'description' => esc_html__( 'A Need Help Widget', 'need_help_widget_domain' ), ) // Args
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );
	}

	/**
	 * enqueue ajax scripts
	 */
	function enqueueScripts() {
	    //for image upload
        //wp_enqueue_media();
		//wp_enqueue_script('media-upload');
		//wp_enqueue_style('thickbox');
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

		$clickWrapperStartHtml = '<div class="helpBox">';
		$clickWrapperEndHtml = '</div>';

		if($instance['icon'] == 'mail') {
		    $clickWrapperStartHtml = '<div class="helpBox" data-toggle="modal" data-target="#MailUs">';
			$clickWrapperEndHtml = '</div>';
        }

        if($instance['icon'] == 'call_waiting') {
            $clickWrapperStartHtml = '<div class="helpBox" data-toggle="modal" data-target="#CallBack">';
            $clickWrapperEndHtml = '</div>';
        }

		if($instance['icon'] == 'facebook') {
			$clickWrapperStartHtml .= '<a target="_blank" href="'.pll__('Facebook page link').'">';
			$clickWrapperEndHtml = '</a>' . $clickWrapperEndHtml;
		}

		/*if($instance['icon'] == 'mail') {
			$clickWrapperStartHtml = '<a href="'.pll__('Mail us email').'">';
			$clickWrapperEndHtml = '</a>';
		}*/

		$android = stripos($_SERVER['HTTP_USER_AGENT'], "android");
		$iphone = stripos($_SERVER['HTTP_USER_AGENT'], "iphone");
		$ipad = stripos($_SERVER['HTTP_USER_AGENT'], "ipad");

		if($instance['icon'] == 'whatsapp') {

			$clickWrapperStartHtml .= '<a target="_blank" href="https://web.whatsapp.com/send?phone='.pll__('Whatsapp number').'">';
			$clickWrapperEndHtml = '</a>' . $clickWrapperEndHtml;

			if($android !== false || $ipad !== false || $iphone !== false) {
				$clickWrapperStartHtml .= '<a href="https://api.whatsapp.com/send?phone='.pll__('Whatsapp number').'">';
				$clickWrapperEndHtml = '</a>' . $clickWrapperEndHtml;
            }
		}

		$titleHtml = '<p class="title toggle_chat">'.$instance['title'].'</p>';

		if($instance['icon'] == 'phone') {
			$clickWrapperStartHtml .= '<a href="tel:'.$instance['title'].'">';
			$clickWrapperEndHtml = '</a>' . $clickWrapperEndHtml;

			$titleHtml = '<p class="title toggle_chat">'.$instance['title'].'</p>';

			/*if($android !== false || $ipad !== false || $iphone !== false) {
				$titleHtml = '<p class="title toggle_chat"><a href="tel:'.$instance['title'].'">'.$instance['title'].'</a></p>';
			}*/
		}

        $triggerChatClass = '';

        if($instance['icon'] == 'comment') {
            $triggerChatClass = 'triggerChat';
        }

        echo '<div class="col-xs-12 col-sm-6 col-md-4 friendly-widget">
                '.$clickWrapperStartHtml.'
                <div class="iconWrapper">
                    <svg class="svg-'.$instance['icon'].'"> 
                        <use xlink:href="'.get_bloginfo('template_url').'/images/svg-sprite.svg#svg-'.$instance['icon'].'"></use> 
                    </svg>        
                </div>
                <div class="details '.$triggerChatClass.'">
                    '.$titleHtml.'
                    <p class="desc">'.$instance['content'].'</p>
                </div>
                '.$clickWrapperEndHtml.'
              </div>';

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
		$icon = ! empty( $instance['icon'] ) ? $instance['icon'] : esc_html__( 'Choose icon', 'need_help_widget_domain' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'need_help_widget_domain' );
		$content = ! empty( $instance['content'] ) ? $instance['content'] : esc_html__( 'Content', 'need_help_widget_domain' );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_attr_e( 'Icon:', 'need_help_widget_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>">
                <option value="comment" <?php if("comment" == $icon){echo "selected";}?>><?php echo esc_html__( 'Chat', 'need_help_widget_domain' )?></option>
                <option value="phone" <?php if("phone" == $icon){echo "selected";}?>><?php echo esc_html__( 'Phone', 'need_help_widget_domain' )?></option>
                <option value="mail" <?php if("mail" == $icon){echo "selected";}?>><?php echo esc_html__( 'Mail', 'need_help_widget_domain' )?></option>
                <option value="whatsapp" <?php if("whatsapp" == $icon){echo "selected";}?>><?php echo esc_html__( 'Whatsapp', 'need_help_widget_domain' )?></option>
                <option value="call_waiting" <?php if("call_waiting" == $icon){echo "selected";}?>><?php echo esc_html__( 'Call waiting', 'need_help_widget_domain' )?></option>
                <option value="facebook" <?php if("facebook" == $icon){echo "selected";}?>><?php echo esc_html__( 'Facebook', 'need_help_widget_domain' )?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'need_help_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_attr_e( 'Content:', 'need_help_widget_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" type="text" value="<?php echo esc_attr( $content ); ?>">
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
		$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';

		return $instance;
	}
}
