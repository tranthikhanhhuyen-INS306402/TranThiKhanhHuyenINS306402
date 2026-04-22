<?php
// models/EntityModel.php
require_once __DIR__ . '/../config/database.php';

class EntityModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // READ: Get all books
    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM books ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ: Get a single book by ID for editing
    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE: Insert new book
    public function create(array $data): bool {
        $sql = "INSERT INTO books (isbn, title, author, publisher, publication_year, available_copies) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['isbn'], $data['title'], $data['author'], 
            $data['publisher'], $data['publication_year'], $data['available_copies']
        ]);
    }

    // UPDATE: Modify existing book
    public function update(int $id, array $data): bool {
        $sql = "UPDATE books 
                SET isbn = ?, title = ?, author = ?, publisher = ?, publication_year = ?, available_copies = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['isbn'], $data['title'], $data['author'], 
            $data['publisher'], $data['publication_year'], $data['available_copies'], $id
        ]);
    }

    // DELETE: Remove book
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}