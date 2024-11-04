<?php

// Create a Book: POST /books
public function createBook()
{
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['title']) || !isset($input['author']) || !isset($input['published_date'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input.']);
        return;
    }

    $stmt = $this->pdo->prepare("INSERT INTO books (title, author, published_date, isbn) VALUES (:title, :author, :published_date, :isbn)");
    $stmt->execute([
        ':title' => $input['title'],
        ':author' => $input['author'],
        ':published_date' => $input['published_date'],
        ':isbn' => $input['isbn'] ?? null,
    ]);

    http_response_code(201);
    echo json_encode(['message' => 'Book created successfully.']);
}