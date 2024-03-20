<?php get_header(); ?>
<main>

<div class="row">
    <div class="col-xs-12 mt-5">



        <?php
        
        //settings for pagination
        $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1 ;
        $args = array('posts_per_page'=>3, 'paged'=> $currentPage);
        query_posts($args); 



        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              
              get_template_part("template/content") ?>

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

