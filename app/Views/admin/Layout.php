<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="/public/css/index.css?v=<?= time() ?>">
  <title>Document</title>
</head>

<body>
<?php include 'app/Views/public/components/Alert.php' ?>

  <?= $params["content"] ?>

  <script src="/public/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>