<!--manage content for index--> 


    <a href="<?php echo esc_url(get_permalink()); ?>">
  
<?php


if ( has_post_thumbnail() ) {
    the_post_thumbnail('full', array('class' => 'card-img img-fluid'));
}

$categories = get_the_category();
$category_text = '';
    if ( ! empty( $categories ) ) {
    foreach ( $categories as $category ) {
    $category_text .= $category->name . ', ';
    }
// Elimina la última coma y espacio
$category_text = rtrim($category_text, ', ');
//prevent form being uncategorized
if ($category_text === "Uncategorized"){
    $category_text = "";
}
}

echo '<h5 class="card-title">' . get_the_title(). '</h5>';



 echo '<p class="card-p">' . $category_text . '</p>';

?>
  <div class="bg-filter"></div>
</a>

