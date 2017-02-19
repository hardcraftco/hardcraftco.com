<?php

/**
 * Template Name: Fullwidth page
 * The template used for displaying fullwidth page content in fullwidth.php
 *
 * @package Train
 * @since   1.0.8
 */

get_header(); ?>
<section class="page-section">
  <div class="container">
    <div class="row">
      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-12 detail-content">
          <div class="page-title">
            <h1><?php the_title(); ?></h1>
          </div>
          <div class="single-post">
            <div class="content-wrapper">
            <div class="post-content">
              <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <figure>
                  <?php the_post_thumbnail('full'); ?>
                </figure>
              <?php endif; ?>       
              <article>
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'train' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
              </article> <!-- /.end of article -->
            </div> <!-- /.end of post-content -->
          </div>
            <div class="entry-meta">
              <?php edit_post_link( __( 'Edit', 'train' ), '<span class="edit-link">', '</span>' ); ?>

            </div><!-- .entry-meta -->
          </div> <!-- /.end of single-post -->
          <div class="clearfix"></div>           
          <div class="comments">
            <div class="comment-title">
              <ul class="list-inline">
                <li><i class="fa fa-comments"> <?php comments_popup_link(esc_html__('No comment','train'),esc_html__('1 comment','train'), esc_html__('% comments','train'));?></i></li>
                <li class="pull-right">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="comment-single">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php _e('Leave a Comment','train');?> <i class="fa fa-pencil"></i>
                            </a>
                          </h4>
                        </div> <!-- end of panel-heading -->
                        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                              <?php comments_template(); ?>
                            </div> <!-- end of panel-body -->
                        </div> <!-- end of colapseone -->
                      </div> <!-- end of comment-single -->
                    </div> <!-- end of panel-default -->
                  </div> <!-- end of panel-group-accordian -->
                </li> <!-- end of pull-right -->
              </ul> <!-- end of list-inline -->
            </div> <!-- end of comment-title -->
          </div> <!-- end of comments -->
        </div> <!-- /.end of detail-content -->

      <?php endwhile; // end of the loop. ?>                

    </div>        
  </div>
</section>
<?php get_footer(); ?>