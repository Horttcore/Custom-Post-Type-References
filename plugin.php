<?php
/**
 * Plugin Name: Custom Post Type References
 * Plugin URI: http://horttcore.de
 * Description: Manage references
 * Version: 1.1.0
 * Author: Ralf Hortt
 * Author URI: http://horttcore.de
 * Text Domain: custom-post-type-references
 * Domain Path: /languages/
 * License: GPL2
 */

require( 'classes/custom-post-type-references.php' );

if ( is_admin() )
	require( 'classes/custom-post-type-references.admin.php' );
