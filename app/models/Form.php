<?php

class Form
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getForm($formName): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM forms WHERE url = :formName");
        $stmt->execute(['formName' => $formName]); // Выполняем запрос
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($r)){
            return array();
        } else {
            return $r[0];
        }
    }

    public function generateSpecials($specials): string
    {
        $specialsBlock = '';
        if (is_null($specials)) {
            return "<div class='alert alert-danger'>Дополнительный услуги отсутствуют!</div>";
        } else {
            foreach (json_decode($specials, true)['specials'] as $special) {
                $specialsBlock .=
                    '<div class="form-check my-2">
                    <input class="form-check-input specials" type="checkbox" value="" id="' . $special['id'] . '">
                    <label class="form-check-label" for="' . $special['id'] . '">
                        ' . $special['text'] . '
                    </label>
                </div>';
            }
            return $specialsBlock;
        }
    }

    public function generateExcursions($excursions)
    {
        if (is_null($excursions)) {
            return "<div class='alert alert-danger'>Экскурсии отсутствуют!</div>";
        } else {
            $excursionsBlock = "";
            $image = new Image($this->pdo);
            foreach (json_decode($excursions, true)['excursions'] as $excursion) {
                $imagePath = $image->getImageById($excursion['imageId'])['path']; // TODO СДЕЛАТЬ PATH К ЛОКАЛЬНОМУ ФАЙЛУ

                $excursionsBlock.=
                    '<div class="card-item swiper-slide" data-id="'.$excursion['id'].'">
                        <img src="'.$imagePath.'" class="user-image" loading="lazy">
                        <h2 class="user-name">'.$excursion['title'].'</h2>
                        <p class="user-profession">'.$excursion['text'].'</p>
                        <h3 class="user-price">От <b>'.$excursion['price'].'</b></h3>
                        <button type="button" class="message-button" onclick="addTourToSignedup(this)">Записаться</button>
                    </div>';
            }
            return $excursionsBlock;
        }
    }


}