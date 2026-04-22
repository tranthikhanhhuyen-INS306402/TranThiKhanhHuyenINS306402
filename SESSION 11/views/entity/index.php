<?php require __DIR__ . '/../partials/header.php'; ?>

<h2>Library Management - Book List</h2>
<a href="index.php?action=create" class="btn">Add New Book</a>

<table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Year</th>
            <th>Copies</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['isbn']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= htmlspecialchars($row['publisher']) ?></td>
            <td><?= $row['publication_year'] ?></td>
            <td><?= $row['available_copies'] ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $row['id'] ?>">Edit</a> | 
                <a href="index.php?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Delete this book?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>