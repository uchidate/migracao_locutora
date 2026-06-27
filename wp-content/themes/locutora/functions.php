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

// Lê um campo editável da página. Retorna o valor salvo ou o $fallback se vazio.
function locutora_field( $key, $fallback = '' ) {
    global $post;
    if ( ! $post ) {
        return $fallback;
    }
    $value = get_post_meta( $post->ID, 'lc_' . $key, true );
    return ( $value !== '' && $value !== false ) ? $value : $fallback;
}

// ─── Meta boxes ──────────────────────────────────────────────────────────────

function locutora_register_meta_boxes() {
    $front_page_id = (int) get_option( 'page_on_front' );

    add_meta_box(
        'lc_home_fields',
        '✏️ Conteúdo da Página Inicial',
        'locutora_home_meta_box',
        'page',
        'normal',
        'high',
        array( 'page_id' => $front_page_id )
    );

    add_meta_box(
        'lc_about_fields',
        '✏️ Conteúdo da Página Sobre Nós',
        'locutora_about_meta_box',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'locutora_register_meta_boxes' );

// Mostra o meta box do home apenas na página inicial
function locutora_home_meta_box( $post, $args ) {
    $front_page_id = (int) get_option( 'page_on_front' );
    if ( $post->ID !== $front_page_id ) {
        return;
    }

    wp_nonce_field( 'lc_home_save', 'lc_home_nonce' );

    $fields = array(
        array( 'key' => 'hero_title',       'label' => 'Título principal (hero)',         'type' => 'text',     'default' => 'Locutora Profissional' ),
        array( 'key' => 'hero_subtitle',    'label' => 'Subtítulo (hero)',                'type' => 'text',     'default' => 'Gravação de voz para publicidade, TV, rádio, URA, vídeos institucionais e internet.' ),
        array( 'key' => 'about_tagline',    'label' => 'Chamada da seção "Sobre"',        'type' => 'text',     'default' => 'Voz com credibilidade e impacto para a sua marca' ),
        array( 'key' => 'about_p1',         'label' => 'Parágrafo 1 — Apresentação',     'type' => 'textarea', 'default' => 'Sou Adriana Rosa, locutora profissional atuando no mercado desde 2004, especializada em gravação de voz para campanhas publicitárias, vídeos institucionais, URA, espera telefônica, conteúdos corporativos e projetos digitais.' ),
        array( 'key' => 'about_p2',         'label' => 'Parágrafo 2 — Experiência',      'type' => 'textarea', 'default' => 'Ao longo de mais de duas décadas de experiência, atendi empresas, agências e produtoras em todo o Brasil e exterior, sempre com qualidade profissional e entrega rápida.' ),
        array( 'key' => 'about_p3',         'label' => 'Parágrafo 3 — Como funciona',    'type' => 'textarea', 'default' => 'Você envia o roteiro e recebe uma voz pronta para valorizar sua campanha, seu atendimento ou sua peça audiovisual.' ),
        array( 'key' => 'process_title',    'label' => 'Título "Como Funciona"',          'type' => 'text',     'default' => 'Do roteiro à entrega: gravação profissional com qualidade e agilidade.' ),
        array( 'key' => 'step1_title',      'label' => 'Passo 1 — Título',               'type' => 'text',     'default' => 'Envie o roteiro' ),
        array( 'key' => 'step1_desc',       'label' => 'Passo 1 — Descrição',            'type' => 'textarea', 'default' => 'Conte o objetivo da peça, tom desejado, prazo e formato de entrega.' ),
        array( 'key' => 'step2_title',      'label' => 'Passo 2 — Título',               'type' => 'text',     'default' => 'Receba a orientação' ),
        array( 'key' => 'step2_desc',       'label' => 'Passo 2 — Descrição',            'type' => 'textarea', 'default' => 'A gravação é direcionada para publicidade, institucional, URA ou conteúdo digital.' ),
        array( 'key' => 'step3_title',      'label' => 'Passo 3 — Título',               'type' => 'text',     'default' => 'Aprove o áudio' ),
        array( 'key' => 'step3_desc',       'label' => 'Passo 3 — Descrição',            'type' => 'textarea', 'default' => 'Você recebe o material pronto para usar na campanha, vídeo, atendimento ou mídia.' ),
        array( 'key' => 'services_title',   'label' => 'Título da lista de serviços',     'type' => 'text',     'default' => 'Uma voz marcante e alinhada à identidade da sua marca.' ),
        array( 'key' => 'services_list',    'label' => 'Serviços (um por linha)',         'type' => 'textarea', 'default' => "Gravação de voz para publicidade\nVoz para TV e rádio\nGravação de URA profissional\nEspera telefônica personalizada\nLocução para vídeos institucionais\nLocução para treinamentos e e-learning\nCampanhas promocionais e comerciais\nConteúdo para redes sociais e mídia digital" ),
        array( 'key' => 'contact_cta_title','label' => 'Título do bloco de contato',      'type' => 'text',     'default' => 'Entre em contato com Adriana Rosa' ),
        array( 'key' => 'contact_cta_text', 'label' => 'Texto do bloco de contato',      'type' => 'textarea', 'default' => 'Solicite um orçamento e descubra como uma voz humana e profissional pode valorizar sua marca, sua campanha e seus projetos de comunicação.' ),
    );

    locutora_render_fields( $fields );
}

// Mostra o meta box de sobre nós apenas na página correta
function locutora_about_meta_box( $post ) {
    $template = get_post_meta( $post->ID, '_wp_page_template', true );
    if ( $template !== 'page-sobre-nos.php' ) {
        return;
    }

    wp_nonce_field( 'lc_about_save', 'lc_about_nonce' );

    $fields = array(
        array( 'key' => 'bio_p1',   'label' => 'Bio — Parágrafo 1',     'type' => 'textarea', 'default' => 'Adriana Rosa é locutora profissional brasileira, atriz, radialista e comunicadora de São Paulo. Atua no mercado desde 2004, especializada em gravação de voz para publicidade, rádio, televisão, internet e projetos corporativos. Reconhecida pela versatilidade e qualidade de sua voz, atende clientes de todo o Brasil e do mercado internacional.' ),
        array( 'key' => 'bio_p2',   'label' => 'Bio — Parágrafo 2',     'type' => 'textarea', 'default' => 'Formada em Produção Audiovisual e Teatro, Adriana também é radialista e possui pós-graduações em Influência Digital e Jornalismo Digital, unindo sólida formação acadêmica à ampla experiência prática no mercado da comunicação e do entretenimento.' ),
        array( 'key' => 'bio_p3',   'label' => 'Bio — Parágrafo 3',     'type' => 'textarea', 'default' => 'Especialista em locução em português do Brasil, atua em campanhas publicitárias, voice over, vídeos institucionais, treinamentos corporativos, e-learning, URA, conteúdos digitais e produções audiovisuais. Sua experiência permite entregar uma comunicação clara, envolvente e alinhada aos objetivos de cada marca.' ),
        array( 'key' => 'bio_p4',   'label' => 'Bio — Parágrafo 4',     'type' => 'textarea', 'default' => 'Como atriz profissional, oferece interpretações naturais, autênticas e versáteis, adaptando sua voz para diferentes estilos de locução: institucional, comercial, emocional, inspiracional, varejo, personagens e conteúdos corporativos.' ),
        array( 'key' => 'bio_p5',   'label' => 'Bio — Parágrafo 5 (rádio)', 'type' => 'textarea', 'default' => 'Sua trajetória inclui passagens por importantes emissoras de rádio, como a Rádio Trianon e a Novabrasil FM. Atualmente, é locutora da Classic Pan, pertencente ao Grupo Jovem Pan, consolidando sua experiência como uma das vozes profissionais mais reconhecidas do mercado.' ),
        array( 'key' => 'mission',  'label' => 'Missão',                 'type' => 'textarea', 'default' => 'Dar voz às marcas com criatividade, qualidade e atenção aos detalhes, criando conexões autênticas entre empresas e seus públicos.' ),
        array( 'key' => 'vision',   'label' => 'Visão',                  'type' => 'textarea', 'default' => 'Ser referência em locução profissional, reconhecida pela excelência, inovação e relacionamento próximo com cada cliente.' ),
        array( 'key' => 'values',   'label' => 'Valores',                'type' => 'textarea', 'default' => 'Excelência, inovação, personalização, profissionalismo, ética, comprometimento e respeito em cada projeto.' ),
        array( 'key' => 'studio_title', 'label' => 'Título — Estúdio',  'type' => 'text',     'default' => 'Estúdio próprio com equipamentos profissionais' ),
        array( 'key' => 'studio_p1',    'label' => 'Texto — Estúdio',   'type' => 'textarea', 'default' => 'Com estúdio próprio e equipamentos profissionais, Adriana Rosa realiza gravações de voz com alta qualidade técnica, garantindo excelente resultado para empresas que precisam de uma comunicação eficiente e profissional.' ),
    );

    locutora_render_fields( $fields );
}

function locutora_render_fields( $fields ) {
    echo '<style>
        .lc-field-group { margin-bottom: 18px; }
        .lc-field-group label { display: block; font-weight: 600; margin-bottom: 6px; color: #1d2327; font-size: 13px; }
        .lc-field-group input[type=text],
        .lc-field-group textarea { width: 100%; font-size: 14px; padding: 8px 10px; border: 1px solid #8c8f94; border-radius: 3px; color: #2c3338; }
        .lc-field-group textarea { min-height: 90px; resize: vertical; }
        .lc-fields-hint { margin: 0 0 20px; padding: 10px 14px; background: #f0f6fc; border-left: 4px solid #2271b1; font-size: 13px; }
    </style>';
    echo '<p class="lc-fields-hint">Edite os textos abaixo e clique em <strong>Atualizar</strong> para salvar. O layout do site é preservado automaticamente.</p>';

    foreach ( $fields as $f ) {
        $key   = 'lc_' . $f['key'];
        $value = get_post_meta( get_the_ID(), $key, true );
        if ( $value === '' || $value === false ) {
            $value = $f['default'];
        }
        echo '<div class="lc-field-group">';
        echo '<label for="' . esc_attr( $key ) . '">' . esc_html( $f['label'] ) . '</label>';
        if ( $f['type'] === 'textarea' ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
        } else {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
        }
        echo '</div>';
    }
}

function locutora_save_meta_boxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Home fields
    if ( isset( $_POST['lc_home_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lc_home_nonce'] ) ), 'lc_home_save' ) ) {
        $home_keys = array( 'lc_hero_title', 'lc_hero_subtitle', 'lc_about_tagline', 'lc_about_p1', 'lc_about_p2', 'lc_about_p3', 'lc_process_title', 'lc_step1_title', 'lc_step1_desc', 'lc_step2_title', 'lc_step2_desc', 'lc_step3_title', 'lc_step3_desc', 'lc_services_title', 'lc_services_list', 'lc_contact_cta_title', 'lc_contact_cta_text' );
        foreach ( $home_keys as $key ) {
            if ( isset( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
            }
        }
    }

    // About fields
    if ( isset( $_POST['lc_about_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lc_about_nonce'] ) ), 'lc_about_save' ) ) {
        $about_keys = array( 'lc_bio_p1', 'lc_bio_p2', 'lc_bio_p3', 'lc_bio_p4', 'lc_bio_p5', 'lc_mission', 'lc_vision', 'lc_values', 'lc_studio_title', 'lc_studio_p1' );
        foreach ( $about_keys as $key ) {
            if ( isset( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
            }
        }
    }
}
add_action( 'save_post', 'locutora_save_meta_boxes' );

// ─── Páginas do tema: desativa Gutenberg e mostra campos de edição ────────────

function locutora_disable_gutenberg( $use_block_editor, $post ) {
    if ( $post->post_type !== 'page' ) {
        return $use_block_editor;
    }
    $php_templates = array( '', 'front-page.php', 'page-sobre-nos.php', 'page-servicos.php', 'page-contato.php' );
    $template      = get_post_meta( $post->ID, '_wp_page_template', true );
    $front_page_id = (int) get_option( 'page_on_front' );
    if ( $post->ID === $front_page_id || in_array( $template, $php_templates, true ) ) {
        return false;
    }
    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'locutora_disable_gutenberg', 10, 2 );

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
