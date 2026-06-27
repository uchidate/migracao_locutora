<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="container">
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        <img src="<?php echo esc_url( locutora_asset( 'logotipo-adriana-rosa-branco.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    </a>
                <?php endif; ?>
            </div>
            <button class="menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-navigation">
                <?php
                if ( has_nav_menu( 'main-menu' ) ) {
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'menu-items'
                    ));
                } else {
                    $fallback = array(
                        'Início' => home_url('/'),
                        'Sobre nós' => home_url('/sobre-nos'),
                        'Áudios' => home_url('/servicos'),
                        'Contato' => home_url('/contato'),
                    );
                    foreach ($fallback as $label => $link) {
                        echo '<a href="' . esc_url($link) . '">' . esc_html($label) . '</a>';
                    }
                }
                ?>
            </nav>
        </div>
    </header>
