<?php
session_start();
if (!isset($_SESSION['logado'])) {
  header('Location: login.php');
  exit;
}
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  echo "ID inválido.";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $telefone = $_POST["telefone"];
  $servico = $_POST["servico"];
  $data = $_POST["data"];
  $hora = $_POST["hora"];

  $sql = "UPDATE agendamentos SET nome=?, telefone=?, servico=?, data_agendamento=?, hora=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi", $nome, $telefone, $servico, $data, $hora, $id);
  $stmt->execute();
  header("Location: listar.php");
  exit;
}

$sql = "SELECT * FROM agendamentos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/><title>Editar Agendamento</title><link rel="stylesheet" href="style.css"/></head>
<body class="font-size-2">
  <header class="header" role="banner"><div class="logo"><div class="mark" aria-hidden="true">Jô</div><div><div style="font-weight:700">Salão Jô</div><small style="color:#7a6a58">Painel</small></div></div><nav role="navigation" aria-label="Menu painel"><a href="listar.php">Voltar</a><a href="logout.php">Sair</a></nav></header>
  <div id="a11y-live" class="sr-only" aria-live="polite" aria-atomic="true"></div>
  <main class="container" role="main">
    <h2>Editar Agendamento</h2>
    <form method="POST" aria-label="Formulário de edição">
      <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required></label>
      <label>Telefone: <input type="text" name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>" required></label>
      <label>Serviço: <input type="text" name="servico" value="<?= htmlspecialchars($dados['servico']) ?>" required></label>
      <label>Data: <input type="date" name="data" value="<?= $dados['data_agendamento'] ?>" required></label>
      <label>Hora: <input type="time" name="hora" value="<?= $dados['hora'] ?>" required></label>
      <button type="submit">Salvar Alterações</button>
    </form>
  </main>
  <script src="script.js" defer></script>
</body>
</html>
<?php $conn->close(); ?>