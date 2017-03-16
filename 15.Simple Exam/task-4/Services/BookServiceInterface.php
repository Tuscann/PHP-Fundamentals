<?php


namespace Services;


use Data\BookViewData;
use Data\Genre;
use Data\IndexViewData;

interface BookServiceInterface
{
    public function addBook($isbn, $author, $title, $genreId, $language, $releasedOn, $comment = null, $imageUrl = null);

    /**
     * @return IndexViewData
     */
    public function getIndexViewData();

    public function editBook($id, $author, $title, $genreId, $language, $comment = null, $imageUrl = null);

    public function deleteId($id);

    /**
     * @return BookViewData[]|\Generator
     */
    public function findAll();
}