<?php
session_start();

class CustomerRegistrationController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function show(): void
    {
        global $pdo;
        if(isset($_COOKIE["customerUserId"])){
            header("location: /"); //REDO
        }
        $fileUniqid = uniqid();
        $page_data = ['wtitle' => 'registration', 'js' => true, 'title' => 'Регистрация', 'description' => 'Регистрация аккаунта', 'keywords' => 'слёт, туризм, майс, mice, турагентство', 'og' => ['title' => 'Регистрация', 'description' => 'Регистрация аккаунта', 'keywords' => 'слёт, туризм, майс, mice, турагентство']];
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/head.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/app/views/registration.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/footer.php';
    }
}
