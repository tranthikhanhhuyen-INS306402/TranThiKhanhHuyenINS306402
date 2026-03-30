<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// Lấy danh sách courses
$courses = $db->fetchAll('SELECT * FROM courses ORDER BY created_at DESC');

// Message
$msg = '';
if (isset($_GET['success'])) $msg = 'Course created!';
if (isset($_GET['updated'])) $msg = 'Course updated!';
if (isset($_GET['deleted'])) $msg = 'Course deleted!';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
</head>
<body>

<h1>Course Management</h1>

<?php if ($msg): ?>
    <p style="color: green;"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<a href="create.php">+ Add Course</a>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Created</th>
    <th>Action</th>
</tr>

<?php foreach ($courses as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= htmlspecialchars($c['title']) ?></td>
    <td><?= htmlspecialchars($c['description']) ?></td>
    <td><?= $c['created_at'] ?></td>
    <td>
        <a href="edit.php?id=<?= $c['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $c['id'] ?>"
           onclick="return confirm('Delete this course?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>