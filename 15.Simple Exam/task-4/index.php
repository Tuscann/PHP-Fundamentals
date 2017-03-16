<?php
require_once 'app.php';

$data = $bookService->getIndexViewData();
if (isset($_SESSION['form'])) {
    $data->setFormData($_SESSION['form']);
    unset($_SESSION['form']);
}

if (isset($_POST['add'])) {
    $imageUrl = null;
    if ($_FILES['image']['error'] == 0) {
        $uploadService = new \Services\UploadService();
        $imageUrl = $uploadService->upload(
            $_FILES['image'],
            "images"
        );
    }
    try {
        $bookService->addBook(
            $_POST['isbn'],
            $_POST['author'],
            $_POST['title'],
            $_POST['genre_id'],
            $_POST['language'],
            $_POST['released_on'],
            $_POST['comment'],
            $imageUrl
        );
    } catch (Exception $e) {
        $data->setError($e->getMessage());
    }
    $_SESSION['form'] = $_POST;
    header("Location: index.php");
    exit;
}

$app->loadTemplate("index_frontend", $data);