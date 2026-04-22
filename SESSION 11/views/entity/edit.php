<?php require __DIR__ . '/entity/header.php'; ?>

<h2>Edit Book</h2>

<form method="POST" action="index.php?action=update">
    <input type="hidden" name="id" value="<?= $record['id'] ?>">

    ISBN: <input name="isbn" value="<?= $record['isbn'] ?>"><br>
    Title: <input name="title" value="<?= $record['title'] ?>"><br>
    Author: <input name="author" value="<?= $record['author'] ?>"><br>
    Publisher: <input name="publisher" value="<?= $record['publisher'] ?>"><br>
    Year: <input name="year" value="<?= $record['publication_year'] ?>"><br>
    Copies: <input name="copies" value="<?= $record['available_copies'] ?>"><br>

    <button type="submit">Update</button>
</form>

</body>
</html>