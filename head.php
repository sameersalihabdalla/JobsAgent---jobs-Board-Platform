<?php
$settings = $conn->query("SELECT * FROM settings WHERE id = 1")->fetch_assoc();
$current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<title><?= htmlspecialchars($settings['site_name']) ?></title>
<meta name="description" content="<?= htmlspecialchars($settings['site_description']) ?>">
<meta name="keywords" content="<?= htmlspecialchars($settings['meta_keywords']) ?>">
<link rel="canonical" href="<?= !empty($settings['canonical_url']) ? $settings['canonical_url'] : $current_url ?>">

<!-- OG Meta Tags -->
<meta property="og:title" content="<?= htmlspecialchars($settings['site_name']) ?>">
<meta property="og:description" content="<?= htmlspecialchars($settings['og_description']) ?>">
<meta property="og:image" content="<?= htmlspecialchars($settings['logo_url']) ?>">
<meta property="og:url" content="<?= $current_url ?>">
<meta name="twitter:card" content="summary_large_image">

<!-- Favicon -->
<?php if (!empty($settings['favicon_url'])): ?>
<link rel="icon" href="<?= htmlspecialchars($settings['favicon_url']) ?>" type="image/png">
<?php endif; ?>