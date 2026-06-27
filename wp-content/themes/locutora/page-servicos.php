<?php
/*
Template Name: Áudios
*/
get_header();
?>

<main class="site-main">
    <section class="page-banner" style="background-image: url('<?php echo esc_url( locutora_asset( 'banners/servicos.png' ) ); ?>');">
        <div class="container">
            <h1>Serviços</h1>
        </div>
    </section>

    <section class="section section-white">
        <div class="container">
            <p class="section-kicker">Áudios profissionais</p>
            <h2>Gravações para campanhas, empresas e conteúdos digitais</h2>
            <div class="service-icon-grid service-icon-grid-large">
                <?php
                $services = array(
                    array( 'gravacao-de-voz.png', 'Gravação de voz' ),
                    array( 'podcast.png', 'Podcast' ),
                    array( 'noticias-globais.png', 'Notícias e chamadas' ),
                    array( 'apps.png', 'Aplicativos' ),
                    array( 'megafone.png', 'Publicidade' ),
                    array( 'monitor-de-tv.png', 'TV e rádio' ),
                    array( 'mensagem-de-voz.png', 'Mensagem de voz' ),
                    array( 'voz.png', 'Voz institucional' ),
                    array( 'narrativa.png', 'Narração' ),
                    array( 'chamada-telefonica (1).png', 'URA telefônica' ),
                    array( 'televisao (1).png', 'Vinhetas' ),
                    array( 'animacao.png', 'Animação' ),
                    array( 'pagina-da-internet.png', 'Internet' ),
                    array( 'aula-on-line.png', 'Aula online' ),
                    array( 'ondas-de-audio.png', 'Áudio digital' ),
                    array( 'video-aula.png', 'Vídeo aula' ),
                );
                foreach ( $services as $service ) :
                ?>
                    <article>
                        <img src="<?php echo esc_url( locutora_asset( 'Servicos/' . $service[0] ) ); ?>" alt="">
                        <span><?php echo esc_html( $service[1] ); ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section audio-section">
        <div class="container audio-grid">
            <div>
                <p class="section-kicker">Portfólio de voz</p>
                <h2>Ouça trabalhos e demos no SoundCloud.</h2>
                <p>Os áudios de locução ficam no perfil oficial do SoundCloud, como no site original.</p>
            </div>
            <div class="soundcloud-player">
                <div class="soundcloud-card">
                    <span>SoundCloud</span>
                    <strong>Adriana Rosa</strong>
                    <p>Portfólio oficial com demos e trabalhos de locução.</p>
                    <a class="button" href="https://soundcloud.com/adrianarosalocutora" target="_blank" rel="noopener">Ouvir agora</a>
                </div>
                <iframe title="SoundCloud Adriana Rosa Locutora" width="100%" height="500" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A%2F%2Fsoundcloud.com%2Fadrianarosalocutora&auto_play=false&show_artwork=true&color=ed9c18"></iframe>
                <a class="soundcloud-fallback" href="https://soundcloud.com/adrianarosalocutora" target="_blank" rel="noopener">Abrir SoundCloud</a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
