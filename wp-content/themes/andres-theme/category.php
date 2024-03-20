<?php
if (is_category()) {
    // Obtiene el slug de la categoría actual
    $category_slug = get_queried_object()->slug;

    // Personaliza la página según el slug de la categoría
    if ($category_slug == 'poesias') { 
        get_template_part("template/poesias");
    } elseif ($category_slug == 'biografias') { 
        get_template_part("template/biografias");
    } elseif ($category_slug == 'imagenes') { 
        get_template_part("template/imagenes");
    }
}
?>