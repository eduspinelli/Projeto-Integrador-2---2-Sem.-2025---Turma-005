<?php
session_start();

$usuario_padrao = 'admin';
$senha_padrao = '1234'; // Troque depois

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  if ($usuario === $usuario_padrao && $senha === $senha_padrao) {
    $_SESSION['logado'] = true;
    header('Location: listar.php');
    exit;
  } else {
    $erro = "Usuário ou senha inválidos.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/><title>Login - Salão Jô</title><link rel="stylesheet" href="style.css"/></head>
<body class="font-size-2">
  <header class="header" role="banner">
    <div class="logo"><div class="mark" aria-hidden="true">Jô</div><div><div style="font-weight:700">Salão Jô</div><small style="color:#7a6a58">Beleza com carinho</small></div></div>
    <div style="display:flex; align-items:center; gap:0.6rem;">
      <div class="accessibility-tools" role="toolbar" aria-label="Ferramentas de acessibilidade">
        <button id="a11y-decrease" class="tool-btn" aria-label="Diminuir fonte">A−</button>
        <button id="a11y-increase" class="tool-btn" aria-label="Aumentar fonte">A+</button>
        <button id="a11y-contrast" class="tool-btn" aria-pressed="false" aria-label="Alternar alto contraste">Alto Contraste</button>
      </div>
      <nav role="navigation" aria-label="Menu principal"><a href="index.html">Site</a><a href="agendar.html">Agendamento</a><a href="login.php">Login</a></nav>
    </div>
  </header>

  <div id="a11y-live" class="sr-only" aria-live="polite" aria-atomic="true"></div>

  <main class="container" role="main">
    <h2>Login do Salão</h2>
    <?php if (!empty($erro)) echo "<p class='erro' role='alert'>".htmlspecialchars($erro)."</p>"; ?>
    <form method="POST" aria-label="Formulário de login">
      <input type="text" name="usuario" placeholder="Usuário" required aria-required="true"/>
      <input type="password" name="senha" placeholder="Senha" required aria-required="true"/>
      <button type="submit">Entrar</button>
    </form>
  </main>
  <script src="script.js" defer></script>
</body>
</html>