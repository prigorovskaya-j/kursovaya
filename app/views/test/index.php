<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>
    <div class="content-wrapper grey-block">
        <form class="contact-form" action="/test" method="post">
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

            <div class="tooltip" data-tooltip-text="Ваша группа">
                <p>Группа</p>
                <select class="" name="group">
                    <option disabled selected>Выберите группу</option>
                    <optgroup label="1 курс">
                        <option>ПИ/б-20-1-о</option>
                        <option>ИС/б-20-1-о</option>
                        <option>ИС/б-20-2-о</option>
                        <option>ИС/б-20-3-о</option>
                    </optgroup>
                    <optgroup label="2 курс">
                        <option>ПИ/б-19-1-о</option>
                        <option>ИС/б-19-1-о</option>
                        <option>ИС/б-19-2-о</option>
                        <option>ИС/б-19-3-о</option>
                    </optgroup>
                    <optgroup label="3 курс">
                        <option>ПИ/б-18-1-о</option>
                        <option>ИС/б-18-1-о</option>
                        <option>ИС/б-18-2-о</option>
                        <option>ИС/б-18-3-о</option>
                    </optgroup>
                    <optgroup label="4 курс">
                        <option>ПИ/б-17-1-о</option>
                        <option>ИС/б-17-1-о</option>
                        <option>ИС/б-17-2-о</option>
                        <option>ИС/б-17-3-о</option>
                    </optgroup>
                </select>
            </div>

            <div class="tooltip" data-tooltip-text="Первый вопрос">
                <p>1. Сколько байт хранит в себе int?</p>
                <textarea type="text" id="q_1" name="q_1"><?php if( !empty($_POST["q_1"]) ) echo $_POST["q_1"]; ?></textarea>
                <p class="error"></p>
            </div>
            <?php if( !empty($testData) ): ?>
                <div class=" <?= $testData->q_1 ? "green-text" : "red-text" ?> "><?= $testData->q_1 ? "Верно" : "Неверно" ?></div>
            <?php endif; ?>

            <div class="tooltip" data-tooltip-text="Второй вопрос">
                <p>2. Алгоритм это</p>
                    <input class="radio-input" type="radio" name="q_2" value="1"/>1. служебное слово на языке QBASIC
                    <input class="radio-input" type="radio" name="q_2" value="2"/>2. область памяти, в которой хранится некоторое значение
                </p>
            </div>
            <?php if( !empty($testData) ): ?>
                <div class=" <?= $testData->q_2 ? "green-text" : "red-text" ?> "><?= $testData->q_2 ? "Верно" : "Неверно" ?></div>
            <?php endif; ?>

            <div class="tooltip" data-tooltip-text="Третий вопрос">
                <p>3. Алгоритм это?</p>
                <select name="q_3">
                    <option value="1">1. указание на выполнение действий</option>
                    <option value="2">2. система правил, описывающая последовательность действий  которые необходимо выполнить для решения задачи</option>
                    <option value="3">3. процесс выполнения вычислений, приводящих к решению задачи</option>
                    <option value="4">4. антоним инструкции</option>

                </select>
            </div>
            <?php if( !empty($testData) ): ?>
                <div class=" <?= $testData->q_3 ? "green-text" : "red-text" ?> "><?= $testData->q_3 ? "Верно" : "Неверно" ?></div>
            <?php endif; ?>

            <button
                id="sendBtn"
                class="main-btn btn-show-modal"
                data-modal-text="Отправить данные?"
                data-btn-callback="checkTestForm"
                type="submit"
            >
                Отправить
            </button>
            <button
                id="resetBtn"
                class="main-btn btn-show-modal"
                data-modal-text="Стереть данные?"
                data-btn-callback="resetForm"
                type="reset"
            >
                Очистить форму
            </button>
        </form>

        <?php if( !\app\controllers\UserController::isUserLogin() ): ?>
            Войдите в систему чтобы увидеть результаты
        <?php elseif(isset($_SESSION["user_login"])): ?>
            <?php if( !empty( $testResults ) ): ?>
                <table>
                    <tr>
                        <th>ФИО</th>
                        <th>Дата прохождения</th>
                        <th>1 вопрос</th>
                        <th>2 вопрос</th>
                        <th>3 вопрос</th>
                    </tr>
                    <?php foreach ($testResults as $testResult): ?>
                        <tr>
                            <td>
                                <?= $testResult->fio ?>
                            </td>
                            <td>
                                <?= $testResult->created_at ?>
                            </td>
                            <td>
                                <?= $testResult->q_1 == 1 ? "Верно" : "Неверно" ?>
                            </td>
                            <td>
                                <?= $testResult->q_2 == 1 ? "Верно" : "Неверно" ?>
                            </td>
                            <td>
                                <?= $testResult->q_3 == 1 ? "Верно" : "Неверно" ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
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