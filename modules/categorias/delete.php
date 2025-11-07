<?php
require_once('../../init.php');
require_once('functions.php');
session_start();

requireRole(['admin', 'funcionario']);

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

deleteCategoria($_GET['id']);
