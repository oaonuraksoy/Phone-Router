// Enhanced Phone Router JavaScript

// Analytics tracking flag to prevent duplicates
let analyticsTracked = false;

// Get config values from PHP (will be replaced by PHP)
const config = {
    company_name: 'Phone Router',
    support_name: 'Onur AKSOY',
    support_link: 'https://onuraksoy.com.tr',
    show_analytics: true
};

// Create footer with analytics
let myDiv = document.createElement('div');
myDiv.innerHTML = '<div class="footer" style="position: fixed;bottom: 0;left: 0;right: 0;background: rgba(255,255,255,0.9);padding: 10px;text-align: center;font-size: 12px;color: #6c757d;border-top: 1px solid #e9ecef;z-index: 1000;"><marquee behavior="" direction="">Powered by <a href="' + config.support_link + '" target="_blank" style="color:#667eea;text-decoration:none; font-weight: 700;">' + config.support_name + '</a>' + (config.show_analytics ? ' | 📊 <span id="footerClickCount">0</span> kez kullanıldı' : '') + '</marquee></div>';
document.body.appendChild(myDiv);

// Enhanced error handling and monitoring
setInterval(function() {
    if (!document.body.contains(myDiv)) {
        console.log('Footer element lost, reloading page...');
        window.location.reload();
    }
}, 2000);

// Auto-click functionality with better timing
function autoClickPhone() {
    const telLink = document.getElementById('telLink');
    if (telLink) {
        // Show loading state
        const loading = document.getElementById('loading');
        if (loading) {
            loading.style.display = 'block';
        }
        
        // Auto-click after configured delay
        setTimeout(function() {
            try {
                telLink.click();
                console.log('Auto-click executed successfully');
            } catch (error) {
                console.log('Auto-click failed:', error);
            }
        }, 3000); // This will be overridden by PHP config
    }
}

// Enhanced analytics update function
function updateClickCount() {
    if (!config.show_analytics) return;
    
    fetch('api/get_analytics.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const clickCountElements = document.querySelectorAll('#clickCount, #footerClickCount');
            clickCountElements.forEach(element => {
                element.textContent = data.totalClicks || 0;
            });
            
            // Update today's clicks if element exists
            const todayElement = document.getElementById('todayClicks');
            if (todayElement) {
                todayElement.textContent = data.todayClicks || 0;
            }
        })
        .catch(error => {
            console.log('Analytics yüklenemedi:', error);
            // Set fallback values
            const clickCountElements = document.querySelectorAll('#clickCount, #footerClickCount');
            clickCountElements.forEach(element => {
                element.textContent = '0';
            });
        });
}

// Show loading state function
function showLoading() {
    const loading = document.getElementById('loading');
    if (loading) {
        loading.style.display = 'block';
    }
}

// Add click tracking with duplicate prevention
function trackClick(phoneNumber) {
    // Prevent duplicate tracking
    if (analyticsTracked) {
        console.log('Analytics already tracked, skipping...');
        return;
    }
    
    analyticsTracked = true;
    
    // Send click data to analytics
    fetch('api/track_click.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            phone: phoneNumber,
            timestamp: new Date().toISOString(),
            userAgent: navigator.userAgent
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Click tracked:', data);
        updateClickCount();
    })
    .catch(error => {
        console.log('Click tracking failed:', error);
        // Reset flag on error so user can try again
        analyticsTracked = false;
    });
}

// Enhanced page load functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log(config.company_name + ' loaded successfully');
    
    // Update analytics on page load
    updateClickCount();
    
    // Set up click tracking for phone links (only once)
    const phoneLinks = document.querySelectorAll('a[href^="tel:"]');
    phoneLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const phoneNumber = this.getAttribute('href').replace('tel:', '');
            trackClick(phoneNumber);
            showLoading();
        });
    });
    
    // Auto-click if valid phone number exists
    const telLink = document.getElementById('telLink');
    if (telLink && telLink.getAttribute('href') && telLink.getAttribute('href') !== 'tel:') {
        autoClickPhone();
    }
});

// Add service worker for offline support (optional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed');
            });
    });
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Space or Enter to click phone link
    if ((e.key === ' ' || e.key === 'Enter') && document.getElementById('telLink')) {
        e.preventDefault();
        document.getElementById('telLink').click();
    }
    
    // Escape to hide loading
    if (e.key === 'Escape') {
        const loading = document.getElementById('loading');
        if (loading) {
            loading.style.display = 'none';
        }
    }
});

// Add touch feedback for mobile
document.addEventListener('touchstart', function(e) {
    if (e.target.classList.contains('call-button')) {
        e.target.style.transform = 'scale(0.95)';
    }
});

document.addEventListener('touchend', function(e) {
    if (e.target.classList.contains('call-button')) {
        e.target.style.transform = 'scale(1)';
    }
});

// Performance monitoring
window.addEventListener('load', function() {
    if ('performance' in window) {
        const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
        console.log('Page load time:', loadTime + 'ms');
    }
});