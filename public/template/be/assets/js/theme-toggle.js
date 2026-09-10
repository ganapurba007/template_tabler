/**
 * Tabler-Inspired Admin Dashboard - Theme Toggle Handler
 * Manages Dark Mode & Light Mode with localStorage persistence.
 */

document.addEventListener('DOMContentLoaded', () => {
  const html = document.documentElement;
  const toggleButtons = document.querySelectorAll('.theme-toggle-btn, #theme-toggle');

  // Load initial theme from localStorage
  const savedTheme = localStorage.getItem('theme') || 'light';
  applyTheme(savedTheme);

  // Attach event listener to all theme toggle buttons
  toggleButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const currentTheme = html.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'light' ? 'dark' : 'light';
      applyTheme(newTheme);
      localStorage.setItem('theme', newTheme);
    });
  });

  function applyTheme(theme) {
    html.setAttribute('data-theme', theme);

    // Also update Bootstrap 5 data-bs-theme if present
    html.setAttribute('data-bs-theme', theme);

    // Update icons inside toggle buttons
    toggleButtons.forEach((btn) => {
      const icon = btn.querySelector('i');
      if (icon) {
        if (theme === 'dark') {
          icon.className = 'ti ti-sun fs-4';
          btn.setAttribute('title', 'Switch to Light Mode');
        } else {
          icon.className = 'ti ti-moon fs-4';
          btn.setAttribute('title', 'Switch to Dark Mode');
        }
      }
    });
  }
});
