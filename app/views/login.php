<div class="container col-sm-10 col-md-8 col-lg-6 mt-5">

    <?=$fromFormMessage?>
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

        <div class="d-flex flex-row justify-content-around mb-4">
            <a href="/signup">Зарегистрироваться</a>
            <a href="#">Забыли пароль?</a>
        </div>

<!--        <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<!--        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>-->
        <!--        6Le5zOYqAAAAAIuBThtVywwA1R_aAuMUr-5np8Il-->
<!--        <button  type="button" class="btn btn-primary btn-block mt-4 mb-4 w-100">Войти</button>-->
    </form>
</div>