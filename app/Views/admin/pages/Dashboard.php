<?php $csfr = $params['csfr'] ?? null ?>


<h1>Dashboard</h1>
<form action="/admin/logout" method="POST">
  <?= $csfr->generate() ?>
  <button type="submit">Logout</button>
</form>