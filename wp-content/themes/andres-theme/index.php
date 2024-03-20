<?php get_header(); ?>
<main>

<div class="row">
    <div class="col-xs-12 mt-5">



        <?php
        
        //settings for pagination
        $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1 ;
        $args = array('posts_per_page'=>3, 'paged'=> $currentPage);
        query_posts($args); 

        $postCount = 0;


        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
            $postCount++;
            $animationClass = ( $postCount % 2 === 0 ) ? "coming-animation-left" : "coming-animation-right";
             
             ?>
             <div class="card-body <?php echo $animationClass ?>">
              <?php get_template_part("template-parts/content"); ?>
        </div> 
             

        <?php
            endwhile;
            endif;
        ?>
   
    </div>
</div>


<div class="col-xs-12 d-flex justify-content-between">
    <div class="prev-next-links"><?php next_posts_link("<< Posteos anteriores") ?></div>
    <div class="prev-next-links"><?php previous_posts_link("Posteos más recientes >>") ?></div>
</div>

</main>



<?php get_footer();  ?>

