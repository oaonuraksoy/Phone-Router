# Phone Router v2.0 - Instagram Telefon Bağlantısı

Instagram hikayelerinde ve sosyal medyada telefon numarası paylaşımı için profesyonel çözüm. Müşterileriniz tek tıkla direkt arama yapabilir.

## ✨ Yeni Özellikler (v2.0)

- 🔒 **Güvenlik Geliştirmeleri**: XSS koruması, güvenlik başlıkları
- 🌍 **Çoklu Ülke Desteği**: Türkiye, ABD, İngiltere ve diğer ülkeler
- 📊 **Analytics Sistemi**: Tıklama istatistikleri ve detaylı raporlar
- 🎨 **Modern UI/UX**: Responsive tasarım ve animasyonlar
- ⚡ **Performans Optimizasyonu**: Hızlı yükleme ve akıcı deneyim
- 📱 **Mobil Optimizasyon**: Touch feedback ve mobil uyumluluk
- ⌨️ **Klavye Kısayolları**: Space/Enter ile hızlı arama
- 🔄 **Hata Yönetimi**: Kullanıcı dostu hata mesajları
- 📁 **Organize Klasör Yapısı**: Profesyonel dosya organizasyonu
- 🎯 **Kolay Özelleştirme**: Konfigürasyon dosyası ile hızlı branding

## 🚀 Kurulum

1. Tüm dosyaları web sunucunuza yükleyin
2. `config.php` dosyasını düzenleyerek kendi firma bilgilerinizi girin
3. Dosya izinlerini kontrol edin:
   - `data/` klasörü yazılabilir olmalı (755)
   - `includes/` klasörü okunabilir olmalı (644)
4. Tarayıcınızda test edin

## 🎨 Özelleştirme

### Hızlı Kurulum
1. `config-example.php` dosyasını `config.php` olarak kopyalayın
2. `config.php` dosyasını düzenleyin
3. Kendi firma bilgilerinizi girin

### Özelleştirilebilir Alanlar

#### 📝 Firma Bilgileri
```php
$config['company_name'] = 'ABC Şirketi';
$config['company_description'] = 'Müşteri Hizmetleri Telefon Bağlantısı';
$config['company_website'] = 'https://abc-sirketi.com';
```

#### 🖼️ Logo Seçenekleri
```php
// Emoji Logo
$config['logo_type'] = 'emoji';
$config['logo_emoji'] = '🏢';

// Resim Logo
$config['logo_type'] = 'image';
$config['logo_image'] = 'assets/images/logo.png';

// Metin Logo
$config['logo_type'] = 'text';
```

#### 🎨 Renk Teması
```php
$config['primary_color'] = '#e74c3c';    // Ana renk
$config['secondary_color'] = '#c0392b';  // İkincil renk
$config['success_color'] = '#27ae60';    // Başarı rengi
```

#### ⚙️ Teknik Ayarlar
```php
$config['auto_redirect_delay'] = 2000;   // Otomatik yönlendirme süresi
$config['show_analytics'] = true;        // Analytics gösterimi
$config['show_footer'] = true;           // Footer gösterimi
```

## 📖 Kullanım

### Temel Kullanım
```
https://yoursite.com/?tel=5554443322
```

### Ülke Kodu ile Kullanım
```
https://yoursite.com/?tel=5554443322&country=90
```

### Desteklenen Ülke Kodları
- `90` - Türkiye (varsayılan)
- `1` - ABD/Kanada
- `44` - İngiltere
- `49` - Almanya
- `33` - Fransa
- `39` - İtalya
- `34` - İspanya
- `31` - Hollanda
- `32` - Belçika
- `46` - İsveç
- `47` - Norveç
- `45` - Danimarka
- `358` - Finlandiya
- `48` - Polonya
- `420` - Çek Cumhuriyeti
- `36` - Macaristan
- `40` - Romanya
- `359` - Bulgaristan
- `30` - Yunanistan
- `351` - Portekiz

## 📊 Analytics

