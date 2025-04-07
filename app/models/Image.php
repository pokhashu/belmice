<?php
class Image {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function saveImage($path) {
        $stmt = $this->pdo->prepare("INSERT INTO images (path) VALUES (:path)");
        return $stmt->execute(['path' => $path]);
    }

    public function getAllImages() {
        $stmt = $this->pdo->query("SELECT * FROM images");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getImageById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM images WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>