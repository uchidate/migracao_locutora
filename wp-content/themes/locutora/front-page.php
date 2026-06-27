<?php
get_header();
?>

<main class="site-main">
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
                    <a class="button" href="<?php echo esc_url(home_url('/contato')); ?>">Solicite um orçamento</a>
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

    <section class="section yootheme-about">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="hero-label">Adriana Rosa</p>
                <h2>Se você procura uma locutora profissional para dar mais credibilidade e impacto à comunicação da sua empresa, está no lugar certo.</h2>
                <div class="about-callout">
                    <p>Sou Adriana Rosa, locutora profissional atuando no mercado desde 2004, especializada em gravação de voz para campanhas publicitárias, vídeos institucionais, URA, espera telefônica, conteúdos corporativos e projetos digitais.</p>
                    <p>Ao longo de mais de duas décadas de experiência, atendi empresas, agências e produtoras em todo o Brasil e exterior, sempre com qualidade profissional e entrega rápida.</p>
                    <p>Você envia o roteiro e recebe uma voz pronta para valorizar sua campanha, seu atendimento ou sua peça audiovisual.</p>
                </div>
                <a class="button button-light" href="<?php echo esc_url(home_url('/sobre-nos')); ?>">Conheça</a>
            </div>
            <div class="hero-media">
                <img src="<?php echo esc_url( locutora_asset( 'Home/Intro.png' ) ); ?>" alt="Adriana Rosa em estúdio de locução">
            </div>
        </div>
    </section>

    <section class="section recordings-section">
        <div class="container">
            <h2>Fazemos gravações para:</h2>
            <div class="home-icons">
                <article>
                    <img src="<?php echo esc_url( locutora_asset( 'Home/propaganda.png' ) ); ?>" alt="">
                    <h3>Publicidade, TV e Rádio</h3>
                </article>
                <article>
                    <img src="<?php echo esc_url( locutora_asset( 'Home/televisao.png' ) ); ?>" alt="">
                    <h3>URA e espera telefônica</h3>
                </article>
                <article>
                    <img src="<?php echo esc_url( locutora_asset( 'Home/botao-play.png' ) ); ?>" alt="">
                    <h3>Vídeos institucionais e e-learning</h3>
                </article>
                <article>
                    <img src="<?php echo esc_url( locutora_asset( 'Home/formato-preto-do-microfone.png' ) ); ?>" alt="">
                    <h3>Conteúdo digital e redes sociais</h3>
                </article>
            </div>
        </div>
    </section>

    <section class="section process-section">
        <div class="container">
            <p class="section-kicker">Como funciona</p>
            <h2>Do roteiro à entrega: gravação profissional com qualidade e agilidade.</h2>
            <div class="process-grid">
                <article>
                    <span>01</span>
                    <h3>Envie o roteiro</h3>
                    <p>Conte o objetivo da peça, tom desejado, prazo e formato de entrega.</p>
                </article>
                <article>
                    <span>02</span>
                    <h3>Receba a orientação</h3>
                    <p>A gravação é direcionada para publicidade, institucional, URA ou conteúdo digital.</p>
                </article>
                <article>
                    <span>03</span>
                    <h3>Aprove o áudio</h3>
                    <p>Você recebe o material pronto para usar na campanha, vídeo, atendimento ou mídia.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section section-services-list">
        <div class="container">
            <p class="section-kicker">Serviços de Locução Profissional</p>
            <h2>Uma voz marcante e alinhada à identidade da sua marca.</h2>
            <ul class="services-list">
                <li>Gravação de voz para publicidade</li>
                <li>Voz para TV e rádio</li>
                <li>Gravação de URA profissional</li>
                <li>Espera telefônica personalizada</li>
                <li>Locução para vídeos institucionais</li>
                <li>Locução para treinamentos e e-learning</li>
                <li>Campanhas promocionais e comerciais</li>
                <li>Conteúdo para redes sociais e mídia digital</li>
            </ul>
        </div>
    </section>

    <section id="portfolio-de-voz" class="section audio-section">
        <div class="container audio-grid">
            <div>
                <p class="section-kicker">Portfólio de voz</p>
                <h2>Ouça trabalhos e demos no SoundCloud.</h2>
                <p>Os trabalhos de locução ficam no perfil oficial do SoundCloud, como no site original.</p>
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

    <section class="section section-contact">
        <div class="container">
            <div class="contact-hero">
                <div>
                    <h2>Entre em contato com Adriana Rosa</h2>
                    <p>Solicite um orçamento e descubra como uma voz humana e profissional pode valorizar sua marca, sua campanha e seus projetos de comunicação.</p>
                </div>
                <a class="button" href="<?php echo esc_url(home_url('/contato')); ?>">Contato</a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
