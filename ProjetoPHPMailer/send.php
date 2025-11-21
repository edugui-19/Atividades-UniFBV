<?php
declare(strict_types=1);
# - - - - - BANCO DE DADOS
$DB_HOST = 'localhost';
$DB_NAME = 'loja_db';
$DB_USER = 'root';
$DB_PASS = '';

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
  exit('Erro ao conectar: ' . htmlspecialchars($e->getMessage()));
}

# - - - - - - ENVIO DE EMAIL
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

$GMAIL_USERNAME = 'email@gmail.com';
$GMAIL_APP_PASS = 'xxxx xxxx xxxx xxxx';


$email = trim($_POST['email'] ?? '');
$produtoId = (int)($_POST['produto'] ?? 0);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("E-mail inválido.");
}

if ($produtoId <= 0) {
    exit("Produto inválido.");
}

$sql = "SELECT nome, descricao, preco FROM produtos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$produtoId]);
$produto = $stmt->fetch();

if (!$produto) {
    exit("Produto não encontrado.");
}

$mail = new PHPMailer(true);

try {

  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = $GMAIL_USERNAME;
  $mail->Password   = $GMAIL_APP_PASS;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  $mail->setFrom($GMAIL_USERNAME, 'Informações da Loja');

  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = 'Informações do Produto';

  $mail->Body = "
    <h2>Informações do Produto</h2>
    <p><strong>Nome:</strong> {$produto['nome']}</p>
    <p><strong>Descrição:</strong> {$produto['descricao']}</p>
    <p><strong>Preço:</strong> R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
    <hr>
    <p>Enviado do IP: " . htmlspecialchars($_SERVER['REMOTE_ADDR']) . "</p>
  ";

  $mail->AltBody =
    "Informações do Produto\n" .
    "Nome: {$produto['nome']}\n" .
    "Descrição: {$produto['descricao']}\n" .
    "Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n" .
    "IP: " . $_SERVER['REMOTE_ADDR'];

  $mail->send();

  echo '<p class="ok">Mensagem enviada com sucesso! Verifique sua caixa de entrada.</p>';

} catch (Exception $e) {
  http_response_code(500);
  echo '<p class="err">Erro ao enviar: ' .
       htmlspecialchars($mail->ErrorInfo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') .
       '</p>';
}
