    <footer class="site-footer">
        <div class="container">
            <div class="footer-brand">
                <img src="<?php echo esc_url( locutora_asset( 'logo.png' ) ); ?>" alt="Locutora.com">
            </div>
            <div class="footer-contact">
                <strong>Entre em contato</strong>
                <a href="https://wa.me/5511984404171?text=Entro%20em%20contato%20atrav%C3%A9s%20do%20site">(11) 98440-4171</a>
                <a href="mailto:adrianarosa@locutora.com">adrianarosa@locutora.com</a>
                <a href="mailto:adrianarosa.voz@gmail.com">adrianarosa.voz@gmail.com</a>
            </div>
            <div class="footer-links">
                <strong>Institucional</strong>
                <a href="<?php echo esc_url( home_url( '/sobre-nos' ) ); ?>">Sobre nós</a>
                <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>">Serviços</a>
                <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>">Contato</a>
            </div>
        </div>
        <div class="footer-bottom container">
            <span><?php echo esc_html( date( 'Y' ) ); ?> © Todos os Direitos Reservados | <a href="<?php echo esc_url( home_url( '/politica-de-privacidade' ) ); ?>">Política de Privacidade</a></span>
            <a class="superix" href="https://www.superix.com.br/o-que-fazemos/criacao-de-sites" target="_blank" rel="external noopener">
                <img src="<?php echo esc_url( locutora_asset( 'apoio/logo-superix-criacao-site.png' ) ); ?>" alt="Criação de Sites">
            </a>
        </div>
        <a class="whatsapp-float" href="https://wa.me/5511984404171?text=Entro%20em%20contato%20atrav%C3%A9s%20do%20site" target="_blank" rel="noopener" aria-label="WhatsApp">
            <span>WhatsApp</span>
        </a>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
