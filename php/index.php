<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Bem-vindo</title>
</head>
<body>
  <h1>Bem-vindo!</h1>

  <p>Esta página está sendo executada no host: 
    <strong><?php echo gethostname(); ?></strong>
  </p>

  <p>
    Conexão com o banco: 
    <strong>
      <?php
      $host = 'mysql';
      $user = 'root';
      $pass = 'root';
      $db   = 'meu_db';

      try {
          $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->query("SELECT NOW()");
          $data = $stmt->fetchColumn();
          echo "Conectado ao banco '$db' com sucesso! Hora atual do banco: $data";
      } catch (PDOException $e) {
          echo "Erro ao conectar: " . $e->getMessage();
      }
      ?>
    </strong>
  </p>
</body>
</html>
