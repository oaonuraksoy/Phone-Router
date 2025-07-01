[🇹🇷 Türkçe Dokümantasyon](README.md)

# Phone Router v2.0.1 - Instagram Phone Link

A professional solution for sharing phone numbers on Instagram stories and social media. Your customers can call you directly with a single click.

## ✨ New Features (v2.0.1)

- 🛠️ **Setup Screen**: If config.php does not exist on first setup, a setup screen will open automatically and config.php will be created with the entered information.
- 🔒 **Security Improvements**: XSS protection, security headers
- 🌍 **Multi-Country Support**: Turkey, USA, UK, and other countries
- 📊 **Analytics System**: Click statistics and detailed reports
- 🎨 **Modern UI/UX**: Responsive design and animations
- ⚡ **Performance Optimization**: Fast loading and smooth experience
- 📱 **Mobile Optimization**: Touch feedback and mobile compatibility
- ⌨️ **Keyboard Shortcuts**: Quick call with Space/Enter
- 🔄 **Error Handling**: User-friendly error messages
- 📁 **Organized Folder Structure**: Professional file organization
- 🎯 **Easy Customization**: Quick branding with configuration file

## 🚀 Installation

1. Upload all files to your web server.
2. On first visit, the setup screen will open automatically (if config.php does not exist).
3. Fill out the setup form and config.php will be created automatically.
4. Check file permissions:
   - `data/` folder must be writable (755)
   - `includes/` folder must be readable (644)
5. Test in your browser.

## 🎨 Customization

After setup, you can edit the config.php file to change all settings. You can also use `config-example.php` as a reference.

### Quick Setup
1. Copy `config-example.php` to `config.php`
2. Edit `config.php`
3. Enter your company information

### Customizable Fields

#### 📝 Company Information
```php
$config['company_name'] = 'ABC Company';
$config['company_description'] = 'Customer Service Phone Link';
$config['company_website'] = 'https://abc-company.com';
```

#### 🖼️ Logo Options
```php
// Emoji Logo
$config['logo_type'] = 'emoji';
$config['logo_emoji'] = '🏢';

// Image Logo
$config['logo_type'] = 'image';
$config['logo_image'] = 'assets/images/logo.png';

// Text Logo
$config['logo_type'] = 'text';
```

#### 🎨 Color Theme
```php
$config['primary_color'] = '#e74c3c';    // Primary color
$config['secondary_color'] = '#c0392b';  // Secondary color
$config['success_color'] = '#27ae60';    // Success color
```

#### ⚙️ Technical Settings
```php
$config['auto_redirect_delay'] = 2000;   // Auto redirect delay
$config['show_analytics'] = true;        // Show analytics
$config['show_footer'] = true;           // Show footer
```

## 📖 Usage

### Basic Usage
```
https://yoursite.com/?tel=5554443322
```

### Usage with Country Code
```
https://yoursite.com/?tel=5554443322&country=90
```

### Supported Country Codes
- `90` - Turkey (default)
- `1` - USA/Canada
- `44` - United Kingdom
- `49` - Germany
- `33` - France
- `39` - Italy
- `34` - Spain
- `31` - Netherlands
- `32` - Belgium
- `46` - Sweden
- `47` - Norway
- `45` - Denmark
- `358` - Finland
- `48` - Poland
- `420` - Czech Republic
- `36` - Hungary
- `40` - Romania
- `359` - Bulgaria
- `30` - Greece
- `351` - Portugal

## 📊 Analytics

The application automatically collects the following data:
- Total click count
- Daily click count
- IP addresses
- Browser information
- Timestamps

### Analytics API
- `GET /api/get_analytics.php` - Returns statistics in JSON format
- `POST /api/track_click.php` - Records new clicks

## 🔧 Technical Details

### 📁 Folder Structure
```
Phone-Router/
├── index.php              # Main application
├── config.php             # Configuration file
├── config-example.php     # Example configuration
├── .htaccess              # Apache configuration
├── README.md              # Documentation (Turkish)
├── README_EN.md           # Documentation (English)
├── assets/                # Static files
│   ├── css/
│   │   └── style.css      # Stylesheet
│   ├── js/
│   │   └── app.js         # JavaScript file
│   └── images/            # Image files
├── api/                   # API files
│   ├── get_analytics.php  # Analytics API
│   └── track_click.php    # Click tracking API
├── includes/              # PHP functions
│   └── functions.php      # Helper functions
└── data/                  # Data files
    └── analytics.txt      # Analytics data (auto-generated)
```

### 🔒 Security Features
- XSS protection
- CSRF protection
- Input validation
- Security headers
- File locking
- Folder protection (.htaccess)
- Sensitive file protection

### ⚡ Performance Features
- Lazy loading
- Optimized CSS/JS
- Service Worker support
- Touch feedback
- Keyboard shortcuts
- Gzip compression
- Browser caching

## 🎯 Tested Platforms

- ✅ iOS Safari
- ✅ Android Chrome
- ✅ Android Firefox
- ✅ Windows Chrome
- ✅ Windows Firefox
- ✅ macOS Safari
- ❌ Windows Phone (not supported)

## 🔄 Changelog

#### v2.0.1 (Latest)
- Setup screen added. If config.php does not exist, automatic setup starts.
- Minor bug fixes and improvements.

#### v2.0
- Multi-country support added
- Analytics system added
- Modern UI design
- Security improvements
- Improved error handling
- Organized folder structure
- Advanced security (.htaccess)
- 20+ country code support
- Easy customization system

#### v1.0
- Basic phone routing
- Simple interface

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License.

## 👨‍💻 Developer

**Onur AKSOY**
- Website: [onuraksoy.com.tr](https://onuraksoy.com.tr)
- Email: info@onuraksoy.com.tr

## 🆘 Support

If you have any issues:
1. Report an issue on GitHub
2. Contact via email
3. Check the documentation

## 🔧 Developer Notes

### File Permissions
```bash
chmod 755 data/
chmod 644 includes/
chmod 644 assets/css/
chmod 644 assets/js/
```

### Security Checklist
- [ ] .htaccess file uploaded
- [ ] data/ folder is writable
- [ ] includes/ folder is protected
- [ ] API files are accessible
- [ ] Analytics is working
- [ ] config.php is edited

### Customization Checklist
- [ ] Company name changed
- [ ] Logo added/changed
- [ ] Colors customized
- [ ] Texts updated
- [ ] Analytics settings configured

---

⭐ If you like this project, don't forget to give it a star! 