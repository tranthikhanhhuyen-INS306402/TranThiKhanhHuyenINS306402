<?php
require 'Database.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "SELECT p.id, p.name, p.price, p.stock, c.name AS category_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        WHERE 1";

$params = [];

if (!empty($search)) {
    $sql .= " AND p.name LIKE :search";
    $params[':search'] = "%$search%";
}

if (!empty($category)) {
    $sql .= " AND p.category_id = :category";
    $params[':category'] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        /* FILTER BAR */
        .filter-box {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        input, select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        th {
            background: #4CAF50;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        tr:hover {
            background: #f1f1f1;
        }

        /* LOW STOCK */
        .low-stock {
            background: #ffe5e5 !important;
            color: #d8000c;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>📦 Product Admin Dashboard</h2>

    <form method="GET" class="filter-box">
        <input type="text" name="search" placeholder="Search product..."
            value="<?= htmlspecialchars($search) ?>">

        <select name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= ($category == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price ($)</th>
            <th>Category</th>
            <th>Stock</th>
        </tr>

        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $p): ?>
                <tr class="<?= ($p['stock'] < 10) ? 'low-stock' : '' ?>">
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= $p['price'] ?></td>
                    <td><?= htmlspecialchars($p['category_name']) ?></td>
                    <td><?= $p['stock'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="no-data">No products found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>