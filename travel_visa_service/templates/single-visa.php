<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

//				get_template_part( 'template-parts/post/content', get_post_format() );
                        
                        
                            
                            ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php
                                    if ( is_sticky() && is_home() ) :
                                            echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
                                    endif;
                                    ?>
                                    <header class="entry-header">
                                            <?php
                                            if ( 'post' === get_post_type() ) {
                                                    echo '<div class="entry-meta">';
                                                            if ( is_single() ) {
                                                                    twentyseventeen_posted_on();
                                                            } else {
                                                                    echo twentyseventeen_time_link();
                                                                    twentyseventeen_edit_link();
                                                            };
                                                    echo '</div><!-- .entry-meta -->';
                                            };

                                            if ( is_single() ) {
                                                    the_title( '<h1 class="entry-title">', '</h1>' );
                                            } elseif ( is_front_page() && is_home() ) {
                                                    the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                                            } else {
                                                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                            }
                                            ?>
                                    </header><!-- .entry-header -->

                                    <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
                                            <div class="post-thumbnail">
                                                    <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
                                                    </a>
                                            </div><!-- .post-thumbnail -->
                                    <?php endif; ?>

                                    <div class="entry-content">
                                            <?php
                                            /* translators: %s: Name of current post */
                                            the_content( sprintf(
                                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                                                    get_the_title()
                                            ) );

                                            wp_link_pages( array(
                                                    'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
                                                    'after'       => '</div>',
                                                    'link_before' => '<span class="page-number">',
                                                    'link_after'  => '</span>',
                                            ) );
                                            ?>
                                    </div><!-- .entry-content -->

                                    <?php
                                    if ( is_single() ) {
                                            twentyseventeen_entry_footer();
                                    }
                                    ?>

                            </article><!-- #post-## -->
                            <?php
                            
                        

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
