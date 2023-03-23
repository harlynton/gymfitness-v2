<?php 

// Includes
require get_template_directory() . '/includes/widgets.php';

function gymfitness_setup() {
    //Imágenes destacadas
    add_theme_support('post-thumbnails');

    //Títulos para SEO
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'gymfitness_setup');

function gymfitness_menus() {
    register_nav_menus( array(
        'menu-principal' => __('Menu Principal', 'gymfitness')
    ));
}

add_action('init', 'gymfitness_menus');

function gymfitness_scripts_styles() {
    // Archivos CSS
    wp_enqueue_style('normalize','https://necolas.github.io/normalize.css/8.0.1/normalize.css', array(),'8.0.1');
    wp_enqueue_style('lightboxcss', get_template_directory_uri() . '/css/lightbox.css', array(), '2.11.4' );
    wp_enqueue_style('style',get_stylesheet_uri(), array('normalize'), '1.0.0');

    //Archivos JS
    wp_enqueue_script('lightboxjs', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '2.11.4', true);
}

add_action('wp_enqueue_scripts', 'gymfitness_scripts_styles');

// Definición de zona de widgets:
function gymfitness_widgets() {
    register_sidebar(array(
        'name' => 'Sidebar Posts',
        'id' => 'sidebar_posts',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center text-primary">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => 'Sidebar Clases',
        'id' => 'sidebar_clases',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center text-primary">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init','gymfitness_widgets');

// Crear shortcode para Leaflet map:
function gymfitness_ubicacion_shortcode(){
?>
    <div class="mapa">
        <?php
        if(is_page('contacto')) {
            the_field('ubicacion');
        }
        ?>
    </div>
    <h2 class="text-center text-primary">Formulario de Contacto</h2>
<?php
    echo do_shortcode('[contact-form-7 id="86" title="Contact form"]');
}
add_shortcode('gymfitness_ubicacion', 'gymfitness_ubicacion_shortcode');