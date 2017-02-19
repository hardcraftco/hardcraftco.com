<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package Train
 * @since  1.0.10
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<header>       
    <section class="top-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                <h2 class="hidden">Top</h2>
                    <ul class="list-inline">
                    <?php if(esc_attr(get_theme_mod('top_email'))): ?>

                      <li><a href="<?php echo esc_attr(get_theme_mod( 'top_email', __('mailto:info@example.com','train' ))); ?>" title=""><i class="fa fa-envelope"></i> <?php echo esc_attr(get_theme_mod( 'top_email')); ?></a></li>
                  <?php endif; ?>
                    <?php if(esc_attr(get_theme_mod('top_phone'))): ?>

                      <li><a href="" title=""><i class="fa fa-phone"></i> <?php echo esc_attr(get_theme_mod( 'top_phone', __('(123)-123-1234','train' ))); ?></a></li>
                  <?php endif;?>
                    </ul>

                </div>

                <div class="col-sm-4 text-right hidden-xs">
                    <?php if ( get_theme_mod( 'header_socialicon_display','1' ) ) : ?>
                        <ul class="list-inline">
                            <?php if ( get_theme_mod( 'facebook_textbox1','#' ) ) : ?>
                                <li><a href="<?php echo  esc_url( get_theme_mod( 'facebook_textbox1','#' ) )?>" title="<?php esc_url( get_theme_mod( 'facebook_textbox1','#' ) )?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'twitter_textbox1','#' ) ) : ?>
                                <li><a href="<?php echo  esc_url( get_theme_mod( 'twitter_textbox1','#' ) )?>" title="<?php esc_url( get_theme_mod( 'twitter_textbox1','#' ) )?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'googleplus_textbox1','#' ) ) : ?>
                                <li><a href="<?php  echo esc_url( get_theme_mod( 'googleplus_textbox1' ) )?>" title="<?php esc_url( get_theme_mod( 'googleplus_textbox1','#' ) )?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>

                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'skype_textbox1','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'skype_textbox1','#' ) )?>" title="<?php esc_url( get_theme_mod( 'skype_textbox1','#' ) )?>" target="_blank"><i class="fa fa-skype"></i></a></li>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'linkedin_textbox1','#' ) ) : ?>
                                <li><a href="<?php echo   esc_url( get_theme_mod( 'linkedin_textbox1' ) )?>" title="<?php esc_url( get_theme_mod( 'linkedin_textbox1','#' ) )?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>

                    </div> <!-- /.end of col-sm-4 -->
        </div> <!-- /.end of row -->
        </div> <!-- /.end of container -->
    </section> <!-- /.end of section -->
    <section class="logo-menu"  >
        <div class="container">
            <div class="row">
                    <div class="col-sm-3">
            <?php
              if (has_custom_logo()):
            ?>
              <div class="logo">
                <?php the_custom_logo(); ?>
              </div>
              <?php endif; ?>
             <?php $description = get_bloginfo( 'description', 'display' ); ?>
                    <?php if ( $description || is_customize_preview() ) : ?>
                <div class="logo">
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                    rel="home"><?php bloginfo('name'); ?></a></h1>
                    <p class="site-description"><?php bloginfo('description');?></p>
                </div>
                <?php endif;?>
                <div class="clearfix"></div>
            
                </div> <!-- /.end of col-sm-3 -->
                <div class="col-sm-9">
                        <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only"><?php __('Toggle navigation','train'); ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>    

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div  class="navbar-form navbar-left">
                                <div class="nav pull-right">
                                    <div class="main-search">
                                        <button class="btn btn-search" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                          <i class="fa fa-search search-icon"></i>
                                        </button>
                                        <div class="collapse" id="collapseExample">
                                                <div class="well search-well">
                                                     <?php get_search_form(); ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <nav>
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                    <?php
                                    wp_nav_menu( array(
                                            'menu'              => 'primary',
                                            'theme_location'    => 'primary',
                                            'depth'             => 8,
                                            'container'         => 'div',
                                            'items_wrap'      => '<ul id="main-search" class="nav navbar-nav navbar-right">%3$s</ul>',
                                            'menu_class'        => 'nav navbar-nav navbar-right',
                                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                            'walker'            => new wp_bootstrap_navwalker())
                                    );

                                    ?>
                                <?php else : ?>
                                    <ul class="nav navbar-nav navbar-right main-menu">
                                        <?php
                                        $args = array(
                                            'depth'        => 0,
                                            'echo'         => 1,
                                            'post_type'    => 'page',
                                            'post_status'  => 'publish',
                                            'show_date'    => '',
                                            'sort_column'  => 'menu_order',
                                            'title_li'     => __('','train'),
                                            'walker'       => new Train_Walker_Page
                                        );
                                        wp_list_pages( $args );
                                        ?>
                                    </ul>
                                <?php endif; ?>
                            </nav>
                        </div> <!-- /.end of collaspe navbar-collaspe -->
                    </nav>
                </div> <!-- /.end of col-sm-9 -->
            </div> <!-- /.end of row -->
        </div> <!-- /.end of container -->
    </section> <!-- /.end of section -->
</header>