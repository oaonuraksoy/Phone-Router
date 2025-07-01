<?php
// Kurulum ekranı ve config.php oluşturucu
if (file_exists('config.php')) {
    // Zaten kuruluysa ana sayfaya yönlendir
    header('Location: index.php');
    exit;
}

$hata = '';
$basarili = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al
    $company_name = trim($_POST['company_name'] ?? '');
    $company_description = trim($_POST['company_description'] ?? '');
    $company_website = trim($_POST['company_website'] ?? '');
    $company_email = trim($_POST['company_email'] ?? '');
    $logo_type = $_POST['logo_type'] ?? 'emoji';
    $logo_emoji = $_POST['logo_emoji'] ?? '📞';
    $logo_image = $_POST['logo_image'] ?? 'assets/images/logo.png';
    $logo_size = $_POST['logo_size'] ?? '60px';
    $primary_color = $_POST['primary_color'] ?? '#e74c3c';
    $secondary_color = $_POST['secondary_color'] ?? '#c0392b';
    $success_color = $_POST['success_color'] ?? '#27ae60';
    $page_title = $_POST['page_title'] ?? $company_name;
    $meta_description = $_POST['meta_description'] ?? '';
    $call_button_text = $_POST['call_button_text'] ?? '📞 Müşteri Hizmetleri';
    $loading_text = $_POST['loading_text'] ?? 'Müşteri hizmetleri aranıyor...';
    $error_invalid_phone = $_POST['error_invalid_phone'] ?? 'Geçersiz telefon numarası. Lütfen doğru bir numara girin.';
    $error_no_phone = $_POST['error_no_phone'] ?? 'Telefon numarası belirtilmedi.';
    $usage_instructions = $_POST['usage_instructions'] ?? 'Müşteri hizmetleri için:';
    $usage_example = $_POST['usage_example'] ?? 'siteadresiniz.com/?tel=4444444';
    $auto_redirect_delay = intval($_POST['auto_redirect_delay'] ?? 2000);
    $show_analytics = isset($_POST['show_analytics']);
    $show_footer = isset($_POST['show_footer']);
    $error_reporting = isset($_POST['error_reporting']);
    $security_headers = isset($_POST['security_headers']);
    $support_text = $_POST['support_text'] ?? 'Geliştirici';
    $support_link = $_POST['support_link'] ?? 'https://onuraksoy.com.tr';
    $support_name = $_POST['support_name'] ?? 'Onur AKSOY';

    // Temel zorunlu alan kontrolü
    if ($company_name === '' || $company_description === '') {
        $hata = 'Lütfen zorunlu alanları doldurun.';
    } else {
        // config.php içeriğini oluştur
        $config_php = "<?php\n";
        $config_php .= "/** Otomatik oluşturulan konfigürasyon **/\n";
        $config_php .= "\$config['company_name'] = '" . addslashes($company_name) . "';\n";
        $config_php .= "\$config['company_description'] = '" . addslashes($company_description) . "';\n";
        $config_php .= "\$config['company_website'] = '" . addslashes($company_website) . "';\n";
        $config_php .= "\$config['company_email'] = '" . addslashes($company_email) . "';\n";
        $config_php .= "\$config['logo_type'] = '" . addslashes($logo_type) . "';\n";
        $config_php .= "\$config['logo_emoji'] = '" . addslashes($logo_emoji) . "';\n";
        $config_php .= "\$config['logo_image'] = '" . addslashes($logo_image) . "';\n";
        $config_php .= "\$config['logo_size'] = '" . addslashes($logo_size) . "';\n";
        $config_php .= "\$config['primary_color'] = '" . addslashes($primary_color) . "';\n";
        $config_php .= "\$config['secondary_color'] = '" . addslashes($secondary_color) . "';\n";
        $config_php .= "\$config['success_color'] = '" . addslashes($success_color) . "';\n";
        $config_php .= "\$config['page_title'] = '" . addslashes($page_title) . "';\n";
        $config_php .= "\$config['meta_description'] = '" . addslashes($meta_description) . "';\n";
        $config_php .= "\$config['call_button_text'] = '" . addslashes($call_button_text) . "';\n";
        $config_php .= "\$config['loading_text'] = '" . addslashes($loading_text) . "';\n";
        $config_php .= "\$config['error_invalid_phone'] = '" . addslashes($error_invalid_phone) . "';\n";
        $config_php .= "\$config['error_no_phone'] = '" . addslashes($error_no_phone) . "';\n";
        $config_php .= "\$config['usage_instructions'] = '" . addslashes($usage_instructions) . "';\n";
        $config_php .= "\$config['usage_example'] = '" . addslashes($usage_example) . "';\n";
        $config_php .= "\$config['auto_redirect_delay'] = $auto_redirect_delay;\n";
        $config_php .= "\$config['show_analytics'] = " . ($show_analytics ? 'true' : 'false') . ";\n";
        $config_php .= "\$config['show_footer'] = " . ($show_footer ? 'true' : 'false') . ";\n";
        $config_php .= "\$config['error_reporting'] = " . ($error_reporting ? 'true' : 'false') . ";\n";
        $config_php .= "\$config['security_headers'] = " . ($security_headers ? 'true' : 'false') . ";\n";
        $config_php .= "\$config['support_text'] = '" . addslashes($support_text) . "';\n";
        $config_php .= "\$config['support_link'] = '" . addslashes($support_link) . "';\n";
        $config_php .= "\$config['support_name'] = '" . addslashes($support_name) . "';\n";
        $config_php .= "?>\n";

        // Dosyayı oluştur
        if (file_put_contents('config.php', $config_php)) {
            $basarili = true;
        } else {
            $hata = 'config.php dosyası oluşturulamadı. Lütfen dosya izinlerini kontrol edin.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kurulum - Phone Router</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { background: #f8f9fa; }
        .setup-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #0001; padding: 32px; }
        .setup-container h2 { margin-bottom: 24px; }
        .setup-container label { font-weight: bold; margin-top: 12px; display: block; }
        .setup-container input, .setup-container select { width: 100%; padding: 8px; margin-top: 4px; margin-bottom: 12px; border-radius: 4px; border: 1px solid #ccc; }
        .setup-container .btn { background: #27ae60; color: #fff; border: none; padding: 12px 24px; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .setup-container .btn:disabled { background: #aaa; }
        .setup-container .error { color: #c0392b; margin-bottom: 12px; }
        .setup-container .success { color: #27ae60; margin-bottom: 12px; }
    </style>
</head>
<body>
<div class="setup-container">
    <h2>Kurulum - Phone Router</h2>
    <?php if ($basarili): ?>
        <div class="success">Kurulum tamamlandı! Ana sayfaya yönlendiriliyorsunuz...</div>
        <script>setTimeout(function(){ window.location = 'index.php'; }, 2000);</script>
    <?php else: ?>
        <?php if ($hata): ?><div class="error"><?php echo htmlspecialchars($hata); ?></div><?php endif; ?>
        <form method="post">
            <label>Firma Adı *</label>
            <input type="text" name="company_name" required>
            <label>Firma Açıklaması *</label>
            <input type="text" name="company_description" required>
            <label>Firma Web Sitesi</label>
            <input type="text" name="company_website">
            <label>Firma Email</label>
            <input type="email" name="company_email">
            <label>Logo Tipi</label>
            <select name="logo_type">
                <option value="emoji">Emoji</option>
                <option value="image">Resim</option>
                <option value="text">Metin</option>
            </select>
            <label>Emoji Logo</label>
            <input type="text" name="logo_emoji" value="📞">
            <label>Resim Logo (yol)</label>
            <input type="text" name="logo_image" value="assets/images/logo.png">
            <label>Logo Boyutu</label>
            <input type="text" name="logo_size" value="60px">
            <label>Ana Renk</label>
            <input type="color" name="primary_color" value="#e74c3c">
            <label>İkincil Renk</label>
            <input type="color" name="secondary_color" value="#c0392b">
            <label>Başarı Rengi</label>
            <input type="color" name="success_color" value="#27ae60">
            <label>Sayfa Başlığı</label>
            <input type="text" name="page_title">
            <label>Meta Açıklama</label>
            <input type="text" name="meta_description">
            <label>Arama Butonu Metni</label>
            <input type="text" name="call_button_text" value="📞 Müşteri Hizmetleri">
            <label>Yükleme Metni</label>
            <input type="text" name="loading_text" value="Müşteri hizmetleri aranıyor...">
            <label>Hatalı Telefon Mesajı</label>
            <input type="text" name="error_invalid_phone" value="Geçersiz telefon numarası. Lütfen doğru bir numara girin.">
            <label>Telefon Eksik Mesajı</label>
            <input type="text" name="error_no_phone" value="Telefon numarası belirtilmedi.">
            <label>Kullanım Talimatı</label>
            <input type="text" name="usage_instructions" value="Müşteri hizmetleri için:">
            <label>Kullanım Örneği</label>
            <input type="text" name="usage_example" value="siteadresiniz.com/?tel=4444444">
            <label>Otomatik Yönlendirme (ms)</label>
            <input type="number" name="auto_redirect_delay" value="2000">
            <label><input type="checkbox" name="show_analytics" checked> Analytics Gösterimi</label>
            <label><input type="checkbox" name="show_footer" checked> Footer Gösterimi</label>
            <label><input type="checkbox" name="error_reporting"> Hata Raporlama (geliştirici için)</label>
            <label><input type="checkbox" name="security_headers" checked> Güvenlik Başlıkları</label>
            <label>Destek Metni</label>
            <input type="text" name="support_text" value="Geliştirici">
            <label>Destek Linki</label>
            <input type="text" name="support_link" value="https://onuraksoy.com.tr">
            <label>Destek Adı</label>
            <input type="text" name="support_name" value="Onur AKSOY">
            <button class="btn" type="submit">Kurulumu Tamamla</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html> 