<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Train
 * @since   2.0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function train_theme_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'train_theme_body_classes' );


add_filter( 'comment_form_default_fields', 'train_theme_comment_form_fields' );
function train_theme_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="col-sm-12 form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'train' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="col-sm-12 form-group comment-form-email"><label for="email">' . __( 'Email', 'train' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class=" col-sm-12 form-group comment-form-url"><label for="url">' . __( 'Website', 'train' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'        
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'train_theme_comment_form' );
function train_theme_comment_form( $args ) {
    $args['comment_field'] = '<div class="col-sm-12 form-group comment-form-comment">
            <label for="comment">' . __( 'Comment', 'train' ) . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-default'; // since WP 4.1
    
    return $args;
}

add_action('comment_form', 'train_theme_comment_button' );
function train_theme_comment_button() {
    echo '<button class="btn btn-primary" type="submit">' . __( 'Submit', 'train' ) . '</button>';
}

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class train_theme_Customize_Dropdown_Taxonomies_Control
 */
class train_theme_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $train_theme_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $train_theme_taxonomy;
    $this->taxonomy = esc_attr( $train_theme_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__('Select', 'train') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}

if ( ! class_exists( 'Walker_Page' ) )
    return NULL;

/**
 * Class Train_Walker_Page
 */
class Train_Walker_Page extends Walker_Page {

    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of page. Used for padding.
     * @param array  $args
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if ( 0==$depth) {
            $output .= "\n$indent<ul class='dropdown-menu dropdown-first'>\n";
        }
        else {
            $output .= "\n$indent<ul class='dropdown-menu'>\n";
        }

    }

    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of page. Used for padding.
     * @param array  $args
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * @see Walker::start_el()
     *
     * @param string $output       Passed by reference. Used to append additional content.
     * @param object $page         Page data object.
     * @param int    $depth        Depth of page. Used for padding.
     * @param int    $current_page Page ID.
     * @param array  $args
     */
    function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
        if ( $depth ) {
            $indent = str_repeat( "\t", $depth );
        } else {
            $indent = '';
        }

        $css_class = array( 'page_item', 'page-item-' . $page->ID );

        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            if ( 0==$depth ) {
                $css_class[] = 'dropdown dropdown-hover';
            } else {
                $css_class[] = 'dropdown-submenu';
            }
        }

        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current_page_ancestor';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'active';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        /** This filter is documented in wp-includes/post-template.php */
        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
                if ( 0==$depth ) {
                    $output .= $indent . sprintf(
                            '<li class="%s"><a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s%s%s <span class="caret"></span></a>',
                            $css_classes,
                            get_permalink( $page->ID ),
                            $args['link_before'],
                            apply_filters( 'the_title', $page->post_title, $page->ID ),
                            $args['link_after']
                        );
                } else {
                    $output .= $indent . sprintf(
                            '<li class="%s"><a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s%s%s</a>',
                            $css_classes,
                            get_permalink( $page->ID ),
                            $args['link_before'],
                            apply_filters( 'the_title', $page->post_title, $page->ID ),
                            $args['link_after']
                        );
                }
            }
        } else {
            $output .= $indent . sprintf(
                    '<li class="%s"><a href="%s">%s%s%s</a>',
                    $css_classes,
                    get_permalink( $page->ID ),
                    $args['link_before'],
                    apply_filters( 'the_title', $page->post_title, $page->ID ),
                    $args['link_after']
                );
        }

    }
    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object. Not used.
     * @param int    $depth Depth of page. Not Used.
     * @param array  $args
     */
    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }

}


if ( ! function_exists( 'train_theme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function train_theme_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'train' ) );
        if ( $categories_list && train_theme_categorized_blog() ) {
            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'train' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'train' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'train' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'train' ), esc_html__( '1 Comment', 'train' ), esc_html__( '% Comments', 'train' ) );
        echo '</span>';
    }

    edit_post_link( esc_html__( 'Edit', 'train' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Flush out the transients used in train_theme_categorized_blog.
 */
function train_theme_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'train_theme_categories' );
}
add_action( 'edit_category', 'train_theme_category_transient_flusher' );
add_action( 'save_post',     'train_theme_category_transient_flusher' );