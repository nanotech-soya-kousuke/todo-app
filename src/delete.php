<?php
require_once 'db.php';

$id = (int)($_POST['id'] ?? 0);
$todo = ORM::for_table('todos')->find_one($id);
if ($todo) {
    $todo->delete();
}

header('Location: index.php');
exit;
