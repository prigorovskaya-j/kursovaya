<main>
    <section class="page-name">
        <span>Наши авторы</span>
    </section>
    <div class="wrapper_album_img">
        <div id="black_bg"></div>
        <div id="album_img">
            <img src="" alt=""/>
            <span></span>
            <div class="next-img"><span>ᐳ</span></div>
            <div class="prev-img"><span>ᐸ</span></div>
            <div class="count-img">
                Фото <span class="num-this-img">1</span> из
                <span class="total-count"><?php echo count($photoNames); ?></span>
            </div>
            <div class="close">X</div>
        </div>
    </div>

    <div class="content-wrapper grey-block album">
            <?php
                $i = 0;
                foreach ($photoNames as $photoSrc => $name):
                $i++;
            ?>
                <figure>
                    <img class='foto_img' data-img-id=<?= $i - 1 ?> title='<?= $name ?>' src='<?= $photoSrc ?>'>
                    <figcaption><?= $name ?></figcaption>
                </figure>
            <?php endforeach; ?>
    </div>
</main>