<?php
class Testimonial {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addTestimonial($fileName) {
        $stmt = $this->pdo->prepare("INSERT INTO testimonials (fileName) VALUES (:fileName)");
        return $stmt->execute(['fileName' => $fileName]);
    }

    public function getTestimonials() {
        $stmt = $this->pdo->prepare("SELECT * FROM testimonials");
        $stmt->execute(); // Выполняем запрос
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTestimonial($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM testimonials WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function deleteTestimonial($id) {
        $stmt = $this->pdo->prepare("DELETE FROM testimonials WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function setTestimonialToMain($id, $status) {
        $status = $status=='false'?0:1;
        $stmt = $this->pdo->prepare("UPDATE testimonials SET toMain = :status WHERE id = :id");
        return $stmt->execute(['status'=>$status, 'id' => $id]);
    }


}


?>