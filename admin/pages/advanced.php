<?php
/**
 * @package YMBESEO\Admin
 */

if ( ! defined( 'YMBESEO_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$active_tab = filter_input( INPUT_GET, 'tab' );

$tabs = array(
	'breadcrumbs' => array(
		'label'     => __( 'Breadcrumbs', 'ymbeseo' ),
		'opt_group' => 'YMBESEO_internallinks',
	),
	'permalinks'  => array(
		'label'     => __( 'Permalinks', 'ymbeseo' ),
		'opt_group' => 'YMBESEO_permalinks',
	),
	'rss'         => array(
		'label'     => __( 'RSS', 'ymbeseo' ),
		'opt_group' => 'YMBESEO_rss',
	),
);

if ( '' === $active_tab || ! in_array( $active_tab, array_keys( $tabs ) ) ) {
	$active_tab = 'breadcrumbs';
}

Yoast_Form::get_instance()->admin_header( true, $tabs[ $active_tab ]['opt_group'] );

?>
	<h2 class="nav-tab-wrapper">
		<?php
		foreach ( $tabs as $tab_key => $tab_opt ) {
			$active = '';
			if ( $active_tab == $tab_key ) {
				$active = ' nav-tab-active';
			}
			echo '<a class="nav-tab' . $active . '" id="' . $tab_key . '-tab" href="' . admin_url( 'admin.php?page=YMBESEO_advanced&tab=' . $tab_key ) . '">' . $tab_opt['label'] . '</a>';
		}
		?>
	</h2>
	<br/>
<?php

require_once YMBESEO_PATH . 'admin/views/tab-' . $active_tab . '.php';

Yoast_Form::get_instance()->admin_footer();
