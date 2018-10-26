<?php

/**
 * Description of BookController
 *
 * @author Robby
 */
class BookController {
    /* @var $bookDao BookDaoImpl */

    private $bookDao;
    /* @var $categoryDao CategoryDaoImpl */
    private $categoryDao;

    public function __construct() {
        $this->bookDao = new BookDaoImpl();
        $this->categoryDao = new CategoryDaoImpl();
    }

    public function index() {
        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if ($submitPressed) {
            $isbn = filter_input(INPUT_POST, "txtIsbn");
            $title = filter_input(INPUT_POST, "txtTitle");
            $author = filter_input(INPUT_POST, "txtAuthor");
            $publisher = filter_input(INPUT_POST, "txtPublisher");
            $year = filter_input(INPUT_POST, "txtYear");
            $cover = "";
            $categoryId = filter_input(INPUT_POST, "selCategory");
            $category = $this->categoryDao->getCategoryFromDb($categoryId);
            $book = new Book();
            $book->setAuthor($author);
            $book->setCategory($category);
            $book->setCover($cover);
            $book->setIsbn($isbn);
            $book->setPublish_year($year);
            $book->setPublisher($publisher);
            $book->setTitle($title);
            $this->bookDao->addNewBook($book);
        }
        $books = $this->bookDao->getAllBooks();
        $categories = $this->categoryDao->getAllCategories();
        include_once 'view/view_book.php';
    }

}
