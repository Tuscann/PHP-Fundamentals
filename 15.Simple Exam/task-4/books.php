<?php
require_once 'app.php';

$data = $bookService->findAll();

$app->loadTemplate("books_frontend", $data);