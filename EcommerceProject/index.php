<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$base_url = '.'; // Base URL for includes/links from root
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConnectMarket - Your C2C Marketplace</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="src/styles/style.css">
    <link rel="shortcut icon" href="src/img/icon.png" type="image/x-icon">
</head>
<body> 

    <?php include 'src/components/header/_header.php'; ?>

    <main class="site-main">
        <section class="new-arrivals-section">
            <div class="container">
                <div class="new-arrivals-banner">
                    <div class="banner-content">
                        <h2 class="banner-title">Discover the Latest Arrivals</h2>
                        <p class="banner-description">Be the first to explore our exciting collection of brand new goods. From trending gadgets to stylish apparel, find something special today!</p>
                        <a href="<?php echo htmlspecialchars($base_url); ?>/new_arrivals_page.php" class="btn btn-primary btn-large">Shop New Arrivals</a> 
                    </div>
                    <div class="banner-image">
                        <img src="<?php echo htmlspecialchars($base_url); ?>/src/img/new-arrivals.jpg" alt="New Arrivals Collection">
                    </div>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Why Trade with ConnectMarket?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt feature-icon feature-icon-secure"></i>
                        <h3 class="feature-title">Secure Transactions</h3>
                        <p class="feature-description">Shop and sell with confidence thanks to our secure payment gateway and fraud protection.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-users feature-icon feature-icon-community"></i>
                        <h3 class="feature-title">Vibrant Community</h3>
                        <p class="feature-description">Connect with fellow buyers and sellers, discover unique items, and share your passion.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-rocket feature-icon feature-icon-easy"></i>
                        <h3 class="feature-title">Easy Listing &amp; Selling</h3>
                        <p class="feature-description">List your items in minutes and reach thousands of potential buyers effortlessly.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="footer-placeholder">
        </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize sidebar, dark mode, etc., as header is now part of initial DOM
        if (typeof window.initializeDynamicContentScripts === 'function') {
            window.initializeDynamicContentScripts();
        } else {
            console.error('Main initialization function (initializeDynamicContentScripts) not found.');
        }

        // Load footer (if it's static HTML and you prefer JS loading)
        function loadHTML(filePath, placeholderId, callback) {
            fetch(filePath)
                .then(response => {
                    if (!response.ok) throw new Error(`Failed to load ${filePath}`);
                    return response.text();
                })
                .then(data => {
                    const placeholder = document.getElementById(placeholderId);
                    if (placeholder) placeholder.innerHTML = data;
                    if (callback) callback();
                })
                .catch(error => console.error(`Error loading HTML from ${filePath}:`, error));
        }
        loadHTML('src/components/footer/_footer.html', 'footer-placeholder', function() {
            const currentYearSpan = document.getElementById('currentYear');
            if (currentYearSpan) currentYearSpan.textContent = new Date().getFullYear();
        });
    });
    </script>
    <script src="src/scripts/script.js" defer></script>
    <?php
// ... (rest of your page content)
// $base_url is already defined at the top of index.php as '.'
include 'src/components/footer/_footer.php';
?>
</body>
</html>