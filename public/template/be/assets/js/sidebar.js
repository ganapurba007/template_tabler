/**
 * Tabler-Inspired Admin Dashboard - Sidebar & Drawer Handler
 * Handles responsive mobile navigation drawer toggle and backdrop.
 */

document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.querySelector('.app-sidebar');
  const toggleBtns = document.querySelectorAll('.sidebar-toggle-btn, [data-toggle="sidebar"]');
  
  if (!sidebar) return;

  // Create backdrop element dynamically if not present
  let backdrop = document.querySelector('.sidebar-backdrop');
  if (!backdrop) {
    backdrop = document.createElement('div');
    backdrop.className = 'sidebar-backdrop';
    document.body.appendChild(backdrop);
  }

  function openSidebar() {
    sidebar.classList.add('show');
    backdrop.classList.add('show');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  }

  function closeSidebar() {
    sidebar.classList.remove('show');
    backdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  function toggleSidebar() {
    if (sidebar.classList.contains('show')) {
      closeSidebar();
    } else {
      openSidebar();
    }
  }

  // Attach event listeners to toggle buttons
  toggleBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      toggleSidebar();
    });
  });

  // Close sidebar when clicking backdrop
  backdrop.addEventListener('click', () => {
    closeSidebar();
  });

  // Close sidebar on escape key press
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && sidebar.classList.contains('show')) {
      closeSidebar();
    }
  });

  // Automatically close sidebar when window resizes above desktop breakpoint (992px)
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 992 && sidebar.classList.contains('show')) {
      closeSidebar();
    }
  });
});
