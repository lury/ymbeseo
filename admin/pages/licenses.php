<?php
/**
 * @package YMBESEO\Admin
 * @since      1.5.0
 */

if ( ! defined( 'YMBESEO_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$extensions = array(
	'seo-premium'     => (object) array(
		'url'       => 'https://yoast.com/wordpress/plugins/seo-premium/',
		'title'     => 'Yoast SEO Premium',
		/* translators: %1$s expands to Yoast SEO */
		'desc'      => sprintf( __( 'The premium version of %1$s with more features & support.', 'ymbeseo' ), 'Yoast SEO' ),
		'installed' => false,
	),
	'video-seo'       => (object) array(
		'url'       => 'https://yoast.com/wordpress/plugins/video-seo/',
		'title'     => 'Video SEO',
		'desc'      => __( 'Optimize your videos to show them off in search results and get more clicks!', 'ymbeseo' ),
		'installed' => false,
	),
	'news-seo'        => (object) array(
		'url'       => 'https://yoast.com/wordpress/plugins/news-seo/',
		'title'     => 'News SEO',
		'desc'      => __( 'Are you in Google News? Increase your traffic from Google News by optimizing for it!', 'ymbeseo' ),
		'installed' => false,
	),
	'local-seo'       => (object) array(
		'url'       => 'https://yoast.com/wordpress/plugins/local-seo/',
		'title'     => 'Local SEO',
		'desc'      => __( 'Rank better locally and in Google Maps, without breaking a sweat!', 'ymbeseo' ),
		'installed' => false,
	),
	'woocommerce-seo' => (object) array(
		'url'       => 'https://yoast.com/wordpress/plugins/yoast-woocommerce-seo/',
		'title'     => 'Yoast WooCommerce SEO',
		/* translators: %1$s expands to Yoast SEO */
		'desc'      => sprintf( __( 'Seamlessly integrate WooCommerce with %1$s and get extra features!', 'ymbeseo' ), 'Yoast SEO' ),
		'installed' => false,
	),
);

if ( class_exists( 'YMBESEO_Premium' ) ) {
	$extensions['seo-premium']->installed = true;
}
if ( class_exists( 'YMBESEO_Video_Sitemap' ) ) {
	$extensions['video-seo']->installed = true;
}
if ( class_exists( 'YMBESEO_News' ) ) {
	$extensions['news-seo']->installed = true;
}
if ( defined( 'YMBESEO_LOCAL_VERSION' ) ) {
	$extensions['local-seo']->installed = true;
}
if ( ! class_exists( 'Woocommerce' ) ) {
	unset( $extensions['woocommerce-seo'] );
}
elseif ( class_exists( 'Yoast_WooCommerce_SEO' ) ) {
	$extensions['woocommerce-seo']->installed = true;
}

?>

<div class="wrap YMBESEO_table_page">

	<h2 id="wpseo-title"><?php
		/* translators: %1$s expands to Yoast SEO */
		printf( __( '%1$s Extensions', 'ymbeseo' ), 'Yoast SEO' );
		?></h2>

	<h2 class="nav-tab-wrapper" id="wpseo-tabs">
		<a class="nav-tab" id="extensions-tab" href="#top#extensions"><?php _e( 'Extensions', 'ymbeseo' ); ?></a>
		<a class="nav-tab" id="licenses-tab" href="#top#licenses"><?php _e( 'Licenses', 'ymbeseo' ); ?></a>
	</h2>

	<div class="tabwrapper">
		<div id="extensions" class="wpseotab">
			<?php
			foreach ( $extensions as $id => $extension ) {
				$utm = '#utm_source=wordpress-seo-config&utm_medium=banner&utm_campaign=extension-page-banners';
				?>
				<div class="extension <?php echo esc_attr( $id ); ?>">
					<a target="_blank" href="<?php echo esc_url( $extension->url . $utm ); ?>">
						<h3><?php echo esc_html( $extension->title ); ?></h3>
					</a>

					<p><?php echo esc_html( $extension->desc ); ?></p>

					<p>
						<?php if ( $extension->installed ) : ?>
							<button class="button-primary installed">Installed</button>
						<?php else : ?>
							<a target="_blank" href="<?php echo esc_url( $extension->url . $utm ); ?>" class="button-primary">
								<?php _e( 'Get this extension', 'ymbeseo' ); ?>
							</a>
						<?php endif; ?>
					</p>
				</div>
			<?php
			}
			unset( $extensions, $id, $extension, $utm );
			?>
		</div>
		<div id="licenses" class="wpseotab">
			<?php

			/**
			 * Display license page
			 */
			settings_errors();
			if ( ! has_action( 'YMBESEO_licenses_forms' ) ) {
				echo '<div class="msg"><p>', __( 'This is where you would enter the license keys for one of our premium plugins, should you activate one.', 'ymbeseo' ), '</p></div>';
			}
			else {
				do_action( 'YMBESEO_licenses_forms' );
			}
			?>
		</div>
	</div>

</div>