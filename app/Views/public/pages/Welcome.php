<?php
$lang = $_COOKIE['lang'] ?? null;
?>
<div class="container-fluid vh-100">
  <div class="row h-100">
    <div class="col-12 d-flex align-items-center justify-content-center flex-column h-100">
      <h1 class="pr-font"><?= WELCOME['title'][$lang] ?? 'Error' ?></h1>
    </div>
  </div>
</div>