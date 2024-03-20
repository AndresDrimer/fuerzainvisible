<?php
/**
 * The Search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TuNombreDeTema
 */
get_header();
?>
<div class="content-container">
    <h1 class="page-title"><?php _e( 'Search results for:', 'tu-text-domain' ); ?></h1>
    <div class="search-query"><?php echo get_search_query(); ?></div>    
    <div class="container">
        <div class="row">
            <div class="search-results-container col-md-8">
            <?php if ( have_posts() ): ?>
                <?php while( have_posts() ): ?>
                    <?php the_post(); ?>
                    <div class="search-result">
                        <h2><?php the_title(); ?></h2>
                    </div>
                <?php endwhile;endif; ?>
              
        </div>
    </div>
</div>
<?php get_footer(); ?>