<!-- Formulário de Login -->
  <form action="paginas/validacao.php" method="post">
  <fieldset>
  <legend>Dados de Login</legend>
      <label for="txUsuario">Usuário</label>
      <input type="text" name="usuario" id="txUsuario" maxlength="25" />
      <label for="txSenha">Senha</label>
      <input type="password" name="senha" id="txSenha" />
      <input type="hidden" name="fonte" value="login">
      
      <input type="submit" value="Entrar" />
  </fieldset>
  
  </form>

  <a href="paginas/cadastro.php">Cadastrar</a>