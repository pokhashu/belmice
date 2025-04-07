
<div class="page-block page-block-1 d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-xl navbar-light bg-light text-title">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img class="header-logo" src="/public/images/mainPage/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">МЕРОПРИЯТИЯ</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="#">Маркетинговые</a></li>
                                <li><a class="dropdown-item" href="#">Тимбилдинги</a></li>
                                <li><a class="dropdown-item" href="#">Корпоративы и праздники</a></li>
                                <li><a class="dropdown-item" href="#">Деловые мероприятия</a></li>
                                <li><a class="dropdown-item" href="#">Конгрессы и форумы</a></li>
                                <li><a class="dropdown-item" href="#">Культурные</a></li>
                                <li><a class="dropdown-item" href="#">Продюсирование</a></li>
                                <li><a class="dropdown-item" href="#">GR/PR мероприятия</a></li>
                                <li><a class="dropdown-item" href="#">Социально-значимые</a></li>
                            </ul>
                        </li>
<!--                        <li class="nav-item">-->
<!--                            <a class="nav-link" href="#">Туры</a>-->
<!--                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="/about">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Портфолио</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Новости</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Отзывы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Вопросы</a>
                        </li>
                        <li class="nav-item" style="text-align: center">
                            <a class="nav-link" href="#">Что посмотреть<br> в Беларуси</a>
                        </li>
                        <li class="nav-item" style="text-align: right">
                            <span class="nav-link"><a href="mailto:info@micebel.by">info@micebel.by</a><br><a href="tel:+375293396106">+375 29 339 61 06</a></span>
                        </li>
                    </ul>
                </div>
            </div>




            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">МЕРОПРИЯТИЯ</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Маркетинговые</a></li>
                            <li><a class="dropdown-item" href="#">Тимбилдинги</a></li>
                            <li><a class="dropdown-item" href="#">Корпоративы и праздники</a></li>
                            <li><a class="dropdown-item" href="#">Деловые мероприятия</a></li>
                            <li><a class="dropdown-item" href="#">Конгрессы и форумы</a></li>
                            <li><a class="dropdown-item" href="#">Культурные</a></li>
                            <li><a class="dropdown-item" href="#">Продюсирование</a></li>
                            <li><a class="dropdown-item" href="#">GR/PR мероприятия</a></li>
                            <li><a class="dropdown-item" href="#">Социально-значимые</a></li>
                            <!--                                <li><hr class="dropdown-divider"></li>-->
                            <!--                                <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                        </ul>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="#">Туры</a>-->
<!--                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="/about">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Портфолио</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Новости</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Отзывы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Вопросы</a>
                    </li>
                    <li class="nav-item" style="text-align: center">
                        <a class="nav-link" href="#">Что посмотреть<br> в Беларуси</a>
                    </li>
                    <li class="nav-item" style="text-align: right">
                        <span class="nav-link"><a href="mailto:info@belmice.by">info@belmice.by</a><br><a href="tel:+375293396106">+375 29 339 61 06</a></span>
                    </li>
                </ul>
            </div>
        </div>
        <p class="text-head"><?php if(isset($page_data) && key_exists('title', $page_data)){echo $page_data['title'];}else{echo "ТУРИЗМ • ПУТЕШЕСТВИЯ";} ?></p>
    </nav>
    <div class="header-text pb-sm-3  pb-lg-5 px-5 pt-5">

        <p class="text-title" style="">
            "Витаю в облаках" — место,<br>
            где дело встречается с вдохновением!
        </p>
    </div>
</div>