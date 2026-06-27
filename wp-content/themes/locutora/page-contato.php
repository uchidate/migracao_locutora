<?php
/*
Template Name: Contato
*/
get_header();
?>

<main class="site-main">
    <section class="page-banner" style="background-image: url('<?php echo esc_url( locutora_asset( 'banners/contato.png' ) ); ?>');">
        <div class="container">
            <h1>Contato</h1>
        </div>
    </section>

    <section class="section section-white">
        <div class="container">
            <p>Vamos conversar sobre o seu projeto de locução. Preencha o formulário abaixo ou envie uma mensagem para os contatos do site.</p>
            <?php
            $message_sent = false;
            $message_error = false;
            if ( 'POST' === $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['contact_nonce'] ) && wp_verify_nonce( $_POST['contact_nonce'], 'locutora_contact' ) ) {
                $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
                $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
                $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
                $to      = get_option( 'admin_email' );
                $subject = 'Novo contato - Locutora';
                $body    = "Nome: $name\nE-mail: $email\n\nMensagem:\n$message";
                $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

                if ( $name && is_email( $email ) && $message && wp_mail( $to, $subject, $body, $headers ) ) {
                    $message_sent = true;
                } else {
                    $message_error = true;
                }
            }
            ?>

            <div class="contact-grid">
                <div>
                    <div class="contact-card">
                        <h3>Fale conosco</h3>
                        <p>Estamos prontos para receber seu briefing e apresentar a melhor proposta de locução.</p>
                        <p><strong>WhatsApp:</strong> <a href="https://wa.me/5511984404171?text=Entro%20em%20contato%20atrav%C3%A9s%20do%20site">(11) 98440-4171</a></p>
                        <p><strong>E-mail:</strong> <a href="mailto:adrianarosa@locutora.com">adrianarosa@locutora.com</a></p>
                        <p><strong>E-mail:</strong> <a href="mailto:adrianarosa.voz@gmail.com">adrianarosa.voz@gmail.com</a></p>
                    </div>
                </div>
                <div class="contact-form">
                    <?php if ( $message_sent ) : ?>
                        <div class="contact-success">
                            <p>Sua mensagem foi enviada com sucesso. Entraremos em contato em breve.</p>
                        </div>
                    <?php else : ?>
                        <?php if ( $message_error ) : ?>
                            <div class="contact-error">
                                <p>Não foi possível enviar sua mensagem agora. Confira os dados e tente novamente.</p>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?php echo esc_url( get_permalink() ); ?>">
                            <label for="name">Nome</label>
                            <input type="text" id="name" name="name" placeholder="Seu nome" required>

                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="seu@email.com" required>

                            <label for="message">Mensagem</label>
                            <textarea id="message" name="message" rows="6" placeholder="Conte brevemente sobre seu projeto" required></textarea>

                            <?php wp_nonce_field( 'locutora_contact', 'contact_nonce' ); ?>
                            <button type="submit">Enviar mensagem</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
