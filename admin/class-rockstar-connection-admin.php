<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rockstar_Connection
 * @subpackage Rockstar_Connection/admin
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Rockstar_Connection_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rockstar_Connection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rockstar_Connection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rockstar-connection-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rockstar_Connection_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rockstar_Connection_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rockstar-connection-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function rockstar_connection_register_settings() {
		/**
		 * This file adds actions links for Rockstar Connection.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rockstar-connection-settings.php';
	}

	// Register Custom Post Type
	public function RSC_video_post_type() {

		$labels = array(
			'name'                  	=> _x( 'Rockstar Videos', 'Post Type General Name', 'rockstar-connection' ),
			'singular_name'         	=> _x( 'Rockstar Video', 'Post Type Singular Name', 'rockstar-connection' ),
			'menu_name'             	=> __( 'Rockstar Videos', 'rockstar-connection' ),
			'name_admin_bar'        	=> __( 'Rockstar Video', 'rockstar-connection' ),
			'archives'              	=> __( 'Videos Archives', 'rockstar-connection' ),
			'attributes'            	=> __( 'Videos Attributes', 'rockstar-connection' ),
			'parent_item_colon'     	=> __( 'Parent Video:', 'rockstar-connection' ),
			'all_items'             	=> __( 'All Videos', 'rockstar-connection' ),
			'add_new_item'          	=> __( 'Add New Video', 'rockstar-connection' ),
			'add_new'               	=> __( 'Add New', 'rockstar-connection' ),
			'new_item'              	=> __( 'New Video', 'rockstar-connection' ),
			'edit_item'             	=> __( 'Edit Video', 'rockstar-connection' ),
			'update_item'           	=> __( 'Update Video', 'rockstar-connection' ),
			'view_item'             	=> __( 'View Video', 'rockstar-connection' ),
			'view_items'            	=> __( 'View Videos', 'rockstar-connection' ),
			'search_items'          	=> __( 'Search Video', 'rockstar-connection' ),
			'not_found'             	=> __( 'Not found', 'rockstar-connection' ),
			'not_found_in_trash'    	=> __( 'Not found in Trash', 'rockstar-connection' ),
			'featured_image'        	=> __( 'Featured Image', 'rockstar-connection' ),
			'set_featured_image'    	=> __( 'Set featured image', 'rockstar-connection' ),
			'remove_featured_image' 	=> __( 'Remove featured image', 'rockstar-connection' ),
			'use_featured_image'    	=> __( 'Use as featured image', 'rockstar-connection' ),
			'insert_into_item'      	=> __( 'Insert into item', 'rockstar-connection' ),
			'uploaded_to_this_item' 	=> __( 'Uploaded to this item', 'rockstar-connection' ),
			'items_list'            	=> __( 'Videos list', 'rockstar-connection' ),
			'items_list_navigation' 	=> __( 'Videos list navigation', 'rockstar-connection' ),
			'filter_items_list'     	=> __( 'Filter videos list', 'rockstar-connection' ),
			'bp_activity_admin_filter' 	=> __( 'New Video published', 'rockstar-connection' ),
	        'bp_activity_front_filter' 	=> __( 'Videos', 'rockstar-connection' ),
	        'bp_activity_new_post'     	=> __( '%1$s posted a new <a href="%2$s">video</a>', 'rockstar-connection' ),
	        'bp_activity_new_post_ms'  	=> __( '%1$s posted a new <a href="%2$s">video</a>, on the site %3$s', 'rockstar-connection' ),
		);
		$args = array(
			'label'                 => __( 'video', 'rockstar-connection' ),
			'description'           => __( 'Site videos.', 'rockstar-connection' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'excerpt', 'thumbnail', 'buddypress-activity' ),
			'bp_activity' 			=> array(
							            'component_id' => buddypress()->activity->id,
							            'action_id'    => 'new_video',
							            'contexts'     => array( 'activity', 'member' ),
							            'position'     => 40,
							        ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 101,
			'menu_icon'             => 'dashicons-format-video',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite'				=> array( 'slug' => 'rsc-videos'),
		);
		register_post_type( 'RSC_videos', $args );
		
	}

	public function rsc_video_meta_box() {
		add_meta_box( 'video-id', __( 'Video Link', 'rockstar-connection' ), array( $this, 'rsc_video_link_meta' ), 'rsc_videos', 'normal', 'high' );
	}

	public function rsc_video_link_meta( $post ) {
		global $wp_embed;
		$current_link = ( get_post_meta( $post->ID, 'link-' . get_the_ID(), true ) ) ? get_post_meta( $post->ID, 'link-' . get_the_ID(), true ): '';
		$output = '';
		$output .= '<div class="rsc-video-link-wrap">';
		$output .= '<label id="link-label-' . get_the_ID() . '" for="link-' . get_the_ID() . '" class="rsc-video-link-label">Insert Link Here ';
		$output .= '<input type="text" id="link-' . get_the_ID() . '" name="link-' . get_the_ID() . '" size="30" class="rsc-video-link-option" value="' . $current_link . '" />';
		$output .= '</label>';
		$output .= '<div class="rsc-video-display">' . $wp_embed->run_shortcode( '[embed width="350" height="175"]' . $current_link . '[/embed]' );
		$output .= '</div>';
		$output .= '</div>';

		echo $output;
	}

	public function rsc_video_link_save( $post_id ) {
		if ( ! wp_get_referer() ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( array_key_exists( 'link-' . $post_id, $_POST ) ) {
			update_post_meta(
				$post_id,
				'link-' . $post_id,
				$_POST['link-' . $post_id]
			);

			return;
		}

	}

	public function load_rsc_videos_template( $template ) {
	    global $post;

		if ( $post->post_type == 'rsc_videos') {

			if ( strpos( $template, 'archive' ) ) {
				$template = locate_template( array( "rockstar-connection/archive-rsc-videos.php" ) );

				if ( $template == '' ) {
					$template = ROCKSTAR_CONNECTION_PATH . "templates/archive-rsc-videos.php";
				}

	    		return $template;
			}

			if ( strpos( $template, 'single' ) ) {

	    		$template = locate_template( array( "rockstar-connection/single-rsc-videos.php" ) );
	    		
	    		if ( $template == '' ) {
					$template = ROCKSTAR_CONNECTION_PATH . "templates/single-rsc-videos.php";
	    		}
	    		
	    		return $template;
			}

		}

	    return $template;
	}

	public function rsc_vroom_page_add() {
		add_rewrite_endpoint( 'rsc-vroom', EP_ROOT );
		if ( get_transient( 'rsc_ep_flush' ) ) :
			flush_rewrite_rules();
		endif;
	}


	public function get_vroom_temp( $template ) {
		if ( get_query_var('rsc-vroom', false ) !== false ) :
			$template = locate_template( array( "rockstar-connection/template-rsc-vroom.php" ) );
			
			if ( $template == '' ) {
				$template = ROCKSTAR_CONNECTION_PATH . "templates/template-rsc-vroom.php";
			}
			
			return $template;
		endif;

		return $template;
	}

}
