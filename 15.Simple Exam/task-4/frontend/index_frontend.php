<?php /** @var $data \Data\IndexViewData */ ?>

<form method="post" enctype="multipart/form-data">
    Book ID*: <input value="<?=isset($data->getFormData()['isbn']) ? $data->getFormData()['isbn'] : '';?>" type="text" name="isbn"/> <br/>
    Author*: <input value="<?=isset($data->getFormData()['author']) ? $data->getFormData()['author'] : '';?>" type="text" name="author"/> <br/>
    Title*: <input value="<?=isset($data->getFormData()['title']) ? $data->getFormData()['title'] : '';?>" type="text" name="title"/> <br/>
    Language*: <input value="<?=isset($data->getFormData()['language']) ? $data->getFormData()['language'] : '';?>" type="text" name="language"/> <br/>
    Year of release*: <input value="<?=isset($data->getFormData()['released_on']) ? $data->getFormData()['released_on'] : '';?>" type="date" name="released_on"/> <br/>
    Genre*:
    <select name="genre_id">
        <?php foreach ($data->getGenres() as $genre): ?>
            <option <?= isset($data->getFormData()['genre_id'])
            && $data->getFormData()['genre_id'] == $genre->getId()
                ? 'selected'
                : '';?> value="<?=$genre->getId();?>">
                <?=$genre->getName(); ?>
            </option>
        <?php endforeach; ?>
    </select><br/>

    Comment

    <textarea name="comment"></textarea><br/>

    Image: <input type="file" name="image"/>
    <br/>
    <input type="submit" name="add" value="Submit Book"/>
</form>

<?php if($data->getError()): ?>
   <h2><?= $data->getError(); ?></h2>
<?php endif; ?>

<form action="books.php">
    <input type="submit" value="Show Books"/>
</form>