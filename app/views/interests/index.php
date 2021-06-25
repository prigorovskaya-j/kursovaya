<main>
    <section class="page-name">
        <span>Мои интересы</span>
    </section>
    <div class="content-wrapper">
        <?php foreach ( $interests as $interest ): ?>
=
            <div class="parallax-title"><?= $interest['title'] ?></div>
            <div class="parallax-content"><?= $interest['desc'] ?></div>

            <div id="<?= $interest['id'] ?>" class="parallax-wrapper"></div>
            <div class="parallax">
                <div class="parallax-img" style="background: url(<?= $interest['img'] ?>);"></div>
            </div>

        <?php endforeach; ?>
    </div>
</main>