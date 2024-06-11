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

  <script type="module" src="/public/js/getCookie.js?v=<?= time() ?>"></script>
  <?php if (VALIDATORS_PERM) : ?>
    <script type="module" src="/public/js/validators.js?v=<?= time() ?>"></script>
  <?php endif ?>

  <?php if (TOAST_PERM) : ?>
    <?php include 'app/Views/public/components/Toast.php' ?>
    <script src="/public/js/toast.js?v=<?= time() ?>"></script>
  <?php endif ?>


  <?php if (IMG_LOADER_PERM) : ?>
    <script src="/public/js/imgLoader.js?v=<?= time() ?>"></script>
  <?php endif ?>


  <?php if (SKELETON_PERM) : ?>
    <script src="/public/js/skeleton.js?v=<?= time() ?>"></script>
  <?php endif ?>


  <script src="/public/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>