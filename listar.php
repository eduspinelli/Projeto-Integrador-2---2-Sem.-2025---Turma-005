<?php
session_start();
if (!isset($_SESSION['logado'])) {
  header('Location: login.php');
  exit;
}
require 'db.php';

$sql = "SELECT * FROM agendamentos ORDER BY data_agendamento, hora";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/><title>Agendamentos - Salão Jô</title><link rel="stylesheet" href="style.css"/></head>
<body class="font-size-2">
  <header class="header" role="banner">
    <div class="logo"><div class="mark" aria-hidden="true">Jô</div><div><div style="font-weight:700">Salão Jô</div><small style="color:#7a6a58">Painel</small></div></div>
    <div style="display:flex; align-items:center; gap:0.6rem;">
      <div class="accessibility-tools" role="toolbar" aria-label="Ferramentas de acessibilidade">
        <button id="a11y-decrease" class="tool-btn" aria-label="Diminuir fonte">A−</button>
        <button id="a11y-increase" class="tool-btn" aria-label="Aumentar fonte">A+</button>
        <button id="a11y-contrast" class="tool-btn" aria-pressed="false" aria-label="Alternar alto contraste">Alto Contraste</button>
      </div>
      <nav role="navigation" aria-label="Menu principal"><a href="index.html">Site</a><a href="listar.php" class="cta">Agendamentos</a><a href="logout.php">Sair</a></nav>
    </div>
  </header>

  <div id="a11y-live" class="sr-only" aria-live="polite" aria-atomic="true"></div>

  <main class="container" role="main">
    <h1>Lista de Agendamentos</h1>
    <table role="table" aria-label="Tabela de agendamentos" style="width:100%; border-collapse:collapse; margin-top:1rem;">
      <thead><tr><th>Nome</th><th>Telefone</th><th>Serviço</th><th>Data</th><th>Hora</th><th>Ações</th></tr></thead>
      <tbody>
<?php if ($result->num_rows > 0): ?>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['nome']) ?></td>
      <td><?= htmlspecialchars($row['telefone']) ?></td>
      <td><?= htmlspecialchars($row['servico']) ?></td>
      <td><?= $row['data_agendamento'] ?></td>
      <td><?= $row['hora'] ?></td>
      <td><a href="editar.php?id=<?= $row['id'] ?>">Editar</a> | <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="6">Nenhum agendamento encontrado.</td></tr>
<?php endif; ?>
      </tbody>
    </table>
  </main>
  <script src="script.js" defer></script>
</body>
</html>
<?php $conn->close(); ?>