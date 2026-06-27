<?php
get_header();
?>

<main class="site-main">
    <section class="section">
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    echo '<h1>' . get_the_title() . '</h1>';
                    echo '<div class="page-content">';
                    the_content();
                    echo '</div>';
                endwhile;
            else :
                echo '<p>Conteúdo não encontrado.</p>';
            endif;
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>
