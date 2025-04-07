<?php
include '../config/config.php';
require_once '../controllers/DashboardController.php';
$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

$controller = new DashboardController($db);

require_once '../models/Testimonial.php';
$testimonial = new Testimonial($db);

$action = $_POST['formName'] ?? '';

if ($action === 'uploadTestimonials') {
    if($controller->uploadTestimonial($_FILES['images'])){
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка загрузки файла']);
    }
} else if ($action === 'getTestimonials') {
    $files = $testimonial->getTestimonials();
    echo json_encode(['status' => 'success', 'data'=>$files]);
} else if ($action === 'setTestimonialToMain') {
    $files = $testimonial->setTestimonialToMain($_POST['id'], $_POST['toMain']);
    echo json_encode(['status' => 'success', 'data'=>$files]);
}