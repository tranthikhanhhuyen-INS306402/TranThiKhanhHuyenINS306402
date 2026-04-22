<?php require __DIR__ . '/entity/header.php'; ?>

<h2>Add Book</h2>

<form method="POST" action="index.php?action=store">
    ISBN: <input name="isbn"><br>
    Title: <input name="title"><br>
    Author: <input name="author"><br>
    Publisher: <input name="publisher"><br>
    Year: <input name="year"><br>
    Copies: <input name="copies"><br>

    <button type="submit">Save</button>
</form>

</body>
</html>