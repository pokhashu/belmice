<?php

class FormController
{
    private $pdo;
    private $formName;

    public function __construct($pdo, $formName)
    {
        $this->pdo = $pdo;
        $this->formName = $formName;
    }


    public function show(): void
    {
        global $pdo;
        if(!isset($_COOKIE["customerUserId"])){
            header("location: /login/fromForm");
            exit;
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Image.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Form.php';
        $form = new Form($this->pdo);
        $fileUniqid = uniqid();
        $formData = $form->getForm($this->formName);
        if (empty($formData)) {
            $page_data = ['title' => 'Ошибка', 'description' => 'Ошибка', 'keywords' => 'заявка, форма, слёт, туризм, майс, mice, турагентство', 'og' => ['title' => 'Ошибка', 'description' => 'Ошибка', 'keywords' => 'заявка, форма, слёт, туризм, майс, mice, турагентство']];
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/head.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/header.php';
            echo "<div class='mx-2 alert alert-danger'><h2>Такой формы не существует!</h2></div>";
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/footer.php';

        } else {
            $page_data = ['wtitle' => 'form', 'js' => true, 'title' => 'Подача заявки', 'description' => 'Подача заявки на ' . $formData['title'], 'keywords' => 'заявка, форма, слёт, туризм, майс, mice, турагентство', 'og' => ['title' => 'Подача заявки', 'description' => 'Подача заявки на ' . $formData['title'], 'keywords' => 'заявка, форма, слёт, туризм, майс, mice, турагентство']];
            $pageData = [
                'title' => $formData['title'],
                'specials' => $form->generateSpecials($formData['specials']),
                'excursions' => $form->generateExcursions($formData['excursions']),
                'regulationsLink' => $formData['regulationsLink'],
            ];
            echo "<script> const formId = ".$formData['id']."</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/head.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/header.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/app/views/form.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/footer.php';
        }


    }

}
