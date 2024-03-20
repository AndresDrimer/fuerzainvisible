<?php get_header(); ?>

<div class="row">
    <div class="col-xs-12 mt-5">


        <?php



while(  have_posts() ): the_post(); ?>

        <article class="mb-5" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


            <?php 
get_template_part("template-parts/content-single", "single-header"); 
?>

            <!--category and tag links-->
            <div class="col-xs-12 d-flex justify-content-end">
                <small>
                <div class="col-xs-12 d-flex justify-content-end">
    <small>
        <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    // Obtiene el objeto de la categoría por su slug
                    $category_obj = get_category_by_slug($category->slug);
                  
                    if ($category_obj) {
                        // Obtiene el enlace a la categoría usando el ID del objeto de la categoría
                        $category_link = get_category_link($category_obj->term_id);
                        echo '<a href="' . esc_url($category_link) . '">' . $category->name . '</a>';
                    }
                }
            }
            echo " // ";
            $tags = get_the_tags();
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    // Obtiene el enlace al tag usando el ID del objeto del tag
                    $tag_link = get_tag_link($tag->term_id);
                    echo '<a href="' . esc_url($tag_link) . '">' . $tag->name . '</a>';
                }
            }
        ?>
                </small>

            </div>

            <!--content and image-->
            <div class="mt-5 pr-5 mb-5">
                <?php the_content();?>
            </div>

            <div class="row">

                <?php 
                
                
                //prevents posts with category 22 (slug:imagenes) to show their the thumbnail
                $categories = get_the_category();

                $show_thumbnail = true;
                    foreach ($categories as $category) {
                        if ($category->term_id == 22) {
                            $show_thumbnail = false;
                            break;
                        }
                    }
                            
                
                
                if( $show_thumbnail && has_post_thumbnail() ): ?>

                <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
                <?php if ( has_post_thumbnail() ) {
                    $caption = get_the_post_thumbnail_caption() ?? "";
                    if($caption){
                    echo '<p class="img-caption">@' . $caption . '</p>';}
                }?>


                <?php  endif; ?>

            </div>



        </article>

        <?php endwhile;
wp_reset_postdata(); ?>

        <?php get_footer(); ?>








        <?php /*
    <div class="row">
        <div class="col-xs-6 text-left"><?php previous_post_link(); ?>
    </div>
    <div class="col-xs-6 text-right"><?php next_post_link(); ?></div>
</div>



<?php  if( comments_open()){
        comments_template();
    }else{echo '<h5 class="text-center">can´t show comments</h5>';} ?>
*/?>