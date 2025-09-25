<?php
require __DIR__ . '/db.php';
require __DIR__ . '/helpers.php';

$lista = $pdo->query("SELECT * FROM sobre ORDER BY id DESC")->fetchAll();

?>
<?php include __DIR__ . '/header.php'; ?>

<hr>
<h3>Galeria</h3>
<?php if (!$lista): ?>
  <p>Galeria vazia.</p>
<?php else: ?>
<table border="1" cellpadding="6" cellspacing="0">
  <tr>
    <th>ID</th><th>Foto</th>
  </tr>
  <?php foreach ($lista as $r): ?>
  <tr>
    <td><?= e($r['id']) ?></td>
    <td><?php if ($r['foto_path']): ?><img src="<?= e($r['foto_path']) ?>" width="120"><?php endif; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>