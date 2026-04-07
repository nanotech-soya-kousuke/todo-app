<?php
require_once 'db.php';

$id = (int)($_POST['id'] ?? 0);
$todo = ORM::for_table('todos')->find_one($id);
$title = $_POST['title'] ?? '';

$title = trim($title);

if ($title === '') {
    header('Location: index.php?error=empty');
    exit;
}

if (mb_strlen($title) > 200) {
    header('Location: index.php?error=toolong');
    exit;
}

if($todo){
    $todo->title = $title;
    $todo->save();
}

header('Location: index.php');
exit;