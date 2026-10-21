<?php
/**
 * Register a custom menu page.
 */

add_action( 'admin_menu', 'action__init_menu_admin' );
function action__init_menu_admin() {

	add_menu_page(
        'Admin Dashboard', // Page Title
        'Admin Dashboard', // Menu Title
        'edit_pages', // Capabiliy
        'theme_settings', // Menu_slug
        'action__admin_layout__dashboard', // function
        '', // icon_url
        2   // position
	);
	

}

function action__admin_layout__dashboard() {
    include_once( get_stylesheet_directory() . '/admin/pages/admin_dashboard.php' );
}

?>