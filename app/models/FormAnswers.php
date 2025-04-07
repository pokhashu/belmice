<?php

class FormAnswers
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addAnswer($answers, $formId): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO formsAnswers (`name`, `surname`, `email`, `phone`, `adultsAmount`, 
                          `childrenAmount`, `parentsAmount`, `specials`, `excursions`, `comment`, `consents`, `formId`, `userId`)
                                                VALUES (:name, :surname, :email, :phone, :adultsAmount, 
                                                         :childrenAmount, :parentsAmount, :specials, :excursions,
                                                         :comment, :consents, :formId, :userId)");
        $params = [
            'name' => $answers['name'],
            'surname' => $answers['surname'],
            'email' => $answers['email'],
            'phone' => $answers['phone'],
            'adultsAmount' => $answers['adultsAmount'],
            'childrenAmount' => $answers['childrenAmount'],
            'parentsAmount' => $answers['parentsAmount'],
            'specials' => json_encode($answers['specials']),
            'excursions' => json_encode($answers['signedupTours']),
            'comment' => $answers['comment'],
            'consents' => json_encode($answers['consents']),
            'formId' => $formId,
            'userId' => $_COOKIE["customerUserId"]
        ];
        $stmt->execute($params);
        return $stmt->lastInsertId();

    }
}