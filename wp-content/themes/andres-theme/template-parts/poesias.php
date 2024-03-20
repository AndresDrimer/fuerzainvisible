<?php get_header(); ?>

<main>
    <div class="container">
        <?php
            $category_slug = 'poesias'; //slug: biografias

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
            $query = new WP_Query($args);?>

<?php
            if( $query->have_posts() ):
                $post_count = 0;
                echo '<div class="row">'; // open a new row

                while( $query->have_posts() ): $query->the_post(); 
                    $post_count++;
                    
                    // new row every 3 times
                    if ($post_count % 3 == 1) {
                        echo '<div class="row">';
                    }
        ?>

            <div class="col-sm-6 col-md-4 col-xs-12 mt-5">
               
                <?php get_template_part("template-parts/content", "poesias-cards"); ?>

                <p class="text-end tag-author-poesias"><?php the_tags(""); ?></p>

                <p class="text-muted excerpt-poesias"><?php the_excerpt(); ?></p>
                
                <a href="<?php the_permalink(); ?>" class="tag-author-poesias">+ Leer más</a>
            </div>

        <?php 
            // close row´s container every 3 times
            if ($post_count % 3 == 0) {
                echo '</div>'; // Cierra el contenedor de fila
            }
            endwhile; 

           
            if ($post_count % 3 != 0) {
                echo '</div>'; // close last row´s container
            }
        ?>
    </div> <!-- Cierra el container -->
</main>

<?php   
    endif;
    wp_reset_postdata(); 
    ?>

<?php get_footer(); ?>
