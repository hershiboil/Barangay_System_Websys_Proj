const toggleButton = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
  
    // Function to update toggle button position based on sidebar state
    function updateTogglePosition() {
      const isMobile = window.innerWidth <= 991;
  
      // On small screens
      if (isMobile) {
        if (sidebar.classList.contains('active')) {
          sidebarToggleContainer.style.left= '234px';
          toggleButton.style.left = '239px';
          sidebarToggleContainer.style.background = '#ebebeb'; // Sidebar expanded
        } else {
          topnavbar.style.margin = '14px 10px 0px 40px';
          maincontent.style.margin = '14px 10px 0px 40px';
          toggleButton.style.left = '75px'; // Sidebar collapsed
          sidebarToggleContainer.style.left = '71px';
          sidebarToggleContainer.style.background = '#0077f7';
        }
      } else {
        if (sidebar.classList.contains('sidebar-collapsed')) {
          topnavbar.style.margin = '14px 10px 0px 120px';
          maincontent.style.margin = '14px 10px 0px 120px';
          sidebarToggleContainer.style.left = '71px';
          sidebarToggleContainer.style.background = '#0077f7';
          toggleButton.style.left = '75px'; // Collapsed width
        } else {
        topnavbar.style.margin = '14px 10px 0px 285px';
        maincontent.style.margin = '14px 10px 0px 285px';
        sidebarToggleContainer.style.left= '234px';
        sidebarToggleContainer.style.background = '#ebebeb';
          toggleButton.style.left = '239px'; // Expanded width
        }
      }
    }
  
    // Click event: toggle sidebar and update button position
    toggleButton.addEventListener('click', () => {
      const isMobile = window.innerWidth <= 991;
  
      if (isMobile) {
        sidebar.classList.toggle('active');
      } else {
        sidebar.classList.toggle('sidebar-collapsed');
      }
  
      // Update toggle button position
      updateTogglePosition();
  
      // Change icon direction
      if (
        sidebar.classList.contains('sidebar-collapsed') || 
        (window.innerWidth <= 991 && !sidebar.classList.contains('active'))
      ) {
        toggleIcon.innerText = 'chevron_right';
      } else {
        toggleIcon.innerText = 'chevron_left';
      }
    });
  
    // Window resize event: reset sidebar state and button position
    window.addEventListener('resize', () => {
      if (window.innerWidth > 991) {
        sidebar.classList.remove('active'); // Remove mobile state
      } else {
        sidebar.classList.remove('sidebar-collapsed'); // Remove desktop collapsed state
        content.classList.remove('sidebar-collapsed');
      }
  
      // Set icon to default and update button position
      toggleIcon.innerText = 'chevron_left';
      updateTogglePosition();
    });
  
    // Collapse dropdowns inside sidebar (optional)
    document.addEventListener('DOMContentLoaded', () => {
  // === SIDEBAR DROPDOWNS ===
  const dropdowns = document.querySelectorAll('#sidebar .dropdown-toggle');

  dropdowns.forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      const parent = toggle.closest('.dropdown');
      parent.classList.toggle('open');
    });
  });

  // Set toggle button position on page load
  updateTogglePosition();

  // === NAVBAR NOTIFICATION + PROFILE DROPDOWNS ===
  const notificationToggle = document.getElementById('notificationToggle');
  const notificationDropdown = document.getElementById('notificationDropdown');
  const profileToggle = document.getElementById('profileToggle');
  const profileDropdown = document.getElementById('profileDropdown');

  function closeAllDropdowns() {
    notificationDropdown.classList.remove('show');
    profileDropdown.classList.remove('show');
  }

  notificationToggle.addEventListener('click', (e) => {
    e.preventDefault();
    const isShown = notificationDropdown.classList.contains('show');
    closeAllDropdowns();
    if (!isShown) {
      notificationDropdown.classList.add('show');
    }
  });

  profileToggle.addEventListener('click', (e) => {
    e.preventDefault();
    const isShown = profileDropdown.classList.contains('show');
    closeAllDropdowns();
    if (!isShown) {
      profileDropdown.classList.add('show');
    }
  });

  // Close if clicking outside
  document.addEventListener('click', (event) => {
    if (
      !notificationToggle.contains(event.target) &&
      !notificationDropdown.contains(event.target) &&
      !profileToggle.contains(event.target) &&
      !profileDropdown.contains(event.target)
    ) {
      closeAllDropdowns();
    }
  });
});


 
  function updateDateTime() {
    const now = new Date();
    const options = {
      weekday: 'short', year: 'numeric', month: 'short',
      day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
    };
    document.getElementById('currentDateTime').textContent = now.toLocaleString('en-US', options);
  }

  // Initial load
  updateDateTime();

  // Update every second
  setInterval(updateDateTime, 1000);
