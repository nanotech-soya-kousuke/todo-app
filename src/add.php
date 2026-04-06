<?php
require_once 'db.php';

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

$todo = ORM::for_table('todos')->create();
$todo->title = $title;

$todo->save();


header('Location: index.php');
exit;
