<?php
/**
 * Phone Router - Örnek Konfigürasyon
 * Bu dosyayı config.php olarak kopyalayıp düzenleyin.
 */

// ========================================
// FİRMA BİLGİLERİ
// ========================================

// Firma Adı
$config['company_name'] = 'ABC Şirketi';

// Firma Açıklaması
$config['company_description'] = 'Müşteri Hizmetleri Telefon Bağlantısı';

// Firma Web Sitesi
$config['company_website'] = 'https://abc-sirketi.com';

// Firma Email
$config['company_email'] = 'info@abc-sirketi.com';

// ========================================
// LOGO VE GÖRSEL AYARLARI
// ========================================

// Logo Tipi: 'emoji', 'image', 'text'
$config['logo_type'] = 'image';

// Emoji Logo (logo_type = 'emoji' ise)
$config['logo_emoji'] = '🏢';

// Resim Logo (logo_type = 'image' ise)
$config['logo_image'] = 'assets/images/abc-logo.png';

// Logo Boyutu (sadece emoji için)
$config['logo_size'] = '60px';

// ========================================
// RENK AYARLARI
// ========================================

// Ana Renk (CSS hex kodu)
$config['primary_color'] = '#e74c3c';

// İkincil Renk
$config['secondary_color'] = '#c0392b';

// Başarı Rengi (butonlar için)
$config['success_color'] = '#27ae60';

// ========================================
// METİN AYARLARI
// ========================================

// Sayfa Başlığı
$config['page_title'] = 'ABC Şirketi - Müşteri Hizmetleri';

// Meta Açıklama
$config['meta_description'] = 'ABC Şirketi müşteri hizmetlerine hızlı erişim';

// Arama Butonu Metni
$config['call_button_text'] = '📞 Müşteri Hizmetleri';

// Yükleme Metni
$config['loading_text'] = 'Müşteri hizmetleri aranıyor...';

// Hata Mesajları
$config['error_invalid_phone'] = 'Geçersiz telefon numarası. Lütfen doğru bir numara girin.';
$config['error_no_phone'] = 'Telefon numarası belirtilmedi.';

// Kullanım Talimatları
$config['usage_instructions'] = 'Müşteri hizmetleri için:';
$config['usage_example'] = 'abc-sirketi.com/?tel=4444444';

// ========================================
// TEKNİK AYARLAR
// ========================================

// Otomatik Yönlendirme Süresi (milisaniye)
$config['auto_redirect_delay'] = 2000;

// Analytics Gösterimi
$config['show_analytics'] = true;

// Footer Gösterimi
$config['show_footer'] = true;

// ========================================
// GÜVENLİK AYARLARI
// ========================================

// Hata Raporlama (production'da false yapın)
$config['error_reporting'] = false;

// Güvenlik Başlıkları
$config['security_headers'] = true;

// ========================================
// DESTEK
// ========================================

// Destek Metni
$config['support_text'] = 'Geliştirici';

// Destek Linki
$config['support_link'] = 'https://onuraksoy.com.tr';

// Destek Adı
$config['support_name'] = 'Onur AKSOY';

?> 