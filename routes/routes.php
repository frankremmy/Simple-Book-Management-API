<?php

// List all books
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/books') {
    $bookController->getAllBooks();
}

// Retrieve a single book by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('/\/books\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $bookController->getBook($matches[1]);
}

// Create a new book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/books') {
    $bookController->createBook();
}

// Update an existing book
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && preg_match('/\/books\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $bookController->updateBook($matches[1]);
}

// Delete a book
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && preg_match('/\/books\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $bookController->deleteBook($matches[1]);
}