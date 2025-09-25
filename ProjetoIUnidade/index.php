<?php require __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h1>Home</h1>
<h2>Últimos registros</h2>
<?php
$about = $pdo->query("SELECT * FROM sobre ORDER BY id DESC LIMIT 1")->fetch();
if ($about):
?>
  <h3><?= e($about['titulo']) ?></h3>
  <p><?= nl2br(e($about['descricao'])) ?></p>
  <?php if ($about['foto_path']): ?>
    <p><img src="<?= e($about['foto_path']) ?>" alt="Foto da empresa" width="300"></p>
  <?php endif; ?>
<?php else: ?>
  <p>Ainda não há conteúdo em “Sobre”.</p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
