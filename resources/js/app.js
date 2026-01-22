import './bootstrap';
import 'flowbite';

// Make functions global so they can be called inline if needed, or stick to event listeners
window.toggleMobileMenu = function() {
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('translate-x-full');
        overlay.classList.toggle('hidden');
    }
}

window.closeMobileMenu = function() {
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (sidebar && overlay) {
        sidebar.classList.add('translate-x-full');
        overlay.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebarCloseButton = document.getElementById('sidebar-close-button');
    const overlay = document.getElementById('sidebar-overlay');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior if any
            window.toggleMobileMenu();
        });
    }

    if (sidebarCloseButton) {
        sidebarCloseButton.addEventListener('click', window.closeMobileMenu);
    }

    if (overlay) {
        overlay.addEventListener('click', window.closeMobileMenu);
    }
});
