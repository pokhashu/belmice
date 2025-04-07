<?php
session_start();

class CustomerLoginController {
    private $pdo;
    private $fromForm;

    public function __construct($pdo, $fromForm) {
        $this->pdo = $pdo;
        $this->fromForm = $fromForm;
    }

//    public function login() {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            $username = $_POST['username'];
//            $password = $_POST['password'];
//
//            $userModel = new User($this->pdo);
//            $user = $userModel->authenticate($username, $password);
//
//            if ($user) {
//                $_SESSION['user'] = $user;
//                $this->logAccess("User $username logged in.");
//                header('Location: /dashboard');
//                exit;
//            } else {
//                echo "<script>alert('Логин или пароль неверный!')</script>";
//            }
//        }
//
//        include $_SERVER['DOCUMENT_ROOT'].'/app/views/admin/login.php';
//    }
//
//    public function logout() {
//        $username = $_SESSION['user']['username'] ?? 'Unknown';
//        $this->logAccess("User $username logged out.");
//        session_destroy();
//        header('Location: /public/index.php');
//    }

    private function logAccess($message) {
        $log_entry = date('Y-m-d H:i:s') . " - $message\n";
        file_put_contents(LOG_FILE, $log_entry, FILE_APPEND);
    }

    public function show(): void
    {
        global $pdo;
        if(isset($_COOKIE["customerUserId"])){
            header("location: /"); //REDO
        }
        if($this->fromForm != ''){
            $fromFormMessage = '<div class="alert alert-info">Внимание! Для заполнения заявок на туристические услуги Вам необходимо выполнить авторизация.<br>Если у вас еще нет аккаунта, Вы можете <a href="/signup">зарегистрироваться</a></div>';
        } else {
            $fromFormMessage = '';
        }
        $fileUniqid = uniqid();
        $page_data = ['wtitle' => 'login', 'js' => true, 'title' => 'Авторизация', 'description' => 'Авторизация аккаунта', 'keywords' => 'слёт, туризм, майс, mice, турагентство', 'og' => ['title' => 'Авторизация', 'description' => 'Авторизация аккаунта', 'keywords' => 'слёт, туризм, майс, mice, турагентство']];
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/head.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/app/views/login.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/static/blocks/footer.php';
    }
}
