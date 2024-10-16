<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="/public/css/index.css?v=<?= time() ?>">
  <script src="/public/node_modules/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title><?= htmlspecialchars(APP_NAME); ?> <?= isset($title) ? '- ' . $title : '' ?></title>


  <?= isset($meta_tags['description']) ? '<meta name="description" content="' . htmlspecialchars($meta_tags['description']) . '">' : ''; ?>
  <?= isset($meta_tags['keywords']) ? '<meta name="keywords" content="' . htmlspecialchars($meta_tags['keywords']) . '">' : ''; ?>
  <?= isset($meta_tags['robots']) ? '<meta name="robots" content="' . htmlspecialchars($meta_tags['robots']) . '">' : ''; ?>
  <?= isset($meta_tags['og:title']) ? '<meta property="og:title" content="' . htmlspecialchars($meta_tags['og:title']) . '">' : ''; ?>
  <?= isset($meta_tags['og:description']) ? '<meta property="og:description" content="' . htmlspecialchars($meta_tags['og:description']) . '">' : ''; ?>
  <?= isset($meta_tags['og:image']) ? '<meta property="og:image" content="' . htmlspecialchars($meta_tags['og:image']) . '">' : ''; ?>
  <?= isset($meta_tags['og:url']) ? '<meta property="og:url" content="' . htmlspecialchars($meta_tags['og:url']) . '">' : ''; ?>
  <?= isset($meta_tags['twitter:card']) ? '<meta name="twitter:card" content="' . htmlspecialchars($meta_tags['twitter:card']) . '">' : ''; ?>
  <?= isset($meta_tags['twitter:title']) ? '<meta name="twitter:title" content="' . htmlspecialchars($meta_tags['twitter:title']) . '">' : ''; ?>
  <?= isset($meta_tags['twitter:description']) ? '<meta name="twitter:description" content="' . htmlspecialchars($meta_tags['twitter:description']) . '">' : ''; ?>
  <?= isset($meta_tags['twitter:image']) ? '<meta name="twitter:image" content="' . htmlspecialchars($meta_tags['twitter:image']) . '">' : ''; ?>
  <?= isset($meta_tags['canonical']) ? '<link rel="canonical" href="' . htmlspecialchars($meta_tags['canonical']) . '">' : ''; ?>
  <?= isset($meta_tags['hreflang_hu']) ? '<link rel="alternate" hreflang="hu" href="' . htmlspecialchars($meta_tags['hreflang_hu']) . '">' : ''; ?>
  <?= isset($meta_tags['hreflang_en']) ? '<link rel="alternate" hreflang="en" href="' . htmlspecialchars($meta_tags['hreflang_en']) . '">' : ''; ?>
</head>

<body class="bg-gray-50 dark-bg-gray-900 transition-ease-in-out-300">
  <?php include 'app/Views/public/components/Navbar.php' ?>
  <?php include 'app/Views/public/components/Alert.php' ?>
  <?php if (FEEDBACK_PERM) : ?><?php include 'app/Views/public/components/RatingModal.php' ?><?php endif ?>
  <?php if (TOAST_PERM) : ?><?php include 'app/Views/public/components/Toast.php' ?><?php endif ?>
  <?php if (COOKIE_MODAL_PERM) : ?>
    <?php include 'app/Views/public/components/Cookie.php' ?>
    <script type="module" src="/public/js/cookie.js?v=<?= time() ?>"></script>
  <?php endif ?>

  <?= $content ?>

  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="/public/bootstrap/js/bootstrap.bundle.js"></script>
  <?php if (VALIDATORS_PERM) : ?><script type="module" src="/public/js/validators.js?v=<?= time() ?>"></script><?php endif ?>
  <?php if (TOAST_PERM) : ?><script src="/public/js/toast.js?v=<?= time() ?>"></script><?php endif ?>
  <?php if (FEEDBACK_PERM) : ?><script type="module" src="/public/js/ratingModal.js?v=<?= time() ?>"></script><?php endif ?>
  <?php if (IMG_LOADER_PERM) : ?><script src="/public/js/imgLoader.js?v=<?= time() ?>"></script><?php endif ?>
  <script type="module" src="/public/js/uuid.js?v=<?= time() ?>"></script>
  <script type="module" src="/public/js/getCookie.js?v=<?= time() ?>"></script>
  <script src="/public/js/colorTheme.js?v=<?= time() ?>"></script>

  <?php if (SKELETON_PERM) : ?>
    <?php include 'app/Views/templates/skeletons/card.skeleton.php' ?>
    <script src="/public/js/skeleton.js?v=<?= time() ?>"></script>
  <?php endif ?>




</body>

</html>