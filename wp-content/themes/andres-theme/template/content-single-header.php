<div class="card-body">

<?php
    
    if ( has_post_thumbnail() ) {
        the_post_thumbnail('full', array('class' => 'card-img img-fluid'));
    }


    echo '<div class="d-flex card-title-post-container justify-content-between align-items-center">
          

            <h5 class="card-title-post">' . 
            get_the_title() . 
            '</h5>
        

          
        
        </div>'


?>

<div class="bg-filter"></div>

</div>
