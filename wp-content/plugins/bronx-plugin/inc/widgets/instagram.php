<?php
// thb twitter
class thb_instagram extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'thb_widget_instagram',
			'description' => esc_html__('Display Your Instagram Feed', 'bronx' )
		);

		parent::__construct(
			'thb_instagram_widget',
			esc_html__( 'Bronx - Instagram' , 'bronx' ),
			$widget_ops
		);

		$this->defaults = array(
			'title'        => '',
			'username'     => 'fuelthemes',
			'access_token' => '',
			'layout'	     => 'thumbnail',
			'show'         => 6
		);
	}

	function widget($args, $instance) {
		$params = array_merge( $this->defaults, $instance );

    // Before Widget.
		echo $args['before_widget'];

		// Title.
		if ( $params['title'] ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
		}

		$instagram = thb_getInstagramPhotos($params['show'], $params['username'], $params['access_token']);

		if ($params['layout'] == 'slider') {
			?>
			<div class="thb-carousel thb-instagram-row row slick" data-fade="true" data-columns="1" data-autoplay="true" data-autoplay-speed="2000">
				<?php if (array_key_exists('data', $instagram)) { foreach ($instagram['data'] as $item) { ?>
					<div class="small-12 columns">
						<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
						<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
						<span><?php get_template_part( 'assets/img/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em>
						</figure>
					</div>
				<?php } } ?>
			</div>
			<div class="thb-instagram-footer">
				<a href="https://instagram.com/<?php echo esc_attr($params['username']); ?>" target="_blank">
					<i class="fa fa-instagram"></i> <?php echo esc_attr($params['username']); ?>
				</a>
			</div>
			<?php
		} else if ($params['layout'] == 'thumbnail') {
			?>
			<div class="thb-instagram-header">
				<a href="https://instagram.com/<?php echo esc_attr($params['username']); ?>" target="_blank">
					<img src="<?php echo esc_url($instagram['user_data']['profile_pic_url_hd']); ?>" alt="<?php echo esc_attr($params['username']); ?>" class="thb_instagram_avatar"/>
				</a>
				<div class="thb-twitter-user">
					<span class="thb-instagram-username"><?php echo esc_attr($params['username']); ?></span>
					<div class="thb-instagram-usermeta">
						<span><?php echo thb_numberAbbreviation(($instagram['user_data']['followed_by'])); ?> <?php esc_html_e( 'Followers', 'bronx' ); ?></span>
						<span><?php echo thb_numberAbbreviation(($instagram['user_data']['follow'])); ?> <?php esc_html_e( 'Following', 'bronx' ); ?></span>
					</div>
				</div>
			</div>
			<div class="thb-instagram-row row low-padding">
				<?php if (array_key_exists('data', $instagram)) { foreach ($instagram['data'] as $item) { ?>
					<div class="small-6 columns">
						<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
						<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
						<span><?php get_template_part( 'assets/img/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em>
						</figure>
					</div>
				<?php } } ?>
			</div>
			<?php
		}
		echo $args['after_widget'];
	}
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		return $instance;
	}
	function form($instance) {
		$params = array_merge( $this->defaults, $instance );
		?>
			<!-- Title -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'bronx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Username -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'bronx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $params['username'] ); ?>" /></p>

			<!-- access_token -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'bronx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $params['access_token'] ); ?>" /></p>

			<!-- Layout -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'bronx' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" class="widefat">
					<option value="thumbnail" <?php selected( $params['layout'], 'thumbnail' ); ?>><?php esc_html_e( 'Thumbnails', 'bronx' ); ?></option>
					<option value="slider" <?php selected( $params['layout'], 'slider' ); ?>><?php esc_html_e( 'Slider', 'bronx' ); ?></option>
				</select>
			</p>
      <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Photos:', 'bronx' ); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($params['show']); ?>" class="widefat" />
			</p>
		<?php
	}
}