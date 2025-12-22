import './bootstrap';

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarCloseButton = document.getElementById('sidebar-close-button');

    if (mobileMenuButton && mobileSidebar && sidebarOverlay) {
        function openSidebar() {
            mobileSidebar.classList.remove('translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }

        function closeSidebar() {
            mobileSidebar.classList.add('translate-x-full');
            setTimeout(() => {
                sidebarOverlay.classList.add('hidden');
            }, 300);
        }

        mobileMenuButton.addEventListener('click', openSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);
        if (sidebarCloseButton) {
            sidebarCloseButton.addEventListener('click', closeSidebar);
        }

        // Close sidebar when clicking on a link
        const sidebarLinks = mobileSidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
    }
});
