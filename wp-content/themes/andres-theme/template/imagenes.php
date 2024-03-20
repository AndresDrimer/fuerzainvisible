<?php

    get_header(); ?>

<main>
<?php
        
        $category_slug = 'imagenes'; 

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
        <div class="col-xs-12">

        <?php get_template_part("template/content", "poesias-cards") ?>
          

      
        

        </div>


    </div>


    <?php endwhile; 
            endif; 
            wp_reset_postdata(); ?>
</main>
    <?php get_footer();  ?>