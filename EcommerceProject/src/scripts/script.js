// src/scripts/script.js

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

    // Re-fetch elements and re-attach listeners
    // This ensures that if this function is called multiple times (e.g., after dynamic content load),
    // listeners are correctly attached to the current elements in the DOM.

    if (menuToggle) {
        // Clone and replace to remove old listeners before adding new ones.
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

    // For keydown, it's usually fine to add it once on the document.
    // However, to ensure the handler function (escapeKeyHandler) is the current one
    // and to prevent multiple identical listeners if this script were somehow run multiple times
    // without full page reload, explicit removal before adding is safer.
    document.removeEventListener('keydown', escapeKeyHandler); // Remove if previously attached
    document.addEventListener('keydown', escapeKeyHandler);
}

// Define escapeKeyHandler in a scope accessible by the event listener management.
function escapeKeyHandler(e) {
    const sidebar = document.getElementById('sidebar'); // Re-fetch sidebar in handler for current state
    const sidebarOverlay = document.getElementById('sidebar-overlay'); // Re-fetch overlay

    if (e.key === 'Escape' && sidebar && sidebar.classList.contains('sidebar-open')) {
        // Direct DOM manipulation for close, ensuring it uses current elements
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.remove('sidebar-overlay-visible');
            document.body.classList.remove('overflow-hidden-sidebar');
        }
    }
}

// Run on initial DOMContentLoaded.
// The data-dynamic-loader attribute check prevents this from running if the loader script will call it.
document.addEventListener('DOMContentLoaded', function() {
    if (!document.body.hasAttribute('data-dynamic-loader')) {
        initializeMainFunctionality();
    }
});

// Expose the function globally to be callable after dynamic content loading
window.initializeDynamicContentScripts = initializeMainFunctionality;