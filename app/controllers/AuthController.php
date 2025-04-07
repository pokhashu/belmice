<?php
session_start();

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User($this->pdo);
            $user = $userModel->authenticate($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $this->logAccess("User $username logged in.");
                header('Location: /dashboard');
                exit;
            } else {
                echo "<script>alert('Логин или пароль неверный!')</script>";
            }
        }

        include $_SERVER['DOCUMENT_ROOT'].'/app/views/admin/login.php';
    }

    public function logout() {
        $username = $_SESSION['user']['username'] ?? 'Unknown';
        $this->logAccess("User $username logged out.");
        session_destroy();
        header('Location: /public/index.php');
    }

    private function logAccess($message) {
        $log_entry = date('Y-m-d H:i:s') . " - $message\n";
        file_put_contents(LOG_FILE, $log_entry, FILE_APPEND);
    }
}
?>