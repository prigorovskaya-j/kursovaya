<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">
        <form action="" method="post" class="contact-form test-form register-form">
            <div class="tooltip">
                <p style="margin-top: 0">ФИО</p>
                <input type="text" id="fio" name="fio" value="<?= $_POST["fio"] ?? "" ?>">
            </div>

            <div class="tooltip">
                <p style="margin-top: 0">Email</p>
                <input type="text" id="email" name="email" value="<?= $_POST["email"] ?? "" ?>">
            </div>

            <div class="tooltip">
                <p style="margin-top: 0">Логин</p>
                <input type="text" id="login" name="login" value="<?= $_POST["login"] ?? "" ?>">
                <p class="error">Данный логин уже занят</p>
            </div>

            <div class="tooltip">
                <p style="margin-top: 0">Пароль</p>
                <input type="password" id="password" name="password" value="">
            </div>

            <button type="submit" class="main-btn">Зарегистрироваться</button>
        </form>

        <div class="notification">
            <div class="notification__item notification__item_red login-busy">
                Пользователь с таким логином уже существует
            </div>
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
                        Вы успешно зарегестрированы
                        <a href="/user/login">Войти в систему</a>
                    </div>
                <?php endif;endif; ?>
        </div>
    </div>
</main>