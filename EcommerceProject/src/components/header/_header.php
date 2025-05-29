<?php
// File: EcommerceProject/src/components/header/_header.php
// This file expects $base_url to be defined by the including PHP page.
// Example: For index.php in root: $base_url = '.';
// Example: For src/pages/login.php: $base_url = '../..';
if (session_status() == PHP_SESSION_NONE && !headers_sent()) { // Ensure session is started if not already
    session_start();
}
?>
<header class="site-header">
    <div class="container header-container">
        <a href="<?php echo htmlspecialchars($base_url); ?>/index.php" class="logo-link">
             <img src="<?php echo htmlspecialchars($base_url); ?>/src/img/icon2.png" alt="ConnectMarket Logo" class="logo-image">
        </a>

        <div class="search-container-desktop">
            <form action="<?php echo htmlspecialchars($base_url); ?>/search_handler.php" method="GET" class="search-form"> 
                <input type="search" name="query" placeholder="Search for anything..." class="search-input" required>
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <nav class="nav-desktop">
            <a href="<?php echo htmlspecialchars($base_url); ?>/categories.php" class="nav-link">Categories</a> 
            <a href="<?php echo htmlspecialchars($base_url); ?>/sell.php" class="nav-link btn btn-sell"> 
                <i class="fas fa-plus-circle"></i> Sell
            </a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <a href="<?php echo htmlspecialchars($base_url); ?>/profile.php" class="nav-link" ><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['username']); ?></a> 
                <a href="<?php echo htmlspecialchars($base_url); ?>/logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="<?php echo htmlspecialchars($base_url); ?>/src/pages/login.php" class="nav-link">Login</a>
                <a href="<?php echo htmlspecialchars($base_url); ?>/src/pages/register.php" class="nav-link btn btn-signup">
                    Sign Up
                </a>
            <?php endif; ?>
            <a href="<?php echo htmlspecialchars($base_url); ?>/cart.php" class="nav-link cart-link"> 
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge">0</span>
            </a>
            <button id="darkModeToggle" aria-label="Toggle dark mode" class="dark-mode-toggle-btn stylish-switch">
                <span class="stylish-switch-track"></span>
                <span class="stylish-switch-knob">
                    <i class="fas fa-sun"></i>
                </span>
            </button>
        </nav>

        <div class="menu-toggle-container">
            <button id="darkModeToggleMobile" aria-label="Toggle dark mode" class="dark-mode-toggle-btn stylish-switch mobile-switch">
                 <span class="stylish-switch-track"></span>
                 <span class="stylish-switch-knob">
                     <i class="fas fa-sun"></i>
                 </span>
            </button>
            <button id="menu-toggle" aria-label="Open menu" class="menu-toggle-button">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <button id="sidebar-close" aria-label="Close menu" class="sidebar-close-button">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <form action="<?php echo htmlspecialchars($base_url); ?>/search_handler.php" method="GET" class="search-form sidebar-search-form"> 
        <input type="search" name="query" placeholder="Search for anything..." class="search-input" required>
        <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <nav class="sidebar-nav">
        <a href="<?php echo htmlspecialchars($base_url); ?>/categories.php" class="sidebar-nav-link"><i class="fas fa-th-large"></i><span>Categories</span></a> 
        <a href="<?php echo htmlspecialchars($base_url); ?>/sell.php" class="sidebar-nav-link btn btn-sell"><i class="fas fa-plus-circle"></i> <span>Sell Item</span></a> 
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="<?php echo htmlspecialchars($base_url); ?>/profile.php" class="sidebar-nav-link"><i class="fas fa-user-circle"></i> <span><?php echo htmlspecialchars($_SESSION['username']); ?></span></a> 
            <a href="<?php echo htmlspecialchars($base_url); ?>/logout.php" class="sidebar-nav-link"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
        <?php else: ?>
            <a href="<?php echo htmlspecialchars($base_url); ?>/src/pages/login.php" class="sidebar-nav-link"><i class="fas fa-sign-in-alt"></i> <span>Login</span></a>
            <a href="<?php echo htmlspecialchars($base_url); ?>/src/pages/register.php" class="sidebar-nav-link btn btn-signup"><span>Sign Up</span></a>
        <?php endif; ?>
        <a href="<?php echo htmlspecialchars($base_url); ?>/cart.php" class="sidebar-nav-link cart-link-sidebar"> 
            <i class="fas fa-shopping-cart"></i>
            <span>Cart</span>
            <span class="cart-badge">0</span>
        </a>
        <button id="darkModeToggleSidebar" class="sidebar-nav-link dark-mode-toggle-btn stylish-switch sidebar-switch" aria-label="Toggle dark mode">
            <span class="stylish-switch-track"></span>
            <span class="stylish-switch-knob">
                <i class="fas fa-sun"></i>
            </span>
            <span class="stylish-switch-label">Toggle Theme</span>
        </button>
    </nav>
</div>
<div id="sidebar-overlay" class="sidebar-overlay"></div>