<?php
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {

    $supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'News', 'Post Type General Name', 'Theme' ),
        'singular_name'       => _x( 'News', 'Post Type Singular Name', 'Theme' ),
        'menu_name'           => __( 'News', 'Theme' ),
        'parent_item_colon'   => __( 'Parent News', 'Theme' ),
        'all_items'           => __( 'All News', 'Theme' ),
        'view_item'           => __( 'View News', 'Theme' ),
        'add_new_item'        => __( 'Add New News', 'Theme' ),
        'add_new'             => __( 'Add New', 'Theme' ),
        'edit_item'           => __( 'Edit News', 'Theme' ),
        'update_item'         => __( 'Update News', 'Theme' ),
        'search_items'        => __( 'Search News', 'Theme' ),
        'not_found'           => __( 'Not Found', 'Theme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'Theme' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'news', 'Theme' ),
        'description'         => __( 'News news and reviews', 'Theme' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields','page-attributes', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        // 'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
 
 // This is where we add taxonomies to our CPT
     'taxonomies' => array('post_tag'),

    );
     
    // Registering your Custom Post Type
    register_post_type( 'news', $args );
    

      register_taxonomy("news_categories", "news", array("hierarchical" => true,
        "label" => "Categories",
        "singular_label" => "Categories",
        'rewrite' => array('slug' => 'news_categories','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );



/**
 * Register Multiple Taxonomies
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/register-multiple-taxonomies/
 */

function be_register_taxonomies() {

    $taxonomies = array(
        array(
            'slug'         => 'news_scale_set(scale, amount)-department',
            'single_name'  => 'Department',
            'plural_name'  => 'Departments',
            'post_type'    => 'news',
            'rewrite'      => array( 'slug' => 'department' ),
        ),
        array(
            'slug'         => 'news-type',
            'single_name'  => 'Type',
            'plural_name'  => 'Types',
            'post_type'    => 'news',
            'hierarchical' => false,
        ),
        array(
            'slug'         => 'news-experience',
            'single_name'  => 'Min-Experience',
            'plural_name'  => 'Min-Experiences',
            'post_type'    => 'news',
        ),
    );

    foreach( $taxonomies as $taxonomy ) {
        $labels = array(
            'name' => $taxonomy['plural_name'],
            'singular_name' => $taxonomy['single_name'],
            'search_items' =>  'Search ' . $taxonomy['plural_name'],
            'all_items' => 'All ' . $taxonomy['plural_name'],
            'parent_item' => 'Parent ' . $taxonomy['single_name'],
            'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
            'edit_item' => 'Edit ' . $taxonomy['single_name'],
            'update_item' => 'Update ' . $taxonomy['single_name'],
            'add_new_item' => 'Add New ' . $taxonomy['single_name'],
            'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
            'menu_name' => $taxonomy['plural_name']
        );
        
        $rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
        $hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
    
        register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
            'hierarchical' => $hierarchical,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => $rewrite,
        ));
    }
    
}
add_action( 'init', 'be_register_taxonomies' );

?>

