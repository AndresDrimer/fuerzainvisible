
<div class="card-body">
    <a href="<?php echo esc_url(get_permalink()); ?>">

<?php


if ( has_post_thumbnail() ) {
    the_post_thumbnail('full', array('class' => 'card-img img-fluid'));
}


echo '<h5 class="card-title-poesias">' . get_the_title(). '</h5>';





?>
  <div class="bg-filter"></div>
</a>

</div>