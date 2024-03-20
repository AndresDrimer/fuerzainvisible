<?php

/*
    ==============================
    connect style and scripts
    ===============================
*/
function enqueue_custom_styles_and_scripts(){
    
   
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.3', 'all');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.3.3', true); 
    
    wp_register_script('custom-js', get_template_directory_uri() . '/assets/js/custom-js.js', array(), '1.0.0', true);
    wp_enqueue_script('custom-js');
    
    wp_register_style('custom-css', get_template_directory_uri() . "/assets/css/custom-css.css", array(), '1.0.0', 'all');
    wp_enqueue_style('custom-css');

}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles_and_scripts');

/*
    ==============================
    add bootstrap´s walker
    ===============================
*/

function register_navwalker() {
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

/*
    ==============================
    head function to not show WP´s version
    ===============================
*/
function remove_version(){
    return "";
}
add_filter('the_generator', 'remove_version');

/*
    ==============================
    add menu
    ===============================
*/

function andrestheme_setup(){
    register_nav_menu("primary", "Menu Primario");
    register_nav_menu("secondary", "Menu Secundario");
}

add_action("init", "andrestheme_setup");



/*
    ==============================
    create categories
    ===============================
*/


function crear_categoria_programaticamente() {
    // Categoría "Biografías"
    $nombre_categoria = 'Biografías';
    $slug_categoria = 'biografias';
    $descripcion_categoria = '';
    crear_categoria($nombre_categoria, $slug_categoria, $descripcion_categoria);

    // Categoría "Imágenes"
    $nombre_categoria = 'Imágenes';
    $slug_categoria = 'imagenes';
    $descripcion_categoria = '';
    crear_categoria($nombre_categoria, $slug_categoria, $descripcion_categoria);

    // Categoría "Poesías"
    $nombre_categoria = 'Poesías';
    $slug_categoria = 'poesias';
    $descripcion_categoria = '';
    crear_categoria($nombre_categoria, $slug_categoria, $descripcion_categoria);
}

function crear_categoria($nombre_categoria, $slug_categoria, $descripcion_categoria) {
    if (!term_exists($nombre_categoria, 'category')) {
        wp_insert_term($nombre_categoria, 'category', array(
            'slug' => $slug_categoria,
            'description' => $descripcion_categoria
        ));
    }
}

add_action('init', 'crear_categoria_programaticamente');


/*
    ==============================
    add categories to menu
    ===============================
*/


function crear_menu_programaticamente() {
    // Nombre del menú
    $nombre_menu = 'Menú Principal';

    // Verifica si el menú ya existe
    if (!wp_get_nav_menu_object($nombre_menu)) {
        // Crea el menú
        $menu_id = wp_create_nav_menu($nombre_menu);

        // Asigna el menú como el menú principal
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    } else {
        $menu_id = wp_get_nav_menu_object($nombre_menu)->term_id;
    }

    // Verifica si el elemento "Home" ya existe en el menú
    $menu_items = wp_get_nav_menu_items($menu_id);
    $home_ya_en_menu = false;
    foreach ($menu_items as $item) {
        if ($item->title == 'Home') {
            $home_ya_en_menu = true;
            break;
        }
    }

    // Solo agrega el elemento "Home" si no está ya en el menú
    if (!$home_ya_en_menu) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Home',
            'menu-item-url' => home_url(),
            'menu-item-status' => 'publish'
        ));
    }

    // Agrega las categorías al menú
    $categorias = array('poesias', 'biografias', 'imagenes');
    foreach ($categorias as $categoria) {
        $categoria_obj = get_category_by_slug($categoria);
        if ($categoria_obj) {
            // Verifica si la categoría ya está en el menú
            $categoria_ya_en_menu = false;
            foreach ($menu_items as $item) {
                if ($item->url == get_category_link($categoria_obj->term_id)) {
                    $categoria_ya_en_menu = true;
                    break;
                }
            }

            // Solo agrega la categoría si no está ya en el menú
            if (!$categoria_ya_en_menu) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => $categoria_obj->name,
                    'menu-item-url' => get_category_link($categoria_obj->term_id),
                    'menu-item-status' => 'publish'
                ));
            }
        }
    }
}
add_action('init', 'crear_menu_programaticamente');




/*
    ==============================
    add funcionalities for posts
    ===============================
*/

add_theme_support('post-thumbnails');

/*
    ==============================
    remove links form contents
    ===============================
*/
add_filter('the_content', 'removelink_content', 1);

function removelink_content($content = '') {
    preg_match_all("#<a(.*?)>(.*?)</a>#i", $content, $matches);
    $num = count($matches[0]);
    for($i = 0; $i < $num; $i++){
        $content = str_replace($matches[0][$i], $matches[2][$i], $content);
    }
    return $content;
}

/*
    ==============================
    create access for tags like /tag/{tag_slug}
    ===============================
*/


function custom_rewrite_rule() {
    add_rewrite_rule('^tag/([^/]*)/?', 'index.php?tag=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_rule');

/*
    ==============================
    make required feature image for each new post: it keeps it draft until added.
    ===============================
*/

add_filter('wp_insert_post_data', function ($data, $postarr) {
    $post_id = $postarr['ID'];
    $post_status = $data['post_status'];
    // Verifica si 'original_post_status' existe en $postarr
    $original_post_status = isset($postarr['original_post_status']) ? $postarr['original_post_status'] : null;

    // Verifica si el post está siendo creado (no actualizado)
    if ($post_id && 'publish' === $post_status && 'publish' !== $original_post_status) {
        $post_type = get_post_type($post_id);
        // Verifica si el post no tiene una imagen destacada
        if (post_type_supports($post_type, 'thumbnail') && !has_post_thumbnail($post_id)) {
            $data['post_status'] = 'draft';
            // Guarda el ID del post en una variable de sesión para usarlo en admin_notices
            $_SESSION['post_id_without_featured_image'] = $post_id;
        }
    }
    return $data;
}, 10, 2);


