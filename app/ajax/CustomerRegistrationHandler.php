<?php
include '../config/config.php';
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

$action = $_POST['formName'] ?? '';

if ($action === 'addCustomerUser') {
    if(isset($_POST['email'])) {
//        $name_parts = explode(' ', $_POST['name']);
//        if (count($name_parts) < 3) {
//            $name_parts[2] = "";
//        }
//        'surname'=>$name_parts[0], "name"=>$name_parts[1], "middleName"=>$name_parts[2],
        $stmt = $pdo->prepare("INSERT INTO customerUsers (phone, email, payerType, payerData, regDate) VALUES (:phone, :email, :payerType, :payerData, :regDate)");
        $stmt->execute(['phone' => $_POST['phone'], 'email' => $_POST['email'], "payerType"=>$_POST["payerType"], "payerData"=>$_POST["payerData"], 'regDate' => date('Y-m-d H:i:s', time())]);
//TODO проверка на существование пользователя
        echo json_encode(['status' => 'success', 'userId'=>$pdo->lastInsertId()]);


    } else {
        echo json_encode(['status' => 'error', 'message' => 'Нет соответствующего обработчика']);
    }
}
