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
final class Custom_Post_Type_Reference_Admin
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

		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );

	} // end __construct



	/**
	 * Post updated messages
	 *
	 * @access public
	 * @param array $messages Update Messages
	 * @return array Update Messages
	 * @since v1.1.0
	 * @author Ralf Hortt
	 **/
	public function post_updated_messages( $messages )
	{

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( 'reference' );

		$messages['reference'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Reference updated.', 'custom-post-type-references' ),
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => __( 'Reference updated.', 'custom-post-type-references' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Reference restored to revision from %s', 'custom-post-type-references' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Reference published.', 'custom-post-type-references' ),
			7  => __( 'Reference saved.', 'custom-post-type-references' ),
			8  => __( 'Reference submitted.', 'custom-post-type-references' ),
			9  => sprintf( __( 'Reference scheduled for: <strong>%1$s</strong>.', 'custom-post-type-references' ), date_i18n( __( 'M j, Y @ G:i', 'custom-post-type-references' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Reference draft updated.', 'custom-post-type-references' )
		);

		if ( $post_type_object->publicly_queryable ) :

			$permalink = get_permalink( $post->ID );

			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View reference', 'custom-post-type-references' ) );
			$messages[ 'reference' ][1] .= $view_link;
			$messages[ 'reference' ][6] .= $view_link;
			$messages[ 'reference' ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview reference', 'custom-post-type-references' ) );
			$messages[ 'reference' ][8]  .= $preview_link;
			$messages[ 'reference' ][10] .= $preview_link;

		endif;

		return $messages;

	} // end register_post_type



} // end Custom_Post_Type_Reference_Admin

new Custom_Post_Type_Reference_Admin;
