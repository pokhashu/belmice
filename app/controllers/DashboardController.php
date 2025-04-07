<?php
class DashboardController
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function uploadTestimonial($images) {
        require_once '../models/Testimonial.php';
        $testimonial = new Testimonial($this->pdo);
        $status = 1;
        if (isset($images)) {
            foreach ($images['tmp_name'] as $key => $tmp_name) {
                if ($images['error'][$key] === UPLOAD_ERR_OK) {
                    $originalName = $images['name'][$key];
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $uniqueName = uniqid() . '.' . $extension;
                    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/public/images/testimonials/' . $uniqueName;

                    if (move_uploaded_file($tmp_name, $uploadPath)) {
                        $testimonial->addTestimonial($uniqueName);
                    } else {
                        $status = 0;
                    }
                } else {
                    $status = 0;
                }
            }
        } else {
            $status = 0;
        }
        return $status;
    }


    public function show()
    {
        global $pdo;
        require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/Image.php';
        $page_data = ['title' => 'Панель управления', 'description' => '', 'keywords' => '', 'og' => ['title' => 'Панель управления', 'description' => '', 'keywords' => '']];

        include $_SERVER['DOCUMENT_ROOT'].'/static/blocks/head.php';
//        include $_SERVER['DOCUMENT_ROOT'].'/static/blocks/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/app/views/admin/dashboard.php';
//        include $_SERVER['DOCUMENT_ROOT'].'/static/blocks/footer.php';

    }

}


