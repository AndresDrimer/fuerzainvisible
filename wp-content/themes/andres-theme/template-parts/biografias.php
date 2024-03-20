<?php
    //page biografias

    get_header(); ?>

<main>
<?php
        
        $category_slug = 'biografias'; //slug: biografias

        $args = array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category', 
                    'field'    => 'slug', // Cambiado de 'term_id' a 'slug'
                    'terms'    => $category_slug, // Ahora se usa el slug
                ),
            ),
            //'posts_per_page' => 10, 
        );
        $query = new WP_Query($args);
        
        if( $query->have_posts() ):
            while( $query->have_posts() ): $query->the_post(); 
?>
    <div class="row">
        <div class="col-xs-12 mt-5 mb-5">
            <a href="<?php echo esc_url( get_permalink() ); ?>">

                <h3 class="bio-title"><?php the_title(); ?></h3>

                <div class="thumbnail-img"> <?php the_post_thumbnail('medium') ?>
            </a>

            <p class="bio-excerpt"> <?php the_excerpt(); ?></p>
            <hr>

        </div>
        <a href="<?php the_permalink(); ?>" class="tag-author-poesias">+ Leer más</a>

    </div>


    <?php endwhile; 
            endif; 
            wp_reset_postdata(); ?>
</main>
    <?php get_footer(); ?>
