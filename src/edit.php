<?php
require_once 'db.php';

$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);

$todo = ORM::for_table('todos')->find_one($id);

if (!$todo) {

   exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TODO 編集</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>TODO 編集</h1>

        <?php if (isset($_GET['error'])): ?>
        <p>
            <?php
            if ($_GET['error'] === 'empty') {
                echo 'タイトルを入力してください';
            } elseif ($_GET['error'] === 'toolong') {
                echo 'タイトルは200文字以内で入力してください';
            }
            ?>
        </p>
    <?php endif; ?>

    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $todo->id ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($todo->title) ?>" required>
        <button type="submit">編集</button>
    </form>

    <p>
        <a href="index.php">戻る</a>
    </p>
</body>

</html>