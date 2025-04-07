<div class="container col-sm-10 col-md-8 col-lg-6 mt-5">
    <form>
        <div class="form-outline mb-1">
            <label class="form-label" for="email">Введите Email</label>
            <input type="email" id="email" class="form-control validate" />
            <span id="changeEmail" class="d-none link-primary text-decoration-underline" style="cursor: pointer">Изменить Email</span>
            <p id="authSentInfo" class="d-none alert alert-info">Вам на почту был выслан код авторизации. Пожалуйста, введите его в поле.</p>
        </div>
        <button  type="button" id="showConfirmationButton" class="d-none btn btn-primary btn-block mt-1 mb-4 w-100">Выслать код подтверждения</button>


        <div  id="confirmationField" class="d-none form-outline mb-4 d-flex align-items-center flex-column">
            <label class="form-label" for="authCode">Код авторизации</label>
            <input style="max-width: 100px; text-align: center; font-weight: bold; font-size: 16pt" type="text" pattern="\d*" inputmode="numeric" id="authCode" maxlength="6" class="digitsOnly form-control validate" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="phone">Введите телефон</label>
            <input type="tel" class="form-control validate digitsOnly" maxlength="20" pattern="\d*" inputmode="numeric" placeholder="80290001122" id="phone">
        </div>

        <h6>Введите данные о плательщике</h6>
        <div class="alert-primary">
            <nav class="nav nav-pills nav-justified">
                <a class="nav-link" id="showIndformBtn" onclick="showInd()" style="cursor: pointer">Физ. лицо</a>
                <a class="nav-link active text-light" id="showJurformBtn" onclick="showJur()" style="cursor: pointer">Юр. лицо</a>
            </nav>
            <div class="d-md-flex flex-row flex-wrap justify-content-around d-sm-block alert alert-primary"
                 id="Jur-form">
                <div class="col-md-5 m-1">
                    <label for="Jur-organizationUNPINN" class="form-label">УНП / ИНН</label>
                    <input type="text" class="form-control digitsOnly" pattern="\d*" inputmode="numeric" maxlength="12" placeholder="1122334450" id="Jur-organizationUNPINN">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-organizationName" class="form-label">Наименование организации</label>
                    <input type="text" class="form-control" id="Jur-organizationName" readonly>
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-address" class="form-label">Юридический адрес</label>
                    <input type="text" class="form-control" id="Jur-address">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-fullname" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="Jur-fullname">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-position" class="form-label">Должность</label>
                    <input type="text" class="form-control" id="Jur-position">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-actsOnTheBasisOf" class="form-label">Действует на основании</label>
                    <select class="form-control" id="Jur-actsOnTheBasisOf">
                        <option value="1">Устава</option>
                        <option value="2">Доверенности</option>
                        <option value="3">Свидетельства</option>
                    </select>
                </div>
                <div class="col-md-5 m-1 Jur-docInfoToHide d-none">
                    <label for="Jur-actsOnDocNumber" class="form-label">№ документа</label>
                    <input type="text" class="form-control" id="Jur-actsOnDocNumber">
                </div>
                <div class="col-md-5 m-1 Jur-docInfoToHide d-none">
                    <label for="Jur-actsOnDocDate" class="form-label">Дата документа</label>
                    <input type="date" class="form-control" id="Jur-actsOnDocDate">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-bankAccountNumber" class="form-label">Номер счета</label>
                    <input type="text" class="form-control" id="Jur-bankAccountNumber">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Jur-bankData" class="form-label">Реквизиты банка</label>
                    <textarea type="text" class="form-control" id="Jur-bankData"></textarea>
                </div>



            </div>
            <div class="d-none flex-row flex-wrap justify-content-around alert alert-primary"
                 id="Ind-form">
                <div class="col-md-5 m-1">
                    <label for="Ind-fullname" class="form-label">ФИО</label>
                    <input type="text" class="form-control" id="Ind-fullname">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Ind-birthdate" class="form-label">Дата рождения</label>
                    <input type="date" class="form-control" id="Ind-birthdate">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Ind-document" class="form-label">Документ удост. личность</label>
                    <input type="text" class="form-control" id="Ind-document">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Ind-documentSerialNumber" class="form-label">Серия и номер</label>
                    <input type="text" class="form-control" id="Ind-documentSerialNumber">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Ind-documentIssueDate" class="form-label">Дата выдачи</label>
                    <input type="date" class="form-control" id="Ind-documentIssueDate">
                </div>
                <div class="col-md-5 m-1">
                    <label for="Ind-DocumentIssueOrg" class="form-label">Кем выдан</label>
                    <input type="text" class="form-control" id="Ind-DocumentIssueOrg">
                </div>

            </div>
        </div>
<!--disabled-->
        <button id="submitButton"  type="button" class="btn btn-primary btn-block mt-1 mb-4 w-100">Зарегистрироваться</button>
        <div class="d-flex flex-row justify-content-around mb-4">
            Уже есть аккаунт? <a href="/login">Войти</a>
        </div>


        <!-- Submit button  grecaptcha.getResponse() -->
<!--        <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<!--        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>-->
<!--                6Le5zOYqAAAAAIuBThtVywwA1R_aAuMUr-5np8Il-->



    </form>
</div>