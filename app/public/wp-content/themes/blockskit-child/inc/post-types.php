<?php
/**
 * Custom Post Types & Taxonomies
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Projects Custom Post Type
 */
function interior_register_cpts() {
	// 1. Projects CPT
	$project_labels = array(
		'name'               => _x( 'المشاريع', 'Post type general name', 'blockskit-child' ),
		'singular_name'      => _x( 'مشروع', 'Post type singular name', 'blockskit-child' ),
		'menu_name'          => _x( 'المشاريع الفاخرة', 'Admin Menu text', 'blockskit-child' ),
		'name_admin_bar'     => _x( 'مشروع', 'Add New on Toolbar', 'blockskit-child' ),
		'add_new'            => __( 'إضافة مشروع جديد', 'blockskit-child' ),
		'add_new_item'       => __( 'إضافة مشروع جديد', 'blockskit-child' ),
		'new_item'           => __( 'مشروع جديد', 'blockskit-child' ),
		'edit_item'          => __( 'تعديل المشروع', 'blockskit-child' ),
		'view_item'          => __( 'عرض المشروع', 'blockskit-child' ),
		'all_items'          => __( 'كافة المشاريع', 'blockskit-child' ),
		'search_items'       => __( 'بحث في المشاريع', 'blockskit-child' ),
	);

	$project_args = array(
		'labels'             => $project_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-building',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);
	register_post_type( 'project', $project_args );

	// Project Typology Taxonomy
	$tax_labels = array(
		'name'              => _x( 'تصنيفات المشاريع', 'taxonomy general name', 'blockskit-child' ),
		'singular_name'     => _x( 'تصنيف المشروع', 'taxonomy singular name', 'blockskit-child' ),
		'search_items'      => __( 'بحث في التصنيفات', 'blockskit-child' ),
		'all_items'         => __( 'كافة التصنيفات', 'blockskit-child' ),
		'edit_item'         => __( 'تعديل التصنيف', 'blockskit-child' ),
		'update_item'       => __( 'تحديث التصنيف', 'blockskit-child' ),
		'add_new_item'      => __( 'إضافة تصنيف جديد', 'blockskit-child' ),
		'new_item_name'     => __( 'اسم التصنيف الجديد', 'blockskit-child' ),
		'menu_name'         => __( 'التصنيفات', 'blockskit-child' ),
	);
	register_taxonomy( 'project_typology', array( 'project' ), array(
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-type' ),
		'show_in_rest'      => true,
	) );

	// 2. Services CPT
	$service_labels = array(
		'name'               => _x( 'الخدمات', 'Post type general name', 'blockskit-child' ),
		'singular_name'      => _x( 'خدمة', 'Post type singular name', 'blockskit-child' ),
		'menu_name'          => _x( 'منظومة الخدمات', 'Admin Menu text', 'blockskit-child' ),
		'add_new'            => __( 'إضافة خدمة جديدة', 'blockskit-child' ),
		'all_items'          => __( 'كافة الخدمات', 'blockskit-child' ),
	);
	$service_args = array(
		'labels'             => $service_labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-admin-tools',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);
	register_post_type( 'service', $service_args );

	// 3. Team & Partners CPT
	$team_labels = array(
		'name'               => _x( 'فريق الاستوديو', 'Post type general name', 'blockskit-child' ),
		'singular_name'      => _x( 'عضو فريق', 'Post type singular name', 'blockskit-child' ),
		'menu_name'          => _x( 'كبار المعماريين', 'Admin Menu text', 'blockskit-child' ),
		'all_items'          => __( 'كافة أعضاء الفريق', 'blockskit-child' ),
	);
	$team_args = array(
		'labels'             => $team_labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-businessperson',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);
	register_post_type( 'team', $team_args );

	// 4. Material Library CPT
	$material_labels = array(
		'name'               => _x( 'مكتبة الخامات', 'Post type general name', 'blockskit-child' ),
		'singular_name'      => _x( 'خامة', 'Post type singular name', 'blockskit-child' ),
		'menu_name'          => _x( 'الخامات الحصرية', 'Admin Menu text', 'blockskit-child' ),
		'all_items'          => __( 'كافة الخامات', 'blockskit-child' ),
	);
	$material_args = array(
		'labels'             => $material_labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 8,
		'menu_icon'          => 'dashicons-art',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);
	register_post_type( 'material', $material_args );

	// 5. Confidential Briefs CPT
	$brief_labels = array(
		'name'               => _x( 'أضابير العملاء', 'Post type general name', 'blockskit-child' ),
		'singular_name'      => _x( 'أضبارة مشروع', 'Post type singular name', 'blockskit-child' ),
		'menu_name'          => _x( 'الأضابير الخاصة (Briefs)', 'Admin Menu text', 'blockskit-child' ),
		'all_items'          => __( 'كافة الأضابير الواردة', 'blockskit-child' ),
	);
	$brief_args = array(
		'labels'             => $brief_labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 9,
		'menu_icon'          => 'dashicons-lock',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'custom-fields' ),
	);
	register_post_type( 'brief', $brief_args );
}
add_action( 'init', 'interior_register_cpts' );
