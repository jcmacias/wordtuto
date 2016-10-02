<?php
/**
 * Created by PhpStorm.
 * User: 508
 * Date: 9/29/2016
 * Time: 11:02 AM
 */
function popper_child_setup(){
  load_child_theme_textdomain('popper_child', get_stylesheet_directory().'/languages');
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'secundary' => esc_html__( 'Footer Menu', 'popper-child' ),
    ) );
}
add_action('after_setup_theme','popper_child_setup');

function popper_posted_on() {

    $author_id = get_the_author_meta( 'ID' );

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( 'on %s', 'post date', 'popper-child' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'popper-child' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    // Display author avatar if author has a Gravatar
    if ( validate_gravatar( $author_id ) ) {
        echo '<div class="meta-content has-avatar">';
        echo '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>';
    } else {
        echo '<div class="meta-content">';
    }

    echo '<span class="byline">' . $byline . ' </span><span class="posted-on">' . $posted_on . ' </span>'; // WPCS: XSS OK.
    $categories_list = get_the_category_list( esc_html__( ', ', 'popper-child' ) );
    if ( $categories_list && popper_categorized_blog() ) {
        printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'popper-child' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'popper-child' ), esc_html__( '1 Comment', 'popper-child' ), esc_html__( '% Comments', 'popper-child' ) );
        echo '</span>';
    }
    echo '</div><!-- .meta-content -->';

}
function popper_index_posted_on() {

    $author_id = get_the_author_meta( 'ID' );

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( 'Published %s', 'post date', 'popper-child' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'popper-child' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<div class="meta-content">';
    echo '<span class="byline">' . $byline . ' </span><span class="posted-on">' . $posted_on . ' </span>'; // WPCS: XSS OK.
    $categories_list = get_the_category_list( esc_html__( ', ', 'popper-child' ) );
    if ( $categories_list && popper_categorized_blog() ) {
        printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'popper-child' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'popper-child' ), esc_html__( '1 Comment', 'popper-child' ), esc_html__( '% Comments', 'popper-child' ) );
        echo '</span>';
    }
    echo '</div><!-- .meta-content -->';

}
