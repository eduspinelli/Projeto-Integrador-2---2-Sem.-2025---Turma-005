<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$nome = $conn->real_escape_string($data['nome']);
$telefone = $conn->real_escape_string($data['telefone']);
$servico = $conn->real_escape_string($data['servico']);
$data_agendamento = $conn->real_escape_string($data['data']);
$hora = $conn->real_escape_string($data['hora']);

$sql = "INSERT INTO agendamentos (nome, telefone, servico, data_agendamento, hora)
        VALUES ('$nome', '$telefone', '$servico', '$data_agendamento', '$hora')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["sucesso" => true]);
} else {
  echo json_encode(["sucesso" => false, "erro" => $conn->error]);
}

$conn->close();
?>
