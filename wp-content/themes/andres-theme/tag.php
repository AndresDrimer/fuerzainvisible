<?php get_header(); ?>
<main>

<div class="row">
    <div class="col-xs-12 mt-5">



        <?php
        
        //settings for pagination
        $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1 ;
        $args = array('posts_per_page'=>3, 'paged'=> $currentPage);
        query_posts($args); 

        $a = get_the_tags();
        if ($a && isset($a[0])) {
            $tag_slug = $a[0]->slug;
        
            $args = array(  
                'tag' => $tag_slug, // 
            );
            
            $query = new WP_Query($args);}

        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
              
              get_template_part("template/content") ?>

        <?php
            endwhile;
            endif;
        ?>
   
    </div>
</div>

<?php  if ($query->max_num_pages > 1) : ?>
    <div class="col-xs-12 d-flex justify-content-between">
         <div class="prev-next-links"><?php next_posts_link("<< Posteos anteriores") ?></div>
        <div class="prev-next-links"><?php previous_posts_link("Posteos más recientes >>") ?></div>
    </div>
<?php endif; ?>
</main>

<?php wp_reset_postdata(); ?>

<?php get_footer();  ?>

