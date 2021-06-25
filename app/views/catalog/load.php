<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">
        <form class="contact-form" action="" method="post" enctype="multipart/form-data">
            <div class="modal-wrapper">
                <div class="modal">
                    <p></p>
                    <div class="modal-btns">
                        <button id="yes_modal" class="main-btn" type="button">
                            Да
                        </button>
                        <button id="no_modal" class="main-btn" type="button">
                            Нет
                        </button>
                    </div>
                </div>
                <div class="overlay"></div>
            </div>

            <div id="tooltip"></div>

            <div class="tooltip">
                <p style="margin-top: 0">Выбор файла</p>
                <input type="file"
                       id="file"
                       name="file"
                />
            </div>

            <button
                id="sendBtn"
                class="main-btn btn-show-modal"
                data-modal-text="Отправить данные?"
                data-btn-callback="checkTestForm"
                type="submit"
                name="button"
            >
                Отправить
            </button>
            <button
                id="resetBtn"
                class="main-btn btn-show-modal"
                data-modal-text="Стереть данные?"
                data-btn-callback="resetForm"
                type="reset"
                name="button"
            >
                Очистить форму
            </button>
        </form>

        <?php if( !empty( $messages ) ): ?>
            <table>
                <tr>
                    <th>Наименование товара</th>
                    <th>Изображение</th>
                    <th>Описание</th>
                    <th>Дата добавления</th>
                </tr>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td>
                            <?= $message->title ?>
                        </td>
                        <td>
                            <img src="/public/img/<?= $message->img ?>" alt="">
                        </td>
                        <td>
                            <?= $message->text ?>
                        </td>
                        <td>
                            <?= $message->created_at ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div class="notification">
            <?php
            if( !empty($_POST) && isset($errors) ):
                foreach ($errors as $error):
                    ?>
                    <div class="notification__item notification__item_red">
                        <?= $error; ?>
                    </div>
                <?php
                endforeach;
                if( count($errors) == 0 ):
                    ?>
                    <div class="notification__item notification__item_green">
                        Данные успешно отправлены
                    </div>
                <?php endif;endif; ?>
        </div>
    </div>
</main>