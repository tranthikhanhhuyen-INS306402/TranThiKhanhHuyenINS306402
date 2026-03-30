<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// ===== FILTER =====
$course_id = (int)($_GET['course_id'] ?? 0);

// ===== PAGINATION =====
$page  = max(1, (int)($_GET['page'] ?? 1));
$limit = 10;
$offset = ($page - 1) * $limit;

// WHERE condition
$where = '';
$params = [];

if ($course_id > 0) {
    $where = 'WHERE e.course_id = ?';
    $params[] = $course_id;
}

// ===== COUNT TOTAL =====
$totalRow = $db->fetch("SELECT COUNT(*) as total FROM enrollments e $where", $params);
$total = $totalRow['total'];
$totalPages = ceil($total / $limit);

// ===== MAIN QUERY =====
$sql = "SELECT e.id,
               s.name  AS student_name,
               s.email,
               c.title AS course_title,
               e.enrolled_at
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses  c ON e.course_id  = c.id
        $where
        ORDER BY e.enrolled_at DESC
        LIMIT $limit OFFSET $offset";

$enrollments = $db->fetchAll($sql, $params);

// ===== LOAD COURSES FOR FILTER =====
$courses = $db->fetchAll("SELECT id, title FROM courses");

// ===== MESSAGE =====
$msg = '';
if (isset($_GET['success'])) $msg = 'Enrollment created!';
if (isset($_GET['deleted'])) $msg = 'Enrollment deleted!';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrollments</title>
</head>
<body>

<h1>Enrollments</h1>

<?php if ($msg): ?>
    <p style="color: green;"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<p>
    <a href="create.php">+ Add Enrollment</a>
</p>

<!-- ===== FILTER ===== -->
<form method="get">
    <label>Filter by course:</label>
    <select name="course_id">
        <option value="0">All</option>
        <?php foreach ($courses as $c): ?>
            <option value="<?= $c['id'] ?>"
                <?= $c['id'] == $course_id ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['title']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filter</button>
</form>

<br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Student</th>
    <th>Email</th>
    <th>Course</th>
    <th>Enrolled At</th>
    <th>Actions</th>
</tr>

<?php foreach ($enrollments as $enroll): ?>
<tr>
    <td><?= $enroll['id'] ?></td>
    <td><?= htmlspecialchars($enroll['student_name']) ?></td>
    <td><?= htmlspecialchars($enroll['email']) ?></td>
    <td><?= htmlspecialchars($enroll['course_title']) ?></td>
    <td><?= $enroll['enrolled_at'] ?></td>
    <td>
        <a href="delete.php?id=<?= $enroll['id'] ?>"
           onclick="return confirm('Cancel this enrollment?');">
            Delete
        </a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<!-- ===== PAGINATION ===== -->
<br>
<div>
<?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?page=<?= $i ?>&course_id=<?= $course_id ?>"
       style="margin-right:5px; <?= $i == $page ? 'font-weight:bold;' : '' ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>
</div>

</body>
</html>