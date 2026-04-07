<?php
require_once 'db.php';

$id = (int)($_POST['id'] ?? 0);
$title = $_POST['title'] ?? '';

$title = trim($title);


if ($title === '') {
    header("Location: edit.php?id=$id&error=empty");
    exit;
}

if (mb_strlen($title) > 200) {
    header("Location: index.php?id=$id&error=toolong");
    exit;
}


$todo = ORM::for_table('todos')->find_one($id);

if ($todo) {
    $todo->title = $title;
    $todo->save();
}

header('Location: index.php');
exit;
