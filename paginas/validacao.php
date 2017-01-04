<?php

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
  header("Location: ../index.php"); exit;
}

  // Tenta se conectar ao servidor MySQL
$conection = mysqli_connect('localhost', 'root', '', 'labautenticacao') or trigger_error(mysql_error());

$usuario = mysqli_real_escape_string($conection, $_POST['usuario']);
$senha = mysqli_real_escape_string($conection, $_POST['senha']);

  // Validação do usuário/senha digitados
$sql = "SELECT `id`, `nome`, `nivel` FROM `usuarios` WHERE (`usuario` = '".$usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
$query = mysqli_query($conection, $sql);
if (mysqli_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
  echo "Login inválido!";

} else {
      // Salva os dados encontados na variável $resultado
  $resultado = mysqli_fetch_assoc($query);

      // Se a sessão não existir, inicia uma
  if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
  $_SESSION['UsuarioID'] = $resultado['id'];
  $_SESSION['UsuarioNome'] = $resultado['nome'];
  $_SESSION['UsuarioNivel'] = $resultado['nivel'];

  if($resultado['nivel'] == 2){
        // Redireciona o visitante para página restrita
    header("Location: restrito.php"); exit;
  }elseif ($resultado['nivel'] == 1) {
        // Redireciona o visitante para página normal
    header("Location: normal.php"); exit;
  }else{
    header("Location: logout.php"); exit;
  }
}

?>