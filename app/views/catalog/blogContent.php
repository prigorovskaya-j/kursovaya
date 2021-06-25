<main>
    <section class="page-name">
        <span><?= $blogData->title ?></span>
    </section>

    <div class="modal blog-comment-modal">
        <div class="modal__title">
            Добавление отзыва
        </div>
        <div class="modal__desc">
            <form action="/catalog/addComment" method="post" class="main-form">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <input type="hidden" name="last_comment_num" value="">

                <label for="text">
                    Текст комментария
                    <textarea name="text"></textarea>
                </label>

                <div class="modal__btn">
                    <button type="submit" class="main-btn">Добавить</button>
                </div>
            </form>
        </div>
    </div>

    <div class="content-wrapper grey-block">

        <div class="blog-content">

            <div class="blog-content__text">
                <?= $blogData->text ?>
            </div>
        </div>

        <?php if (!\app\controllers\UserController::isUserLogin()): ?>
            Войдите в систему чтобы добавить комментарий
        <?php elseif (isset($_SESSION["user_login"])): ?>
            <div class="blog-comment">
                <div class="main-btn">
                    Добавить отзыв
                </div>
            </div>
        <?php endif; ?>

        <div class="comments">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $i => $comment): ?>
                    <div class="comments__item">
                        <p class="comments__num">Отзыв #<span><?= $i + 1 ?></span></p>
                        <span>
                            <?= $comment->comment_text ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</main>