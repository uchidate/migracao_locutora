<?php
get_header();
?>

<main class="site-main">

    <?php /* Hero: mantido em PHP — o carrossel de vídeo depende de JS e markup específico */ ?>
    <section class="vitrine-hero">
        <video class="vitrine-video is-active" autoplay muted loop playsinline>
            <source src="<?php echo esc_url( locutora_asset( 'Vitrine/Vitrine 1.mp4' ) ); ?>" type="video/mp4">
        </video>
        <video class="vitrine-video" muted loop playsinline>
            <source src="<?php echo esc_url( locutora_asset( 'Vitrine/Vitrine 2.mp4' ) ); ?>" type="video/mp4">
        </video>
        <video class="vitrine-video" muted loop playsinline>
            <source src="<?php echo esc_url( locutora_asset( 'Vitrine/Vitrine 3.mp4' ) ); ?>" type="video/mp4">
        </video>
        <div class="container">
            <div class="vitrine-copy">
                <h1>Locutora Profissional</h1>
                <p>Gravação de voz para publicidade, TV, rádio, URA, vídeos institucionais e internet.</p>
                <div class="hero-actions">
                    <a class="button button-filled" href="<?php echo esc_url( home_url( '/contato' ) ); ?>">Solicite um orçamento</a>
                    <a class="button button-light" href="#portfolio-de-voz">Ouvir demos</a>
                </div>
                <div class="hero-badges" aria-label="Diferenciais">
                    <span>Desde 2004</span>
                    <span>Entrega online</span>
                    <span>Voz comercial</span>
                </div>
                <div class="vitrine-dots" aria-label="Vídeos da vitrine">
                    <button class="is-active" type="button" aria-label="Mostrar vídeo 1"></button>
                    <button type="button" aria-label="Mostrar vídeo 2"></button>
                    <button type="button" aria-label="Mostrar vídeo 3"></button>
                </div>
            </div>
        </div>
    </section>

    <?php /* Todas as seções abaixo do hero são editáveis diretamente no WordPress */ ?>
    <div class="page-sections">
        <?php
        if ( have_posts() ) :
            the_post();
            the_content();
        endif;
        ?>
    </div>

</main>

<?php
get_footer();
?>
