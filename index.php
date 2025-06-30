<?php
// Load configuration
require_once 'config.php';

// Error reporting based on config
if ($config['error_reporting']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Security headers based on config
if ($config['security_headers']) {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
}

// Include functions
require_once 'includes/functions.php';

// Initialize variables
$phone = '';
$echoTel = '';
$error = '';
$countryCode = '90'; // Default to Turkey
$isValid = false;

// Process GET parameters
if (isset($_GET["tel"])) {
    $inputPhone = $_GET['tel'];
    
    // Get country code from parameter or use default
    if (isset($_GET["country"])) {
        $countryCode = preg_replace("/[^0-9]/", "", $_GET['country']);
        if (empty($countryCode) || !validateCountryCode($countryCode)) {
            $countryCode = '90';
        }
    }
    
    // Validate phone number
    $cleanPhone = validatePhoneNumber($inputPhone, $countryCode);
    
    if ($cleanPhone !== false) {
        $phone = '+' . $countryCode . $cleanPhone;
        $echoTel = formatPhoneNumber($cleanPhone, $countryCode);
        $isValid = true;
        
        // Analytics will be handled by JavaScript to prevent duplicates
    } else {
        $error = $config['error_invalid_phone'];
    }
} else {
    $error = $config['error_no_phone'];
}

// Generate logo HTML based on config
function generateLogo() {
    global $config;
    
    switch ($config['logo_type']) {
        case 'image':
            return '<img src="' . htmlspecialchars($config['logo_image']) . '" alt="' . htmlspecialchars($config['company_name']) . '" style="width: 100%; height: auto;">';
        case 'text':
            return '<span style="font-size: ' . $config['logo_size'] . '; font-weight: bold; color: white;">' . htmlspecialchars($config['company_name']) . '</span>';
        case 'emoji':
        default:
            return '<span style="font-size: ' . $config['logo_size'] . ';">' . $config['logo_emoji'] . '</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  	<title><?php echo htmlspecialchars($config['page_title']); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo htmlspecialchars($config['meta_description']); ?>">
  <link rel="icon"
    href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'><?php echo $config['logo_emoji']; ?></text></svg>">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* Custom colors from config */
    body {
      background: linear-gradient(135deg, <?php echo $config['primary_color']; ?> 0%, <?php echo $config['secondary_color']; ?> 100%);
    }
    .logo {
      background: linear-gradient(45deg, <?php echo $config['primary_color']; ?>, <?php echo $config['secondary_color']; ?>);
    }
    .call-button {
      background: linear-gradient(45deg, <?php echo $config['success_color']; ?>, #20c997);
    }
    .footer a {
      color: <?php echo $config['primary_color']; ?>;
    }
  </style>
</head>

<body>
  <div class="container">
    		<div class="logo"><?php echo generateLogo(); ?></div>
		<h1 style="color: #2c3e50; margin-bottom: 10px;"><?php echo htmlspecialchars($config['company_name']); ?></h1>
		<p style="color: #6c757d; margin-bottom: 30px;"><?php echo htmlspecialchars($config['company_description']); ?></p>

    <?php if ($error): ?>
      <div class="error">
        <strong>⚠️ Hata:</strong> <?php echo sanitizeInput($error); ?>
      </div>
      <div class="info">
        <p><strong>Doğru Kullanım:</strong></p>
        <p>URL: <code>yoursite.com/?tel=5554443322&country=90</code></p>
        <p>Ülke kodları: 90 (Türkiye), 1 (ABD), 44 (İngiltere)</p>
      </div>
    <?php elseif ($isValid): ?>
      <div class="info">
        <p><strong>📱 Telefon Numarası:</strong></p>
        <div class="phone-number"><?php echo sanitizeInput($echoTel); ?></div>
        <p style="font-size: 12px; color: #6c757d; margin-top: 5px;">
          Ülke: <?php echo getCountryName($countryCode); ?>
        </p>
      </div>

      <div class="loading" id="loading">
        <div class="spinner"></div>
        <p><?php echo htmlspecialchars($config['loading_text']); ?></p>
      </div>

      <a href="tel:<?php echo sanitizeInput($phone); ?>" class="call-button" id="telLink" onclick="showLoading()">
        📞 Hemen Ara
      </a>

      <p style="color: #6c757d; font-size: 14px; margin-top: 20px;">
        Otomatik yönlendirme çalışmazsa yukarıdaki butona tıklayın.
      </p>
    <?php else: ?>
      <div class="info">
        <p><strong>🔧 Kullanım:</strong></p>
        <p><?php echo htmlspecialchars($config['usage_instructions']); ?></p>
        <p><code><?php echo htmlspecialchars($config['usage_example']); ?></code></p>
      </div>
    <?php endif; ?>

    <?php if ($config['show_footer']): ?>
    <div class="footer">
      <p><?php echo htmlspecialchars($config['support_text']); ?> <a href="<?php echo htmlspecialchars($config['support_link']); ?>" target="_blank"><?php echo htmlspecialchars($config['support_name']); ?></a></p>
      <?php if ($config['show_analytics']): ?>
      <p style="font-size: 12px; margin-top: 10px;">
        📊 <span id="clickCount">0</span> kez kullanıldı
      </p>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>

  <script>
    function showLoading() {
      document.getElementById('loading').style.display = 'block';
    }

    // Auto-click after configured delay if valid phone number
    <?php if ($isValid): ?>
      setTimeout(function () {
        document.getElementById('telLink').click();
      }, <?php echo $config['auto_redirect_delay']; ?>);
    <?php endif; ?>

    // Update click count from analytics
    function updateClickCount() {
      fetch('api/get_analytics.php')
        .then(response => response.json())
        .then(data => {
          document.getElementById('clickCount').textContent = data.totalClicks || 0;
        })
        .catch(error => console.log('Analytics yüklenemedi'));
    }

    // Update click count on page load
    <?php if ($config['show_analytics']): ?>
      updateClickCount();
    <?php endif; ?>
  </script>
  <script src="assets/js/app.js"></script>
</body>

</html>