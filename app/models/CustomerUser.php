<?php
class CustomerUser {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

}

if(isset($_POST)){
    include '../config/config.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $action = $_POST['formName'] ?? '';

    switch ($action) {
        case 'userExists':
            $stmt = $pdo->prepare("SELECT id FROM customerUsers WHERE email = :email");
            $stmt->execute(['email' => $_POST['email']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                $userId = (int)$user['id'];
                echo json_encode(['status' => "success", 'id' => $userId, 'ue'=>true]);
            } else {
                echo json_encode(['status' => "not exists", 'ue'=>false]);
            }

    }



}