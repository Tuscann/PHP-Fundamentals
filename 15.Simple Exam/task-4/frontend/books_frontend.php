<?php /** @var $data \Data\BookViewData[] */ ?>

<table border="1">
    <thead>
    <tr>
        <th>Book ID</th>
        <th>Book Title</th>
        <th>Author</th>
        <th>Book Language</th>
        <th>Genre</th>
        <th>Year of Release</th>
        <th>Comments</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $book): ?>
        <tr>
            <td><?=$book->getIsbn(); ?></td>
            <td><?=$book->getTitle(); ?></td>
            <td><?=$book->getAuthor(); ?></td>
            <td><?=$book->getLanguage(); ?></td>
            <td><?=$book->getGenre(); ?></td>
            <td><?=$book->getReleasedOn(); ?></td>
            <td><?=$book->getComment(); ?></td>
            <td><img src="<?=$book->getImageUrl();?>" width="30" height="30"/></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
