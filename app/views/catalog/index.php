<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">

        <?php if (!empty($blogRecords)): ?>
            <table>
                <tr>
                    <th>Наименование товара</th>
                    <th>Изображение</th>
                    <th>Описание</th>
                    <th>Дата добавления</th>
                    <th></th>
                </tr>
                <?php foreach ($blogRecords as $blogRecord): ?>
                    <tr>
                        <td>
                            <?= $blogRecord->title ?>
                        </td>
                        <td>
                            <?= $blogRecord->text ?>
                        </td>
                        <td>
                            <?= $blogRecord->created_at ?>
                        </td>
                        <td>
                            <a href="/catalog?id=<?= $blogRecord->id ?>">
                                <span class="material-icons">remove_red_eye</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>


        <div class="num-page">
            Всего страниц: <?= $blogNumPage ?><br>
        </div>

        <div class="paginate">
            <?php
            if (isset($_GET["page"])) $page = $_GET["page"]; else $page = 1;
            ?>
            <?php for ($i = 1; $i <= $blogNumPage; $i++): ?>
                <?php if ($page == $i): ?>
                    <span class="active paginate__item"><?= $i ?></span>
                <?php else: ?>
                    <a href="blog?page=<?= $i ?>" class="paginate__item"> <?= $i ?> </a>
                <?php endif; ?>

            <?php endfor; ?>
        </div>


    </div>
</main>