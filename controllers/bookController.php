<?php

class BookController
{
    private $pdo;

    // Constructor to initialize PDO connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // List all books: GET /books
    public function getAllBooks()
    {
        $stmt = $this->pdo->query("SELECT * FROM books");
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($books);
    }


    // Create a new book: POST /books
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


    // Retrieve a single book by ID: GET /books/{id}
    public function getBook($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        if ($book) {
            echo json_encode($book);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Book not found.']);
        }
    }


    // Update an existing book: PUT /books/{id}
    public function updateBook($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['title']) || !isset($input['author']) || !isset($input['published_date'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input.']);
            return;
        }

        $stmt = $this->pdo->prepare("UPDATE books SET title = :title, author = :author, published_date = :published_date, isbn = :isbn WHERE id = :id");
        $stmt->execute([
            ':title' => $input['title'],
            ':author' => $input['author'],
            ':published_date' => $input['published_date'],
            ':isbn' => $input['isbn'] ?? null,
            ':id' => $id,
        ]);

        echo json_encode(['message' => 'Book updated successfully.']);
    }

    // Delete a book: DELETE /books/{id}
    public function deleteBook($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount()) {
            echo json_encode(['message' => 'Book deleted successfully.']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Book not found.']);
        }
    }
}