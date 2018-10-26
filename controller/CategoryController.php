<?php

/**
 * Description of CategoryController
 *
 * @author Robby
 */
class CategoryController {

    private $categoryDao; /* @var $categoryDao CategoryDaoImpl */

    public function __construct() {
        $this->categoryDao = new CategoryDaoImpl();
    }

    public function index() {
        $command = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($command) && $command == 'rem') {
            $id = filter_input(INPUT_GET, 'tod', FILTER_SANITIZE_SPECIAL_CHARS);
            $toBeDeletedCategory = new Category();
            $toBeDeletedCategory->setId($id);
            $this->categoryDao->deleteCategory($toBeDeletedCategory);
        }

        $submitPressed = filter_input(INPUT_POST, "btnSubmit");
        if (isset($submitPressed)) {
            $name = filter_input(INPUT_POST, "txtCatName",
                    FILTER_SANITIZE_SPECIAL_CHARS);
            $newCategory = new Category();
            $newCategory->setName($name);
            $this->categoryDao->addNewCategory($newCategory);
        }
        $categories = $this->categoryDao->getAllCategories();
        include_once 'view/view_category.php';
    }

    public function updateIndex() {
        /* @var $categoryData Category */
        $command = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($command) && $command == 'udt') {
            $id = filter_input(INPUT_GET, 'tod', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryData = $this->categoryDao->getCategoryFromDb($id);
        }

        $submitUpdate = filter_input(INPUT_POST, 'btnUpdate');
        if (isset($submitUpdate)) {
            $newName = filter_input(INPUT_POST, 'txtCatName');
            $categoryData->setName($newName);
            $this->categoryDao->updateCategory($categoryData);
            header("location:index.php?navito=category");
        }
        include_once 'view/view_category_update.php';
    }

}
