<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">
        <table>
            <tr>
                <th>Дата и время</th>
                <th>IP-адрес</th>
                <th>Имя хоста компьютера</th>
                <th>Название браузера</th>
            </tr>
            <?php if (!empty($allVisits)): ?>
                <?php foreach ($allVisits as $allVisit): ?>
                    <tr>
                        <td>
                            <?= $allVisit->date ?>
                        </td>
                        <td>
                            <?= $allVisit->ip_address ?>
                        </td>
                        <td>
                            <?= $allVisit->host_name ?>
                        </td>
                        <td>
                            <?= $allVisit->browser_name ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</main>