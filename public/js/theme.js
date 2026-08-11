// Handle Theme Initialization (Forced Light Mode)
document.addEventListener('DOMContentLoaded', () => {
    const htmlElement = document.documentElement;
    htmlElement.classList.remove('dark');
    htmlElement.classList.add('light');
});

// To prevent FOUC (Flash of Unstyled Content), run this script immediately in the head
(function() {
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.add('light');
})();
