<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

    <?php get_sidebar(); ?>

<?php endif; ?>
    <div id="primary" <?php astra_primary_class(); ?>>
        <?php
        astra_primary_content_top();

        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $args = [
            'post_type' => 'proyectos',
            'posts_per_page' => 5,
            'paged' => $paged,
        ];
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : ?>
            <div>
                <ul>
                    <div class="card-container">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <li class="card">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail($post->ID); ?>
                                    <div>
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </div>
                </ul>
            </div>
            <div>
                <?php
                echo paginate_links(
                    array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'format' => '?paged=%#%',
                    )
                );
                ?>
            </div>
        <?php endif;
        wp_reset_postdata();

        astra_content_loop();

        astra_pagination();

        astra_primary_content_bottom();
        ?>
    </div><!-- #primary -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :

    get_sidebar();

endif;

get_footer();