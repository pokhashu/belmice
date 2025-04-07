<?php
include '../config/config.php';
require_once '../controllers/FormController.php';
require_once '../models/FormAnswers.php';
require_once '../helpers/mail.php';

$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

$formAnswers = new FormAnswers($db);

$action = $_POST['formName'] ?? '';

switch ($action) {
    case 'addAnswer':
        $id = $formAnswers->addAnswer($_POST['answers'], $_POST['formId']);
        if ($id) {
            echo json_encode(['status' => 'success', 'applicationId'=>$id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ошибка загрузки файла']);
        }
        break;
    case 'sendApproval':
        $m = sendMail($_POST['email'], "Заявка принята", "application_accepted", ["surname"=>$_POST['surname'],"name"=>$_POST['name'],"phone"=>$_POST['phone'],"email"=>$_POST['email'],"applicationId"=>$_POST['applicationId']]);


}
