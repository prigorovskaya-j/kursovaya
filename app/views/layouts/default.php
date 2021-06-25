<?php
use app\models\AdminPanelModel;

$adminPanel = new AdminPanelModel();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Книжный магазин</title>
    <link rel="stylesheet" href="http://<?= $_SERVER["SERVER_NAME"]; ?>/public/css/reset.css">
    <link rel="stylesheet" href="http://<?= $_SERVER["SERVER_NAME"]; ?>/public/css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="http://<?= $_SERVER["SERVER_NAME"]; ?>/public/Libs/jquery.js"></script>
    <script src="http://<?= $_SERVER["SERVER_NAME"]; ?>/public/js/index.js"></script>
</head>
<body id="mainpagebackgr">

<header>
    <nav>
        <ul id="menu">
            <?php
            $i = 0;
            foreach ($menu as $link => $name):
                $i++;
                if( !is_array($name) ){
                    ?>
                    <li>
                        <a href="<?= $link ?>" class="<?php if( !empty($menuIndex) && $menuIndex == $i ) echo "active"; ?>"><?= $name ?></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="menu-item">
                        <a href="<?= $link ?>" class="<?php if( !empty($menuIndex) && $menuIndex == $i ) echo "active"; ?>"><?= $name['pageName'] ?></a>
                        <ul class="sub-menu">
                            <?php foreach ($name as $submenuLink => $submenuName): ?>
                                <?php if( $submenuLink == "pageName" ) continue; ?>
                                <li> <a href="<?= $submenuLink ?>"><?= $submenuName ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>

            <?php endforeach; ?>
        </ul>
        <div id="time">00:00:00 1 январь 1970</div>
        <?php if( !\app\controllers\UserController::isUserLogin() ): ?>
            <div class="user">
                <div class="user__login">
                    <a href="/user/login">
                        Вход
                    </a>
                </div>
                <div class="user__register">
                    <a href="/user/register">
                        Регистрация
                    </a>
                </div>
            </div>
            <div class="admin-controller">
                <div class="admin-controller__btn">
                    <p class="admintext">Админ</p>
                </div>
                <div class="admin-controller__panel">
                    <ul>
                        <?php if( isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] ): ?>
                            <?php foreach($adminPanel->adminItems as $link => $name): ?>
                                <li class="admin-controller__panel__item">
                                    <a href="<?= $link ?>"><?= $name ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="admin-controller__panel__item">
                                <a href="/admin/login">Войти в систему</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php elseif(isset($_SESSION["user_login"])): ?>
            <div class="user">
                <a href="/user/logout">
                    Привет, <?= $_SESSION["user_login"] ?>!
                </a>
            </div>
        <?php endif; ?>
    </nav>
</header>

<?= $content ?>

<footer>

</footer>
<?php if( $menuIndex == 6 ): ?>
    <script src="public/js/calendar.js"></script>
<?php endif; ?>
</body>
</html>
