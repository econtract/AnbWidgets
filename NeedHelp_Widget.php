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
    public function widget($args, $instance)
    {
        $icon = 'abf abf-' . $instance['icon'];

        switch ($instance['icon']) {
            case 'mail':
                $args['before_widget'] .= '<a href="javascript:;" data-toggle="modal" data-target="#MailUs">';
                $args['after_widget']  = '</a>' . $args['after_widget'];
                break;
            case 'call_waiting':
                $args['before_widget'] .= '<a href="javascript:;" data-toggle="modal" data-target="#CallBack">';
                $args['after_widget']  = '</a>' . $args['after_widget'];
                $icon                  = 'abf abf-phone-callback';
                break;
            case 'facebook':
                $args['before_widget'] .= '<a target="_blank" href="' . pll__('Facebook page link') . '">';
                $args['after_widget']  = '</a>' . $args['after_widget'];
                break;
            case 'whatsapp':
                $mobile = false;
                foreach (['android', 'iphone', 'ipad'] as $os) {
                    $mobile = $mobile || stripos($_SERVER['HTTP_USER_AGENT'], $os) !== false;
                }
                if ($mobile) {
                    $args['before_widget'] .= '<a target="_blank" href="https://web.whatsapp.com/send?phone=' . pll__('Whatsapp number') . '">';
                    $args['after_widget']  = '</a>' . $args['after_widget'];
                } else {
                    $args['before_widget'] .= '<a href="https://api.whatsapp.com/send?phone=' . pll__('Whatsapp number') . '">';
                    $args['after_widget']  = '</a>' . $args['after_widget'];
                }
                break;
            case 'phone':
                $args['before_widget'] .= '<a href="tel:' . $instance['title'] . '">';
                $args['after_widget']  = '</a>' . $args['after_widget'];
                $icon                  = 'abf abf-phone-inverse';
                break;
            case 'comment':
                $args['before_widget'] .= '<a href="javascript:;" data-toggle="chat">';
                $args['after_widget']  = '</a>' . $args['after_widget'];
                break;
        }

        echo $args['before_widget'];

        echo "<div class='info-block'>
                <div class='icon-container'>
                    <i class='$icon'></i>
                </div>
                <div class='content'>
                    <h5 class='content-title'>{$instance['title']}</h5>
                    <p>{$instance['content']}</p>
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
