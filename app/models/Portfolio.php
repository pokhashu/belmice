<?php

class Portfolio {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPortfolioItem($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM portfolio_items WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBlocks($parentId) {
        $stmt = $this->pdo->prepare("SELECT * FROM blocks WHERE parent_id = :parent_id ORDER BY `order`");
        $stmt->execute(['parent_id' => $parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}