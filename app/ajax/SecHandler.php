<?php
include '../config/config.php';
require_once '../helpers/mail.php';
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
function generateSixDigitNumber() {
    return rand(100000, 999999);
}
$action = $_POST['formName'] ?? '';

if ($action === 'sendEmailAuth') {
    if(isset($_POST['email'])) {
        $code = generateSixDigitNumber();
        $stmt = $pdo->prepare("UPDATE `emailCodes` SET `expiresAt` = '1970-01-02 00:00:01' WHERE `email` = :email; INSERT INTO emailCodes (code, email, expiresAt) VALUES (:code, :email, :expiresAt)");
        $stmt->execute(['code' => $code, 'email' => $_POST['email'], 'expiresAt' => date('Y-m-d H:i:s', time()+5*60)]);

        $m = sendMail($_POST['email'], "Код подтверждения", "email_confirmation", ["confirmation_code"=>$code]);
        if(json_decode($m)->errs==0){
        echo json_encode(['status' => 'success', 'h'=>md5(md5((string)$code))]);
        } else {
            echo json_encode(['status' => 'error', "message"=>json_decode($m)->res]);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Нет соответствующего обработчика']);
    }
}
