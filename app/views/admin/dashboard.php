<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /public/index.php');
    exit;
}

?>


    <style>
        #imageGallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-block {
            position: relative;
            display: inline-block;
        }

        .image {
            max-width: 200px;
            margin: 10px;
        }

        .image-checkbox {
            display: none; /* Скрываем стандартный чекбокс */
        }

        .star-checkbox {
            position: absolute;
            top: 5px;
            left: 5px;
            width: 30px; /* Размер звезды */
            height: 30px; /* Размер звезды */
            background: url('/public/images/starCheckbox.png') no-repeat center center;
            background-size: contain; /* Изображение звезды полностью вмещается */
            cursor: pointer;
        }

        .image-checkbox:checked + .star-checkbox {
            background: url('/public/images/starCheckboxChecked.png') no-repeat center center; /* Изображение звезды при выборе */
            background-size: contain;
        }
        /* Добавляем обводку при выборе */
        .image-checkbox:checked ~ .image {
            border: 2px solid goldenrod; /* Синяя обводка */
        }
    </style>

<div class="container">
    <h1>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h1>

    <h2>Благодарности</h2>
    <form id="uploadTestimonial" enctype="multipart/form-data">
        <input id="uploadTestimonialFiles" type="file" name="images[]" multiple required>
        <button type="submit" id="uploadTestimonialButton">Загрузить</button>
    </form>


    <h2>Все благодарности</h2>
    <div id="testimonialsGallery">
    </div>
</div>
<script src="/app/views/js/dashboard.js"></script>


