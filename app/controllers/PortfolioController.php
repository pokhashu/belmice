<?php

class PortfolioController {
    private $portfolioModel;

    public function __construct($portfolioModel) {
        $this->portfolioModel = $portfolioModel;
    }

    public function show($id) {
//        $item = $this->portfolioModel->getPortfolioItem($id);
        $item = ["title" => "Portfolio", "id" => $id];
//        $blocks = $this->portfolioModel->getBlocks($id);
        $blocks = [["type"=> "text", "content"=> "hello world"], ["type"=> "image", "content"=> "logo.png"]];
        include './app/views/portfolio/show.php';
    }
}