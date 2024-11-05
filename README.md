# Book Management API

This is a simple CRUD API for managing a collection of books. It allows users to create, read, update, and delete book entries through HTTP requests.


## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/simple-book-management-api.git
   cd simple-book-management-api
   
2. Install dependencies
    ```bash
   composer install

## Configuration

1. Create a `.env` file in the root directory and add your database configuration:
    ```plaintext
   DB_HOST=localhost
   DB_PORT=3306
    DB_DATABASE=book_api
    DB_USERNAME=your_mysql_username
    DB_PASSWORD=your_password
   
2. Set up the database by creating a MySQL database named `book_api`** or the name you’ve configured in `.env`:
    ```sql
   CREATE DATABASE book_api;

3. Create the `books` table:
    ```sql
   CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    published_date DATE,
    isbn VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

## Starting the Server

To start the PHP built-in server, navigate to the project root and run:
    
    php -S localhost:8000 -t public

This will start the server on `http://localhost:8000`.

## API Endpoints

### Create a Book

- **Method**: `POST`
- **URL**: `/books`
- **Body** (JSON):
  ```json
  {
      "title": "Book Title",
      "author": "Author Name",
      "published_date": "YYYY-MM-DD",
      "isbn": "1234567890123"
  }

- **Response**:
  ```json
  { "message": "Book created successfully." }

### Get All Books

- **Method**: `GET`
- **URL**: `/books`
- **Response**:
  ```json
  [
    {
        "id": 1,
        "title": "To Kill a Mockingbird",
        "author": "Harper Lee",
        "published_date": "1960-07-11",
        "isbn": "9780061120084",
        "created_at": "2024-01-01 12:00:00"
    },
    ...
  ]

### Get a Book by ID

- **Method**: `GET`
- **URL**: `/books/{id}`
- **Response**:
  ```json
  [
    {
        "id": 1,
        "title": "To Kill a Mockingbird",
        "author": "Harper Lee",
        "published_date": "1960-07-11",
        "isbn": "9780061120084",
        "created_at": "2024-01-01 12:00:00"
    },
    ...
  ]

### Update a Book

- **Method**: `PUT`
- **URL**: `/books/{id}`
- **Body**:
  ```json
  {
    "title": "Updated Book Title",
    "author": "Updated Author",
    "published_date": "YYYY-MM-DD",
    "isbn": "1234567890123"
  }

- **Response**:
  ```json
  { "message": "Book updated successfully." }

### Delete a Book

**Method**: `DELETE`
**URL**: `/books/{id}`
- **Response**:
  ```json
  { "message": "Book deleted successfully." }


## Error Handling
If an error occurs (e.g., book not found, invalid input), the API will return a JSON response with an appropriate HTTP status code and error message, such as:
`  { "message": "Book not found." } 
`
### Notes

* Make sure to set up .env properly to connect to the MySQL database.
* All responses are in JSON format.
* The API is designed for local development and testing. For production use, consider using a more robust server and add authentication.