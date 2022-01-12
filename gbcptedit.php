<?php
/**
 * Plugin Name:     Gutenberg Custom Post Type Edit
 * Plugin URI:      https://github.com/bobbingwide/gbcptedit
 * Description:     To enable editing of Gutenberg's Custom Post Types
 * Author:          bobbingwide
 * Author URI:      https://bobbingwide.com/about-bobbing-wide
 * Text Domain:     gbcptedit
 * Domain Path:     /languages
 * Version:         0.0.0
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright 2022 Bobbing Wide (email : herb@bobbingwide.com )
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * The license for this software can likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         gbcptedit
 */

/**
 * Implement 'setup_theme' for gbcptedit
 *
 * Defer registering our hook for 'register_post_type_args' since we need to ensure that $wp_rewrite
 * has been initialised.
 *
 * See TRAC 36579
 *
 * Most of the above comment copied from oik-types.
 */
function gbcptedit_setup_theme() {
    add_filter( 'register_post_type_args', 'gbcptedit_register_post_type_args', 10, 2 );
    //add_filter( 'is_post_type_viewable', 'gbcptedit_is_post_type_viewable', 10, 2 );
}

function gbcptedit_loaded() {
    add_action( 'setup_theme', 'gbcptedit_setup_theme'  );
    add_action( 'post_edit_form_tag', 'gbcptedit_enable_wp_navigation_editor');
}


function gbcptedit_enable_wp_navigation_editor( $post ) {
    remove_action( 'edit_form_after_title', '_disable_content_editor_for_navigation_post_type' );
    remove_action( 'edit_form_after_title', 'gutenberg_disable_content_editor_for_navigation_post_type');
}


/**
 * Implements overrides to certain GB CPTs.
 *
 * Extends what may already have been altered by oik-types.
 */
function gbcptedit_register_post_type_args( $args, $post_type ) {

    switch ( $post_type ) {
        case 'wp_block':
        case 'wp_template':
        case 'wp_template_part':
        case 'wp_global_styles':
        case 'wp_navigation':
            $args = gbcptedit_adjust( $args, $post_type );
            break;

        default: // Nothing to do here
    }

    return $args;
}

/**
 * Makes the post type editable and (oik-)cloneable.
 *
 * Note: I've never been exactly sure which of these settings are needed.
 * I think these are the minimum requirements.
 *
 * @param $args
 * @param $post_type
 * @return mixed
 */
function gbcptedit_adjust( $args, $post_type ) {
    $args['public'] = true;
    $args['show_ui'] = true;
    $args['show_in_menu'] = true;
    $args['_builtin'] = false;
    $args['supports'][] = 'clone';
    bw_trace2( $args, "args after", false );
    //print_r( $args );

    //gob();
    return $args;
}

/**
 * Returns true if the post type is viewable.
 *
 * This new filter, introduced in WordPress 5.9 appears to be very silly indeed.
 * It can get called hundreds of times and appears to make no difference if
 * you try to turn false into true!
 *
 *
 * @param $is_viewable
 * @param $post_type
 * @return bool|mixed
 */

function gbcptedit_is_post_type_viewable( $is_viewable, $post_type ) {
    switch ( $post_type->name ) {
        case 'wp_global_styles':
            return false;
    }
    return $is_viewable;
}

gbcptedit_loaded();