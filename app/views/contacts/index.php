<main>
    <section class="page-name">
        <span><?= $title ?></span>
    </section>

    <div class="content-wrapper grey-block">
        <form action="/contacts" class="contact-form" method="post">
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

            <div class="tooltip" data-tooltip-text="Ваши Фамилия Имя Отчество">
                <p style="margin-top: 0">ФИО</p>
                <input
                    type="text"
                    name="fio"
                    id="fio"
                    data-error-text="Заполните ФИО!"
                    value="<?php if( !empty($_POST["fio"]) ) echo $_POST["fio"]; ?>"
                />
                <p class="error">Заполните ФИО!</p>
                <div class="tooltip-block"></div>
            </div>

            <div class="tooltip" data-tooltip-text="Ваш пол">
                <p>Пол</p>
                <p class="radio">
                    <input
                        class="radio-input"
                        type="radio"
                        name="sex"
                        value="m"
                        checked
                    />М
                </p>
                <p class="radio">
                    <input class="radio-input" type="radio" name="sex" value="z"/>Ж
                </p>
                <div class="tooltip-block"></div>
            </div>

            <div class="tooltip" data-tooltip-text="Ваш возраст">
                <p>Возраст</p>
                <select class="" name="age">
                    <option value="">16</option>
                    <option value="">17</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                </select>
                <div class="tooltip-block"></div>
            </div>

            <div class="tooltip" data-tooltip-text="Ваша дата рождения">
                <div class="calendar-wrapper">
                    <p>Дата рождения</p>
                    <input
                        id="birthday"
                        type="text"
                        name="birthday"
                        data-error-text="Заполните дату рождения"
                        value="<?php if( !empty($_POST["birthday"]) ) echo $_POST["birthday"]; ?>"
                    />
                    <p class="error"></p>
                    <div id="calendar">
                        <div class="calendar-header">
                            <div class="left-calendar-header">
                                <span id="today_day_of_week">Понедельник 1</span>
                            </div>
                            <div class="right-calendar-header">
                                <select class="" name="" id="selectMonth">
                                    <option value="">January</option>
                                    <option value="">February</option>
                                    <option value="">March</option>
                                    <option value="">April</option>
                                    <option value="">May</option>
                                    <option value="">June</option>
                                    <option value="">Jule</option>
                                    <option value="">August</option>
                                    <option value="">September</option>
                                    <option value="">October</option>
                                    <option value="">November</option>
                                    <option value="">December</option>
                                </select>
                                <input id="selectYear" type="number" value="2020"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="content">
                            <div id="days">
                                <table>
                                    <tr class="not-hover">
                                        <td>Mon</td>
                                        <td>Tue</td>
                                        <td>Wed</td>
                                        <td>Thu</td>
                                        <td>Fri</td>
                                        <td>Sat</td>
                                        <td>Sun</td>
                                    </tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tooltip-block"></div>
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

            <div class="tooltip" data-tooltip-text="Ваш текст сообщения">
                <p>Текст сообщения</p>
                <textarea
                    id="message"
                    name="message"
                    data-error-text="Введите сообщение"
                ><?php if( !empty($_POST["message"]) ) echo trim($_POST["message"]); ?></textarea>
                <p class="error">Введите сообщение!</p>
                <div class="tooltip-block"></div>
            </div>

            <div class="tooltip" data-tooltip-text="Ваш телефон">
                <p>Телефон</p>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    data-error-text="Заполните Телефон"
                    value="<?php if( !empty($_POST["phone"]) ) echo $_POST["phone"]; else echo "+7"?>"
                />
                <p class="error">Заполните Телефон!</p>
                <br/>
                <div class="tooltip-block"></div>
            </div>

            <button
                id="sendBtn"
                class="main-btn btn-show-modal"
                data-modal-text="Отправить данные?"
                data-btn-callback="sendForm"
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
        <div class="notification">
            <?php
            if( isset($errors) ):
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