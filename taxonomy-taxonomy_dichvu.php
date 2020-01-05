<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package awatech
 */

get_header();
$currentTaxonomyId = get_queried_object()->term_id;
?>
    <div class="category-type" style="background-image:url(<?php echo get_template_directory_uri();?>/image/panel-title.jpg)">
        <div class="container">
            
            <div class="wc">
                <h1 class="title">DỊCH VỤ MÔI TRƯỜNG</h1>

                <div class="wc-inner">
                    <ul class="list-item">

                        
                        <?php
                        // WP_Query arguments
                            $args = array(
                                'post_type'              => array( 'dichvu' ),
                                'post_status'            => array( 'publish' ),
                                'posts_per_page'         => '-1',
                                'orderby'                => 'date',
                                'order'                  => 'ASC',
                            );
                            $terms = get_terms( 'taxonomy_dichvu' );
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                foreach ( $terms as $term ) {
                                    $term_get_link = get_term_link($term, $tax_name);
                                    $taxId = $term->term_id;
                                ?>
                                    <li class = "<?php echo $taxId == $currentTaxonomyId ? "active" : ""; ?>">
                                        <a href="<?php echo esc_url($term_get_link);?>" title="<?php echo esc_html($term->name); ?>"><?php echo esc_html($term->name);?></a>
                                    </li>
                                <?php
                                }
                            }
                            // The Query
                            $query = new WP_Query( $args );

                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                        $query->the_post();
                                        $postId = get_the_ID();
                        ?>
                        
                            

                        <?php
                                }
                            } else {
                                // no posts found
                            }

                            // Restore original Post Data
                            wp_reset_postdata();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="category-sub">
            <ul class="list-sub-item">
                    
                    <?php
                    // WP_Query arguments
                        $args = array(
                            'post_type' => array( 'dichvu' ),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'taxonomy_dichvu',
                                    'field' => 'id',
                                    'terms' => $currentTaxonomyId
                                )
                            )
                        );

                        // The Query
                        $query = new WP_Query( $args );

                        // The Loop
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                // do something
                        ?>
                            <li class="">
                                <a class="" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                            </li>
                        <?php
                            }
                        } else {
                            // no posts found
                        }

                        // Restore original Post Data
                        wp_reset_postdata();
                    ?>
            </ul>
    </div>
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <div class="container">

            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </div>
	<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section id="columns" class="columns-home container">
                <div class="row columns-home-row">
                    <?php if ( have_posts() ) : ?>

                    

                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/content', 'dichvu' );

                        endwhile;

                        the_posts_navigation();

                        else :

                        get_template_part( 'template-parts/content', 'none' );

                        endif;
                    ?>
                </div>
            </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();