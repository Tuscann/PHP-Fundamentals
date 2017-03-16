<?php


namespace Services;


use Adapter\DatabaseInterface;
use Data\BookViewData;
use Data\Genre;
use Data\IndexViewData;

class BookService implements BookServiceInterface
{
    private $db;
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }


    public function addBook($isbn,
                            $author,
                            $title,
                            $genreId,
                            $language,
                            $releasedOn,
                            $comment = null,
                            $imageUrl = null)
    {

        foreach (func_get_args() as $argName => $value) {
            if (empty($value) && $argName < 6) {
                throw new \Exception("Cannot be empty");
            }
        }

        new \DateTime($releasedOn);

        if (!$this->genreExists($genreId)) {
            throw new \Exception("Genre does not exist");
        }

        $query = "
            INSERT INTO books
            SET 
              ISBN = ?,
              title = ?,
              genre_id = ?,
              author = ?,
              released_on = ?,
              comment = ?,
              language = ?,
              image_url = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $isbn, $title, $genreId, $author, $releasedOn,
            $comment, $language, $imageUrl
        ]);
    }


    public function getIndexViewData()
    {
        $query = "SELECT id, name FROM genres";
        $stmt = $this->db->prepare($query);
        $stmt->execute([]);

        $viewData = new IndexViewData();
        $viewData->setGenres(
            function() use($stmt) {
                while ($genre = $stmt->fetchObject(Genre::class)) {
                    yield $genre;
                }
            }
        );

        return $viewData;
    }

    public function editBook($id, $author, $title, $genreId, $language, $comment = null, $imageUrl = null)
    {
        // TODO: Implement editBook() method.
    }

    public function deleteId($id)
    {
        // TODO: Implement deleteId() method.
    }

    private function genreExists($id)
    {
        $query = "SELECT id FROM genres WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        $row = $stmt->fetchRow();

        return !!$row;
    }

    /**
     * @return BookViewData[]|\Generator
     */
    public function findAll()
    {
        $query = "
            SELECT
              books.id,
              isbn,
              title,
              genres.name AS genre,
              author,
              YEAR(released_on) AS releasedOn,
              comment,
              language,
              image_url AS imageUrl
            FROM
               books
            INNER JOIN
               genres
            ON
               books.genre_id = genres.id
            ORDER BY
               books.released_on DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        while ($book = $stmt->fetchObject(BookViewData::class)) {
            yield $book;
        }
    }
}