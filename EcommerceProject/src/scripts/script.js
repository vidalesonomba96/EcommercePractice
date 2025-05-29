// src/scripts/script.js

const body = document.body;

function updateToggleIcons(isDark) {
    const iconClass = isDark ? 'fa-sun' : 'fa-moon';
    document.querySelectorAll('.dark-mode-toggle-btn').forEach(btn => {
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-sun', 'fa-moon');
            icon.classList.add(iconClass);
        }
        // For sidebar button, update text if needed, or rely on icon
        if (btn.id === 'darkModeToggleSidebar') {
            const span = btn.querySelector('span');
            if (span) {
                // span.textContent = isDark ? 'Light Mode' : 'Dark Mode';
            }
        }
    });
}

function applyDarkMode(isDark) {
    if (isDark) {
        body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
    } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'disabled');
    }
    updateToggleIcons(isDark);
}

// Check saved preference on initial load (before full DOM ready for script.js)
// This ensures the class is on the body ASAP to prevent flash of unstyled content.
(function() {
    const savedMode = localStorage.getItem('darkMode');
    if (savedMode === 'enabled') {
        body.classList.add('dark-mode');
        // Icons will be updated once DOM is ready and initializeMainFunctionality runs
    }
})();


// Wrap all existing code in a function
function initializeMainFunctionality() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    function openSidebar() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.add('sidebar-open');
            sidebarOverlay.classList.add('sidebar-overlay-visible');
            document.body.classList.add('overflow-hidden-sidebar');
        }
    }

    function closeSidebar() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.remove('sidebar-overlay-visible');
            document.body.classList.remove('overflow-hidden-sidebar');
        }
    }

    if (menuToggle) {
        const newMenuToggle = menuToggle.cloneNode(true);
        menuToggle.parentNode.replaceChild(newMenuToggle, menuToggle);
        newMenuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            openSidebar();
        });
    }

    if (sidebarClose) {
        const newSidebarClose = sidebarClose.cloneNode(true);
        sidebarClose.parentNode.replaceChild(newSidebarClose, sidebarClose);
        newSidebarClose.addEventListener('click', function (e) {
            e.stopPropagation();
            closeSidebar();
        });
    }

    if (sidebarOverlay) {
        const newSidebarOverlay = sidebarOverlay.cloneNode(true);
        sidebarOverlay.parentNode.replaceChild(newSidebarOverlay, sidebarOverlay);
        newSidebarOverlay.addEventListener('click', function () {
            closeSidebar();
        });
    }

    document.removeEventListener('keydown', escapeKeyHandler);
    document.addEventListener('keydown', escapeKeyHandler);

    // Dark Mode Toggle Setup
    document.querySelectorAll('.dark-mode-toggle-btn').forEach(btn => {
        const newBtn = btn.cloneNode(true); // Clone to remove old listeners if any
        btn.parentNode.replaceChild(newBtn, btn);
        newBtn.addEventListener('click', () => {
            const isDarkModeCurrentlyEnabled = body.classList.contains('dark-mode');
            applyDarkMode(!isDarkModeCurrentlyEnabled);
        });
    });
    // Initial icon setup based on current mode (after dynamic content might have loaded)
    updateToggleIcons(body.classList.contains('dark-mode'));
}

function escapeKeyHandler(e) {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (e.key === 'Escape' && sidebar && sidebar.classList.contains('sidebar-open')) {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.remove('sidebar-overlay-visible');
            document.body.classList.remove('overflow-hidden-sidebar');
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    if (!document.body.hasAttribute('data-dynamic-loader')) {
        initializeMainFunctionality();
    }
    // Ensure icons are set correctly on initial load if not dynamically loaded
    // This might be redundant if initializeMainFunctionality always runs, but safe.
    updateToggleIcons(body.classList.contains('dark-mode'));
});

window.initializeDynamicContentScripts = initializeMainFunctionality;