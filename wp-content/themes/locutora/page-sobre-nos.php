<?php
/*
Template Name: Sobre Nós
*/
get_header();
?>

<main class="site-main">
    <section class="page-banner" style="background-image: url('<?php echo esc_url( locutora_asset( 'banners/sobre-nos.png' ) ); ?>');">
        <div class="container">
            <h1>Adriana Rosa</h1>
        </div>
    </section>

    <section class="section section-white">
        <div class="container">
            <div class="about-grid about-grid-light">
                <img src="<?php echo esc_url( locutora_asset( 'ADRIANAROSA.jpg' ) ); ?>" alt="Adriana Rosa">
                <div>
                    <p class="section-kicker">Locutora Profissional</p>
                    <h2>Mais de 20 anos de experiência em locução profissional</h2>
                    <p>Adriana Rosa é locutora profissional brasileira, atriz, radialista e comunicadora de São Paulo. Atua no mercado desde 2004, especializada em gravação de voz para publicidade, rádio, televisão, internet e projetos corporativos. Reconhecida pela versatilidade e qualidade de sua voz, atende clientes de todo o Brasil e do mercado internacional.</p>
                    <p>Formada em Produção Audiovisual e Teatro, Adriana também é radialista e possui pós-graduações em Influência Digital e Jornalismo Digital, unindo sólida formação acadêmica à ampla experiência prática no mercado da comunicação e do entretenimento.</p>
                    <p>Especialista em locução em português do Brasil, atua em campanhas publicitárias, voice over, vídeos institucionais, treinamentos corporativos, e-learning, URA, conteúdos digitais e produções audiovisuais. Sua experiência permite entregar uma comunicação clara, envolvente e alinhada aos objetivos de cada marca.</p>
                    <p>Como atriz profissional, oferece interpretações naturais, autênticas e versáteis, adaptando sua voz para diferentes estilos de locução: institucional, comercial, emocional, inspiracional, varejo, personagens e conteúdos corporativos. Essa combinação entre atuação, conhecimento audiovisual e técnica de locução garante resultados diferenciados para empresas, agências e produtoras.</p>
                    <p>Sua trajetória inclui passagens por importantes emissoras de rádio, como a Rádio Trianon e a Novabrasil FM. Atualmente, é locutora da Classic Pan, pertencente ao Grupo Jovem Pan, consolidando sua experiência como uma das vozes profissionais mais reconhecidas do mercado.</p>
                </div>
            </div>
            <div class="values-grid">
                <article>
                    <h3>Missão</h3>
                    <p>Dar voz às marcas com criatividade, qualidade e atenção aos detalhes, criando conexões autênticas entre empresas e seus públicos.</p>
                </article>
                <article>
                    <h3>Visão</h3>
                    <p>Ser referência em locução profissional, reconhecida pela excelência, inovação e relacionamento próximo com cada cliente.</p>
                </article>
                <article>
                    <h3>Valores</h3>
                    <p>Excelência, inovação, personalização, profissionalismo, ética, comprometimento e respeito em cada projeto.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section section-white">
        <div class="container">
            <p class="section-kicker">Qualidade Profissional e Atendimento Nacional</p>
            <h2>Estúdio próprio com equipamentos profissionais</h2>
            <p>Com estúdio próprio e equipamentos profissionais, Adriana Rosa realiza gravações de voz com alta qualidade técnica, garantindo excelente resultado para empresas que precisam de uma comunicação eficiente e profissional.</p>
            <p>Solicite um orçamento e descubra como uma voz humana e profissional pode valorizar sua marca, sua campanha e seus projetos de comunicação.</p>
            <a class="button" href="<?php echo esc_url(home_url('/contato')); ?>">Solicite um orçamento</a>
        </div>
    </section>

    <section class="section brands-section">
        <div class="container">
            <p class="section-kicker">Clientes</p>
            <h2>Marcas atendidas</h2>
            <div class="brand-grid">
                <?php
                $brands = array( 'boticario.png', 'Vivo.png', 'viacredi.png', 'mcdonalds.png', 'avon2.png', 'neoenergia.png', 'cielo.png', 'bradesco.png', '3m.png', 'Nespresso.png', 'paodeaçucar.png', 'danone.png', 'Globo.png', 'netflix.png', 'apple.png', 'natura.png', 'santander.png', 'amil.png', 'Liza.png', 'Claro.png', 'Adria2.png', 'boston2.png' );
                foreach ( $brands as $brand ) :
                ?>
                    <img src="<?php echo esc_url( locutora_asset( 'sobre-marcas/' . $brand ) ); ?>" alt="">
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
