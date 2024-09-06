<?php

namespace App\Repository;

use PDO;
use PDOException;

class PostRepository
{
    public PDO $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'my_database';
        $dbusername = 'root';
        $dbpassword = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function findAllPosts(): array
    {
        $query = "SELECT * FROM post;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findPostById(int $id): ?array
    {
        $query = "SELECT * FROM post WHERE id = :id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
