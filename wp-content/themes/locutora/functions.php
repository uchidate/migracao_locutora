<?php
function locutora_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
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

function locutora_asset( $path ) {
    return get_template_directory_uri() . '/assets/site-images/' . ltrim( $path, '/' );
}

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
        wp_update_post(
            array(
                'ID'        => $existing->ID,
                'post_name' => $slug,
            )
        );

        if ( $template ) {
            update_post_meta( $existing->ID, '_wp_page_template', $template );
        }

        return $existing->ID;
    }

    $page_id = wp_insert_post(
        array(
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        )
    );

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
                wp_update_nav_menu_item(
                    $menu_id,
                    0,
                    array(
                        'menu-item-title'     => $label,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $page_id,
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                    )
                );
            }
        }

        set_theme_mod( 'nav_menu_locations', array( 'main-menu' => $menu_id ) );
    }
}
add_action( 'after_switch_theme', 'locutora_activate_theme' );

// Páginas com template PHP próprio são gerenciadas via arquivo — desativa Gutenberg
// e exibe aviso no admin para evitar confusão com editor vazio.
function locutora_disable_gutenberg( $use_block_editor, $post ) {
    if ( $post->post_type !== 'page' ) {
        return $use_block_editor;
    }

    $php_templates = array(
        '',                   // front-page (sem template atribuído, usa front-page.php)
        'front-page.php',
        'page-sobre-nos.php',
        'page-servicos.php',
        'page-contato.php',
    );

    $template = get_post_meta( $post->ID, '_wp_page_template', true );

    // Página inicial: page_on_front sem template explícito usa front-page.php
    $front_page_id = (int) get_option( 'page_on_front' );
    if ( $post->ID === $front_page_id || in_array( $template, $php_templates, true ) ) {
        return false;
    }

    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'locutora_disable_gutenberg', 10, 2 );

function locutora_admin_template_notice() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->base !== 'post' || $screen->post_type !== 'page' ) {
        return;
    }

    global $post;
    if ( ! $post ) {
        return;
    }

    $php_templates = array( '', 'front-page.php', 'page-sobre-nos.php', 'page-servicos.php', 'page-contato.php' );
    $template      = get_post_meta( $post->ID, '_wp_page_template', true );
    $front_page_id = (int) get_option( 'page_on_front' );

    if ( $post->ID !== $front_page_id && ! in_array( $template, $php_templates, true ) ) {
        return;
    }

    $file = $post->ID === $front_page_id ? 'front-page.php' : $template;
    echo '<div class="notice notice-info"><p>'
        . '<strong>Esta página é controlada pelo tema.</strong> '
        . 'O conteúdo é definido no arquivo <code>' . esc_html( $file ) . '</code> — edite o arquivo para alterar o layout e o texto.'
        . '</p></div>';
}
add_action( 'admin_notices', 'locutora_admin_template_notice' );
