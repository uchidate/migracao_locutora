<?php
function locutora_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    register_nav_menus( array(
        'main-menu' => __( 'Menu principal', 'locutora' ),
    ) );
}
add_action( 'after_setup_theme', 'locutora_theme_setup' );

function locutora_scripts() {
    wp_enqueue_style( 'locutora-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'locutora-style', get_stylesheet_uri(), array( 'locutora-fonts' ), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'locutora-site', get_template_directory_uri() . '/assets/js/site.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'locutora_scripts' );

// Remove estilos padrão do Gutenberg no frontend — usamos só o nosso style.css
function locutora_dequeue_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'locutora_dequeue_block_styles', 100 );

function locutora_asset( $path ) {
    return get_template_directory_uri() . '/assets/site-images/' . ltrim( $path, '/' );
}

// ─── Criação de páginas e menu na ativação do tema ───────────────────────────

function locutora_create_page( $title, $slug, $template = '' ) {
    $page = get_page_by_path( $slug );
    if ( $page ) {
        if ( $template ) {
            update_post_meta( $page->ID, '_wp_page_template', $template );
        }
        return $page->ID;
    }
    $existing = get_page_by_title( $title );
    if ( $existing ) {
        wp_update_post( array( 'ID' => $existing->ID, 'post_name' => $slug ) );
        if ( $template ) {
            update_post_meta( $existing->ID, '_wp_page_template', $template );
        }
        return $existing->ID;
    }
    $page_id = wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
    ) );
    if ( $page_id && ! is_wp_error( $page_id ) && $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }
    return $page_id;
}

function locutora_activate_theme() {
    $home_id     = locutora_create_page( 'Início', 'inicio' );
    $about_id    = locutora_create_page( 'Sobre nós', 'sobre-nos', 'page-sobre-nos.php' );
    $services_id = locutora_create_page( 'Áudios', 'servicos', 'page-servicos.php' );
    $contact_id  = locutora_create_page( 'Contato', 'contato', 'page-contato.php' );

    if ( $home_id && ! is_wp_error( $home_id ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }

    $menu_name = 'Menu Locutora';
    $menu      = wp_get_nav_menu_object( $menu_name );
    if ( ! $menu ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        $items   = array(
            $home_id     => 'Início',
            $about_id    => 'Sobre nós',
            $services_id => 'Áudios',
            $contact_id  => 'Contato',
        );
        foreach ( $items as $page_id => $label ) {
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $label,
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $page_id,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ) );
            }
        }
        set_theme_mod( 'nav_menu_locations', array( 'main-menu' => $menu_id ) );
    }
}
add_action( 'after_switch_theme', 'locutora_activate_theme' );
