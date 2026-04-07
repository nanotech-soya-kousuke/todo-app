<?php
require_once 'db.php';

$todos_done = ORM::for_table('todos')
    ->where('is_done', true)
    ->order_by_asc('created_at')
    ->find_many();

$todos_todo = ORM::for_table('todos')
    ->where('is_done', false)
    ->order_by_asc('created_at')
    ->find_many();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TODO 一覧</title>
    <link rel="stylesheet" href="css/style.css">

    <script>
        function confirmDelete(form) {
            if (confirm("本当に削除しますか？")) {
                form.submit();
            }
            return false;
        }
    </script>

</head>

<body>

    <h1>TODO 一覧</h1>

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

    <form action="add.php" method="post">
        <input type="text" name="title" placeholder="TODO を入力" required>
        <button type="submit">追加</button>
    </form>

    <h2>未完了</h2>
    <ul>
        <?php foreach ($todos_todo as $todo): ?>
            <li>
                [ ] <?= htmlspecialchars($todo->title) ?> (<?= $todo->created_at ?>)
                <form action="complete.php" method="post" style="display:inline">
                    <input type="hidden" name="id" value="<?= $todo->id ?>">
                    <button type="submit">完了にする</button>
                </form>
                <form action="edit.php" method="post" style="display:inline">
                    <input type="hidden" name="id" value="<?= $todo->id ?>">
                    <button type="submit">編集</button>
                </form>
                <form action="delete.php" method="post" style="display:inline" onsubmit="return confirmDelete(this)">
                    <input type="hidden" name="id" value="<?= $todo->id ?>">
                    <button type="submit">削除</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>完了</h2>
    <ul>
        <?php foreach ($todos_done as $todo): ?>
            <li>
                [〇] <?= htmlspecialchars($todo->title) ?> (<?= $todo->created_at ?>)
                <form action="delete.php" method="post" style="display:inline" onsubmit="return confirmDelete(this)">
                    <input type="hidden" name="id" value="<?= $todo->id ?>">
                    <button type="submit">削除</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>