Uygulama otomatik olarak şu verileri toplar:
- Toplam tıklama sayısı
- Günlük tıklama sayısı
- IP adresleri
- Tarayıcı bilgileri
- Zaman damgaları

### Analytics API
- `GET /api/get_analytics.php` - İstatistikleri JSON formatında döner
- `POST /api/track_click.php` - Yeni tıklamaları kaydeder

## 🔧 Teknik Detaylar

### 📁 Klasör Yapısı
```
Phone-Router/
├── index.php              # Ana uygulama
├── config.php             # Konfigürasyon dosyası
├── config-example.php     # Örnek konfigürasyon
├── .htaccess              # Apache konfigürasyonu
├── README.md              # Dokümantasyon
├── assets/                # Statik dosyalar
│   ├── css/
│   │   └── style.css      # Stil dosyası
│   ├── js/
│   │   └── app.js         # JavaScript dosyası
│   └── images/            # Resim dosyaları
├── api/                   # API dosyaları
│   ├── get_analytics.php  # Analytics API
│   └── track_click.php    # Click tracking API
├── includes/              # PHP fonksiyonları
│   └── functions.php      # Yardımcı fonksiyonlar
└── data/                  # Veri dosyaları
    └── analytics.txt      # Analytics verileri (otomatik oluşur)
```

### 🔒 Güvenlik Özellikleri
- XSS koruması
- CSRF koruması
- Input validation
- Güvenlik başlıkları
- File locking
- Klasör koruması (.htaccess)
- Sensitive dosya koruması

### ⚡ Performans Özellikleri
- Lazy loading
- Optimized CSS/JS
- Service Worker desteği
- Touch feedback
- Keyboard shortcuts
- Gzip sıkıştırma
- Browser caching

## 🎯 Test Edilen Platformlar

- ✅ iOS Safari
- ✅ Android Chrome
- ✅ Android Firefox
- ✅ Windows Chrome
- ✅ Windows Firefox
- ✅ macOS Safari
- ❌ Windows Phone (desteklenmiyor)

## 🔄 Güncelleme Geçmişi

### v2.0 (Güncel)
- Çoklu ülke desteği eklendi
- Analytics sistemi eklendi
- Modern UI tasarımı
- Güvenlik geliştirmeleri
- Hata yönetimi iyileştirildi
- **Organize klasör yapısı**
- **Gelişmiş güvenlik (.htaccess)**
- **20+ ülke kodu desteği**
- **🎨 Kolay özelleştirme sistemi**

### v1.0
- Temel telefon yönlendirme
- Basit arayüz

## 🤝 Katkıda Bulunma

1. Fork yapın
2. Feature branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Commit yapın (`git commit -m 'Add amazing feature'`)
4. Push yapın (`git push origin feature/amazing-feature`)
5. Pull Request açın

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

## 👨‍💻 Geliştirici

**Onur AKSOY**
- Website: [onuraksoy.com.tr](https://onuraksoy.com.tr)
- Email: info@onuraksoy.com.tr

## 🆘 Destek

Herhangi bir sorun yaşarsanız:
1. GitHub Issues'da sorun bildirin
2. Email ile iletişime geçin
3. Dokümantasyonu kontrol edin

## 🔧 Geliştirici Notları

### Dosya İzinleri
```bash
chmod 755 data/
chmod 644 includes/
chmod 644 assets/css/
chmod 644 assets/js/
```

### Güvenlik Kontrol Listesi
- [ ] .htaccess dosyası yüklendi
- [ ] data/ klasörü yazılabilir
- [ ] includes/ klasörü korunuyor
- [ ] API dosyaları erişilebilir
- [ ] Analytics çalışıyor
- [ ] config.php düzenlendi

### Özelleştirme Kontrol Listesi
- [ ] Firma adı değiştirildi
- [ ] Logo eklendi/değiştirildi
- [ ] Renkler özelleştirildi
- [ ] Metinler güncellendi
- [ ] Analytics ayarları yapıldı

---

⭐ Bu projeyi beğendiyseniz yıldız vermeyi unutmayın!