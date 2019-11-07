<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Layered Navigation Widget
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class kitgreen_WC_Widget_Banner extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'contact-header-widget ';
		$this->widget_description = __( 'Shows Contact Header Top', 'woocommerce' );
		$this->widget_id          = 'contact-header-top';
		$this->widget_name        = __( 'Contact Header', 'woocommerce' );
		
		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( '', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' )
			),
			'heading' => array(
				'type'  => 'text',
				'std'   => __( 'Enter Text this', 'woocommerce' ),
				'label' => __( 'Heading banner', 'woocommerce' )
			),
			'sub_head' => array(
				'type'  => 'text',
				'std'   => __( 'Enter Text this', 'woocommerce' ),
				'label' => __( 'Subheading', 'woocommerce' )
			),
            'col_contact' => array(
				'type'  => 'text',
				'std'   => __( 'col-lg-12 col-md-12 col-sm-12 col-xs-12', 'woocommerce' ),
				'label' => __( 'Subheading', 'woocommerce' )
			),
			'icon' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'icon', 'woocommerce' )
			),
		);


		parent::__construct();
	}
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		ob_start();
		$this->widget_start( $args, $instance );
		$heading = esc_attr( $instance['heading'] );
		$sub_head = esc_attr( $instance['sub_head'] );
        $icon = esc_attr( $instance['icon'] );
        $col_contact = esc_attr( $instance['col_contact'] );
		?>
			<div class="contact-header <?php echo $col_contact; ?>">
				<span aria-hidden="true" class="<?php echo $icon ?>"></span>
				<div class="hgroup">
				<?php if( ! empty( $heading ) ){ ?>
					<h6><?php echo $heading; ?></h6>
				<?php } ?>
				<?php if( ! empty( $sub_head ) ): ?>
					<p><?php echo $sub_head; ?></p>
				<?php endif; ?>
				</div>
			</div>
		<?php

		$this->widget_end( $args );

		echo ob_get_clean();
	}
}

function register_kitgreen_banner() {
    register_widget('kitgreen_WC_Widget_Banner');
}
add_action('widgets_init', 'register_kitgreen_banner');
