<?php

    get_header(); ?>

<main class="mt-5">
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
       
        $postCount = 0;


        if( $query->have_posts() ):
            while( $query->have_posts() ): $query->the_post(); $postCount++;
            $animationClass = ( $postCount % 2 === 0 ) ? "coming-animation-left" : "coming-animation-right";
             
             ?>
             
  
    <div class="row">
        <div class="col-xs-12 ">
        <div class="card-body <?php echo $animationClass ?>">
        <?php get_template_part("template-parts/content", "imagenes") ?>
        </div>
          

      
        

        </div>


    </div>


    <?php endwhile; 
            endif; 
            wp_reset_postdata(); ?>
</main>
    <?php get_footer();  ?>