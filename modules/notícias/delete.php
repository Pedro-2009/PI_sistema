<?php
require_once '../../init.php';
require_once 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php?msg=erro_id");
    exit;
}

$id = intval($_GET['id']);

if (delete_news($id)) {
    header("Location: index.php?msg=deleted");
} else {
    header("Location: index.php?msg=erro_delete");
}
exit;


?>
