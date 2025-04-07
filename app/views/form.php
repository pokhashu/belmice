
<style>
    /* Importing Google Font - Montserrat */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        touch-action: manipulation;
    }

    label {
        font-weight: bold;
    }

    .slider-wrapper {
        overflow: hidden;
        max-width: 1200px;
        margin: 0 70px 55px;
    }

    .card-list .card-item {
        height: auto;
        color: #fff;
        user-select: none;
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        backdrop-filter: blur(30px);
        background: rgb(207 226 255);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 992px) {
        .card-list .card-item {
            padding: 10px 15px;
        }
    }

    @media (max-width: 576px) {
        .card-list .card-item .user-image {
            margin-bottom: 10px;
            width: 125px;
            height: 125px;
        }

    }


    .card-list .card-item .user-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 20px;
        border: 3px solid #fff;
        padding: 4px;
    }

    .card-list .card-item .user-name {
        font-size: 22px;
        color: #141619;
    }

    .card-list .card-item .user-profession {
        font-size: 15px;
        color: #141619;
        font-weight: 500;
        margin: 10px 0 15px;
    }

    .card-list .card-item .user-price {
        font-size: 20px;
        color: #141619;
    }

    .card-list .card-item .message-button {
        font-size: 18px;
        padding: 10px 35px;
        color: #141619;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        background: #fff;
        border: 1px solid transparent;
        transition: 0.2s ease;
        margin-top: 10px;
    }

    .card-list .card-item .message-button:hover {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid #fff;
        color: #fff;
    }

    .card-list .card-item .message-button-signedUp {
        background: #198754;
        color: #fff;
    }

    .card-list .card-item .message-button-signedUp:hover {
        background: #146c43;
    }

    .slider-wrapper .swiper-pagination-bullet {
        background: #0d6efd;;
        height: 13px;
        width: 13px;
        opacity: 0.5;
    }

    .slider-wrapper .swiper-pagination-bullet-active {
        opacity: 1;
    }

    .slider-wrapper .swiper-slide-button {
        color: #cfe2ff;;
        margin-top: -55px;
        transition: 0.2s ease;
    }

    .slider-wrapper .swiper-slide-button:hover {
        color: #4658ff;
    }

    @media (max-width: 768px) {
        .slider-wrapper {
            margin: 0 10px 40px;
        }

        .slider-wrapper .swiper-slide-button {
            display: none;
        }
    }
</style>
<div class="container pt-2">
    <h1 class="mb-3"><?=$pageData['title']?></h1>
    <hr>
    <h3 class="mt-4">Данные контактного лица</h3>
    <form class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control validate" placeholder="Иванов" id="name">
        </div>
        <div class="col-md-6">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control validate" placeholder="Иван" id="surname">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control validate" placeholder="address@example.com" id="email">
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" class="form-control validate digitsOnly" pattern="\d*" inputmode="numeric" placeholder="80290001122" id="phone">
        </div>
        <hr class="mt-5">
        <table class="table table-borderless">
            <tbody>
            <tr>
            </tr>
            <tr>
                <td colspan="2" class="h4">Количество детей до 18 лет</td>
                <td>
                    <div class="d-flex flex-row align-items-start flex-wrap">
                        <span class="fw-bold h5"><input id="childrenAmount" type="text" placeholder="1" pattern="\d*"
                                                        inputmode="numeric"
                                                        class="form-control peopleAmount digitsOnly validate"
                                                        style="text-align: center; font-weight: bolder; width: 70px"></span>&nbsp;
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" onclick="dec('#childrenAmount')"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-primary" onclick="inc('#childrenAmount')"><i
                                        class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="h4">Количество родителей</td>
                <td>
                    <div class="d-flex flex-row align-items-start flex-wrap">
                        <span class="fw-bold h5"><input id="parentsAmount" type="text" placeholder="1"
                                                        pattern="\d*" inputmode="numeric"
                                                        class="form-control peopleAmount digitsOnly validate"
                                                        style="text-align: center; font-weight: bolder; width: 70px"></span>&nbsp;
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" onclick="dec('#parentsAmount')"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-primary" onclick="inc('#parentsAmount')"><i
                                        class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="h4">Количество сопровождающих (педагоги и пр.)</td>
                <td>
                    <div class="d-flex flex-row align-items-start flex-wrap">
                        <span class="fw-bold h5"><input id="adultsAmount" type="text" placeholder="1" pattern="\d*"
                                                        inputmode="numeric"
                                                        class="form-control peopleAmount digitsOnly validate"
                                                        style="text-align: center; font-weight: bolder; width: 70px"></span>&nbsp;
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" onclick="dec('#adultsAmount')"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-primary" onclick="inc('#adultsAmount')"><i
                                        class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <h4>Особые предпочтения<span class="text-danger">*</span></h4>
        <div class="container px-2">
            <?=$pageData['specials']?>
        </div>

        <div class="alert alert-warning h5">
            <span class="text-danger">*</span> <b>Внимание!</b> Все вышеперечисленные услуги оказываются за
            дополнительную плату (обговаривается отдельно с оргкомитетом)
        </div>

        <hr>
        <h2>Экскурсии</h2>
        <div class="container swiper">
            <div class="slider-wrapper">
                <div class="card-list swiper-wrapper">
                    <?=$pageData['excursions']?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>
            </div>
        </div>
        <div>
            <div class="alert alert-secondary" id="signedupTours">
                <h2>Выбранные экскурсии:</h2>
                <p>Пожалуйста, заполните данные о предполагаемом количестве человек для каждой экскурсии.</p>
            </div>

        </div>

        <hr class="mt-4">
        <div class="form-control mb-3">
            <label for="comment">Укажите Ваши пожелания. Пометьте особенности, которые нам необходимо знать</label>
            <textarea class="form-control" id="comment"
                      style="min-height: 100px; max-height: 200px"></textarea>
        </div>
        <div class="form-check">
            <input class="form-check-input validate" type="checkbox" value="" id="agreementWithTerms">
            <label class="form-check-label" for="agreementWithTerms">
                Я ознакомлен(а) и согласен(на) с условиями туристического слёта
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input validate" type="checkbox" value="" id="agreementWithPersonalDataPolicy">
            <label class="form-check-label" for="agreementWithPersonalDataPolicy">
                Я ознакомлен(а) и согласен(на) с <a target="_blank" href="https://service.zvezdo4et.com/src/ПОЛОЖЕНИЕ%20О%20ПОЛИТИКЕ%20ПЕРСОНАЛНЫХ%20ДАННЫХ.pdf?v=<?=uniqid()?>">политикой обработки персональных данных</a>
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input validate" type="checkbox" value="" id="agreementWithOtherConditions">
            <label class="form-check-label" for="agreementWithOtherConditions">
                Я ознакомлен(а) и согласен(на) с <a target="_blank" href="<?=$pageData['regulationsLink']?>">положением</a>
            </label>
        </div>
<!--        <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<!--        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>-->
<!--        6Le5zOYqAAAAAIuBThtVywwA1R_aAuMUr-5np8Il-->

        <div class="col-12 mb-5 mt-4">
            <button type="submit" class="btn btn-primary w-100"><span class="h4">Отправить заявку</span></button>
        </div>
    </form>
</div>


