<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">
        <form class="contact-form" action="/guest-book" method="post">
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

            <div class="tooltip" data-tooltip-text="Ваши Фамилия Имя Отчество">
                <p style="margin-top: 0">ФИО</p>
                <input type="text"
                       id="fio"
                       name="fio"
                       value="<?php if( !empty($_POST["fio"]) ) echo $_POST["fio"]; ?>"
                />
                <p class="error">Заполните ФИО!</p>
            </div>

            <div class="tooltip" data-tooltip-text="Ваш Email">
                <p>Email</p>
                <input
                    id="email"
                    type="email"
                    name="email"
                    data-error-text="Заполните Email"
                    value="<?php if( !empty($_POST["email"]) ) echo $_POST["email"]; ?>"
                />
                <p class="error">Заполните Email!</p>
                <div class="tooltip-block"></div>
            </div>

            <div class="tooltip" data-tooltip-text="Текст отзыва">
                <p>Ваши пожелания о новых книгах</p>
                <textarea name="text" id="text"><?php if( !empty($_POST["text"]) ) echo $_POST["text"]; ?></textarea>
                <p class="error">Заполните Текст отзыва!</p>
                <div class="tooltip-block"></div>
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
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Ваши пожелания о новых книгах</th>
                    <th>Дата добавления</th>
                </tr>
                <?php foreach ($messages as $message): ?>
                <tr>
                    <?php foreach ($message as $messageData): ?>
                        <td>
                            <?= nl2br(htmlspecialchars($messageData)) ?>
                        </td>
                    <?php endforeach; ?>
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