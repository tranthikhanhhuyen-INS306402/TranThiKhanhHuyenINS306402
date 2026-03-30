<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$db = Database::getInstance();

$students = $db->fetchAll('SELECT id, name FROM students');
$courses  = $db->fetchAll('SELECT id, title FROM courses');

$errors = [];
$student_id = 0;
$course_id  = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // ===== 1. LẤY DATA =====
        $student_id = (int)($_POST['student_id'] ?? 0);
        $course_id  = (int)($_POST['course_id'] ?? 0);

        // ===== 2. VALIDATE =====
        $errors = [];

        if ($student_id <= 0) {
            $errors['student_id'] = 'Please select a student';
        }

        if ($course_id <= 0) {
            $errors['course_id'] = 'Please select a course';
        }

        // 👉 NẾU CÓ LỖI → THROW
        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        // ===== 3. CHECK DUPLICATE =====
        $exists = $db->fetch(
            'SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?',
            [$student_id, $course_id]
        );

        if ($exists) {
            throw new ValidationException([
                'general' => 'This student already enrolled'
            ]);
        }

        // ===== 4. INSERT =====
        $db->insert('enrollments', [
            'student_id' => $student_id,
            'course_id'  => $course_id
        ]);

        header('Location: index.php?success=1');
        exit;

    } catch (ValidationException $e) {
        // 👉 LỖI VALIDATION
        $errors = $e->getErrors();

    } catch (Exception $e) {
        // 👉 LỖI SYSTEM
        $errors['general'] = 'System error, try again';
    }
}
?>