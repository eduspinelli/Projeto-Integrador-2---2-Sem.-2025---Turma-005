<?php
session_start();
if (!isset($_SESSION['logado'])) {
  header('Location: login.php');
  exit;
}
require 'db.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $stmt = $conn->prepare("DELETE FROM agendamentos WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

header("Location: listar.php");
exit;
?>