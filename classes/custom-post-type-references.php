<?php

/**
 * Security, checks if WordPress is running
 **/
if ( !function_exists( 'add_action' ) ) :
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
endif;



/**
*  Plugin
*/
final class Custom_Post_Type_Reference
{



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function __construct()
	{

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	} // END __construct



	/**
	 * Load plugin textdomain
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'custom-post-type-references', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

	} // END load_plugin_textdomain



	/**
	 * Register post type
	 *
	 * @access public
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function register_post_type()
	{

		register_post_type( 'reference', array(
			'labels' => array(
				'name' => _x( 'References', 'post type general name', 'custom-post-type-references' ),
				'singular_name' => _x( 'Reference', 'post type singular name', 'custom-post-type-references' ),
				'add_new' => _x( 'Add New', 'Reference', 'custom-post-type-references' ),
				'add_new_item' => __( 'Add New Reference', 'custom-post-type-references' ),
				'edit_item' => __( 'Edit Reference', 'custom-post-type-references' ),
				'new_item' => __( 'New Reference', 'custom-post-type-references' ),
				'view_item' => __( 'View Reference', 'custom-post-type-references' ),
				'search_items' => __( 'Search References', 'custom-post-type-references' ),
				'not_found' =>	__( 'No References found', 'custom-post-type-references' ),
				'not_found_in_trash' => __( 'No References found in Trash', 'custom-post-type-references' ),
				'parent_item_colon' => '',
				'menu_name' => __( 'References', 'custom-post-type-references' )
			),
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'references', 'post type slug', 'custom-post-type-references' ) ),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'menu_icon' => 'dashicons-clipboard',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' )
		) );

	} // END register_post_type



	/**
	 * Register taxonomy
	 *
	 * @access public
	 * @since 1.2.0
	 * @author Ralf Hortt
	 */
	public function register_taxonomy()
	{

		register_taxonomy( 'reference-category', array( 'reference' ), array(
			'hierarchical' => TRUE,
			'labels' => array(
				'name' => _x( 'Reference Categories', 'taxonomy general name', 'custom-post-type-references' ),
				'singular_name' => _x( 'Reference Category', 'taxonomy singular name', 'custom-post-type-references' ),
				'search_items' =>  __( 'Search Reference Categories', 'custom-post-type-references' ),
				'all_items' => __( 'All Reference Categories', 'custom-post-type-references' ),
				'parent_item' => __( 'Parent Reference Category', 'custom-post-type-references' ),
				'parent_item_colon' => __( 'Parent Reference Category:', 'custom-post-type-references' ),
				'edit_item' => __( 'Edit Reference Category', 'custom-post-type-references' ),
				'update_item' => __( 'Update Reference Category', 'custom-post-type-references' ),
				'add_new_item' => __( 'Add New Reference Category', 'custom-post-type-references' ),
				'new_item_name' => __( 'New Reference Category Name', 'custom-post-type-references' ),
				'menu_name' => __( 'Reference Categories', 'custom-post-type-references' ),
			),
			'show_ui' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'reference-category', 'Reference Category Slug', 'custom-post-type-references' ) ),
			'show_admin_column' => TRUE,
		));

	} // END register_taxonomy



} // END Custom_Post_Type_Reference

new Custom_Post_Type_Reference;
