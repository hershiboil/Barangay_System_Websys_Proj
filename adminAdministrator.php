<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Barangay Balinad Portal</title>
  <link rel="icon" href="img/barangayBalinad.png" type="image/png">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="sidebar.css">

  <style>
    .position-content {
        margin-left: 280px; /* Match full sidebar width */
        margin-right: 10px;
        margin-top: 15px;
        transition: margin-left 0.3s ease;
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .search {
        width: max-content;
        display: flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 28px;
        background: #f0f0f0;
        border: none;
        box-shadow: none;
        transition: box-shadow 0.25s;
    }

    .search:focus-within {
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.75);
    }

    .search-icon {
        color: #0077f7;
    }

    .search-input {
        padding-left: 10px;
        font-size: 16px; 
        color: grey;
        margin-left: 14px;
        outline: none;
        border: none;
        background-color: transparent;
        outline: none;
        flex: 1;
        width: 250px;
        height: 30px;
        background: transparent;
        box-shadow: none;
    }

    .search-input::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    .table-primary {
        height: 50px;
    }

    /* Modal Custom Styles */
    .modal-custom {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Input Fields */
    .modal-input {
        border-radius: 8px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    #cancelBtn, #saveBtn {
        border-radius: 8px;
    }
      
    /* Modal Label */
    .form-label {
        color: grey;
        font-weight: 500;
    }
    
    .btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /*Round table corners*/
    .table-rounded thead th:first-child {
        border-top-left-radius: 0.9rem;
    }
    .table-rounded thead th:last-child {
        border-top-right-radius: 0.9rem;
    }

    /* allow the dropdown to escape the table’s box */
    .table-borderless,
    .table-borderless td,
    .table-borderless th {
        overflow: visible !important;
    }

    /* make sure the dropdown is on top */
    .dropdown-menu {
        z-index: 1050;  
    }

  </style>
</head>
<body>

<div class="wrapper d-flex">
    
    <!-- Sidebar -->
    <nav id="sidebar">
  
        <div class="sidebar-header">
          <img src="img/barangayBalinad.png" class="logo-img"/>
          <div class="text-conatinerp">
            <h3>CONNECT</h3>
            <p>Balinad, Daraga, Albay</p>
          </div>
        </div>

        <ul class="list-unstyled components">

            <li  class="">
              <a href="adminDashboard.php"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
          </li>
            
          <li class="">
            <a href="adminAnnouncement.php">
              <i class="material-icons">campaign</i>
              <span>Announcement</span>
            </a>
          </li>

          <li class="dropdown">
            <a href="#pageSubmenu1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">manage_accounts</i><span>Barangay Officials</span></a>

            <ul class="collapse list-unstyled menu" id="pageSubmenu1" data-bs-parent="#sidebar">
              
                <li style="margin-left: 20px;">
                  <a href="adminCurrentOfficials.php">
                    <i class="material-icons">assignment_ind</i><span>Current Officials</span></a>
                </li>
                <li style="margin-left: 20px;">
                  <a href="adminFormerOfficials.php">
                    <i class="material-icons">event_busy</i><span>Former Officials</span></a>
                </li>
            </ul>
        </li>
            
            <li class="dropdown">
                <a href="#pageSubmenu2" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">people</i><span>Resident's Info</span></a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu2" data-bs-parent="#sidebar">

                  <li style="margin-left: 20px;">
                    <a href="adminAllResidents.php">
                      <i class="material-icons">groups</i><span>All Residents</span></a>
                  </li>

                  <li style="margin-left: 20px;">
                    <a href="adminArchivedResidents.php">
                      <i class="material-icons">archive</i><span>Archived Residents</span></a>
                  </li>
                </ul>
            </li>
                      
           <li class="dropdown">
            <a href="#pageSubmenu3" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">account_circle</i><span>Users</span></a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu3" data-bs-parent="#sidebar">

                  <li style="margin-left: 20px;">
                    <a href="adminResidents.php">
                      <i class="material-icons">contact_mail</i><span>Residents</span></a>
                  </li>
                  <li style="margin-left: 20px;">
                    <a href="adminAdministrator.php">
                      <i class="material-icons">admin_panel_settings</i><span>Administrator</span></a>
                  </li>
                </ul>
            </li>
           
           <li class="">
                <a href="adminRoles.php"><i class="material-icons">lock</i><span>Roles</span></a>
            </li>
            
             <li  class="">
                <a href="adminPosition.php"><i class="material-icons">military_tech</i><span>Position
                </span></a>
            </li>

            <li class="dropdown">
              <a href="#menucertificates" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="material-icons">description</i><span>Certificates</span></a>
                  <ul class="collapse list-unstyled menu" id="menucertificates">
  
                    <li style="margin-left: 20px;">
                      <a href="adminIndigency.php">
                        <i class="material-icons">volunteer_activism</i><span>Indigency</span></a>
                    </li>
                    <li style="margin-left: 20px;">
                      <a href="adminResidency.php">
                        <i class="material-icons">maps_home_work</i><span>Residency</span></a>
                    </li>
                    <li style="margin-left: 20px;">
                      <a href="adminClearance.php">
                        <i class="material-icons">task_alt</i><span>Clearance</span></a>
                    </li>
                    <li style="margin-left: 20px;">
                      <a href="adminBusinessPermit.php">
                        <i class="material-icons">business_center</i><span>Business Permit</span></a>
                    </li>
                  </ul>
              </li>   
              
              <li  class="">
                <a href="adminReports.php"><i class="material-icons">report</i><span>Reports
                </span></a>
            </li>

            <li  class="">
              <a href="adminBlotter.php"><i class="material-icons">gavel</i><span>Blotter
              </span></a>
          </li>
              
          <li  class="">
            <a href="adminSettings.php"><i class="material-icons">settings</i><span>Settings
            </span></a>
        </li>
        </ul>

    </nav>

  <!--main content-->
  <div id="content" class="flex-grow-1">
    <div class="top-navbar px-3 py-2 d-flex align-items-center justify-content-between" id="topnavbar" >
        <div class="d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap w-100">
      
          <!-- Left side: Toggle + Calendar -->
          <div class="d-flex align-items-center">
            <div class="sidebarToggleContainer me-3" id="sidebarToggleContainer">
              <button id="sidebarToggle" class="btn btn-sm toggle-btn">
                <i class="material-icons" id="toggleIcon">chevron_left</i>
              </button>
            </div>
      
            <div class="date-time d-flex align-items-center">
              <span class="material-icons me-1">calendar_today</span>
              <span id="currentDateTime" class="small text-dark fw-medium"></span>
            </div>
          </div>
      
          <!-- Right side: Notification + Profile -->
          <div class="xp-profilebar d-flex align-items-center ms-auto">
            <nav class="navbar p-0">
              <ul class="nav navbar-nav flex-row align-items-center mb-0">

                <!-- Notification -->
                <li class="nav-item dropdown me-3">
                  <a href="#" class="nav-link" id="notificationToggle" >
                    <span class="material-icons">notifications</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end position-absolute" id="notificationDropdown">
                    <li><a class="dropdown-item" href="#">Notification 1</a></li>
                  </ul>
                </li>
                  
      
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown position-relative">
                  <a class="nav-link d-flex align-items-center" href="#"
                   id="profileToggle">
                    <img src="img/user.png" style="width:40px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);" />
                    <span class="xp-user-live ms-1"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end small-menu position-absolute" id="profileDropdown">
                    <li><a class="dropdown-item" href="#"><span class="material-icons me-2">person_outline</span>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-icons me-2">settings</span>Settings</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-icons me-2">logout</span>Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
      
        </div>
      </div>      
    <!--end of top-navbar-->
    
   
    <!--Position Content-->
    <div class="position-content p-4" id="maincontent">
        <h2>Administrator Account</h2>

        <!--Search bar-->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form class="m-0">
                <div class="search d-flex align-items-center">
                    <span class="search-icon material-icons me-2">search</span>
                    <input class="search-input form-control" type="search" placeholder="Search">
                </div>
            </form>
            <!--Create Position Button-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAccount">+ Create New Account</button>
        </div>

        <!--Add New Account Modal-->
        <div class="modal fade" id="createAccount" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createAccountModalLabel">Add New Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3 mb-3" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-right: 20px; position: relative;">
                            <label for="searchResident" class="form-label" style="margin-bottom: 0; font-size: 0.9rem;">Search Resident:</label>
                            <input type="text" class="form-control form-control-sm" id="searchResident" name="searchResident" placeholder="Enter name or ID" onkeyup="searchResidents()" style="max-width: 200px;">
                            <ul id="searchResults" class="list-group" style="position: absolute; top: 100%; right: 20px; z-index: 1000; width: 200px; max-height: 150px; overflow-y: auto; display: none;"></ul>
                        </div>

                        <div class="mb-3">
                            <label for="accountResidentId" class="form-label">Resident ID</label>
                            <input type="text" class="form-control" id="accountResidentId" name="resident_id" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="accountFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="accountFullName" name="full_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="accountPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="accountPassword" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="accountRoleSelect" class="form-label">Role</label>
                            <select class="form-select" id="accountRoleSelect" name="role_id">
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="accountStatusSelect" class="form-label">Status</label>
                            <select class="form-select" id="accountStatusSelect" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary me-2" id="cancelBtn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table-->
        <table class="table table-borderless table-rounded">
            <thead>
              <tr class="table-primary">
                <th scope="col" style="width: 200px;">Resident ID</th>
                <th scope="col" style="width: 300px;">Full Name</th>
                <th scope="col" style="width: 100px;">Role</th>
                <th scope="col" style="width: 100px;">Status</th>
                <th scope="col" style="width: 200px;">Last Modified</th>
                <th scope="col" style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
        
        <!-- Edit Modal -->
        <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAccountModalLabel">Edit Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3 mb-3" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-right: 20px; position: relative;">
                            <label for="searchResidentEdit" class="form-label" style="margin-bottom: 0; font-size: 0.9rem;">Search Resident:</label>
                            <input type="text" class="form-control form-control-sm" id="searchResidentEdit" name="searchResidentEdit" placeholder="Enter name or ID" onkeyup="searchResidentsEdit()" style="max-width: 200px;">
                            <ul id="searchResultsEdit" class="list-group" style="position: absolute; top: 100%; right: 20px; z-index: 1000; width: 200px; max-height: 150px; overflow-y: auto; display: none;"></ul>
                        </div>

                        <div class="mb-3">
                            <label for="editAccountResidentId" class="form-label">Resident ID</label>
                            <input type="text" class="form-control" id="editAccountResidentId" name="resident_id" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="editAccountFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="editAccountFullName" name="full_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="editAccountPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editAccountPassword" name="password" placeholder="Leave blank to keep current password">
                        </div>

                        <div class="mb-3">
                            <label for="editAccountRoleSelect" class="form-label">Role</label>
                            <select class="form-select" id="editAccountRoleSelect" name="role_id">
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="editAccountStatusSelect" class="form-label">Status</label>
                            <select class="form-select" id="editAccountStatusSelect" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary me-2" id="editCancelBtn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="editSaveBtn">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this position?
                <input type="hidden" id="deleteId">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>

  
    </div>
</div>



<!-- Bootstrap JS -->
<!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // GLOBAL VARIABLES
        let allAccounts = []; // To store all fetched accounts for client-side filtering

        // GLOBAL FUNCTIONS (accessible by onkeyup and onclick attributes)

        // For "Add New Account" Modal - Populates resident data after selection
        window.populateResidentData = function(resident) {
            const accountResidentIdInput = document.getElementById('accountResidentId');
            const accountFullNameInput = document.getElementById('accountFullName');
            const searchResultsList = document.getElementById('searchResults');

            if (accountResidentIdInput) accountResidentIdInput.value = resident.resident_ID;
            if (accountFullNameInput) accountFullNameInput.value = `${resident.first_name} ${resident.last_name}`;
            if (searchResultsList) searchResultsList.style.display = 'none';
        };

        // For "Edit Account" Modal - Populates resident data after selection
        window.populateResidentDataEdit = function(resident) {
            const editAccountResidentIdInput = document.getElementById('editAccountResidentId');
            const editAccountFullNameInput = document.getElementById('editAccountFullName');
            const searchResultsEditList = document.getElementById('searchResultsEdit');

            if (editAccountResidentIdInput) editAccountResidentIdInput.value = resident.resident_ID;
            if (editAccountFullNameInput) editAccountFullNameInput.value = `${resident.first_name} ${resident.last_name}`;
            if (searchResultsEditList) searchResultsEditList.style.display = 'none';
        };

        // Search for "Add New Account" Modal - Still uses server-side search for resident selection
        window.searchResidents = function() {
            const searchResidentInput = document.getElementById('searchResident');
            const searchResultsList = document.getElementById('searchResults');
            const searchTerm = searchResidentInput.value.trim();

            searchResultsList.innerHTML = '';
            searchResultsList.style.display = 'none';

            if (searchTerm.length > 2) {
                fetch(`searchResidentForAccount.php?query=${encodeURIComponent(searchTerm)}`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.residents && data.residents.length > 0) {
                            searchResultsList.style.display = 'block';
                            data.residents.forEach(resident => {
                                const listItem = document.createElement('li');
                                listItem.classList.add('list-group-item', 'list-group-item-action');
                                listItem.textContent = `${resident.first_name} ${resident.last_name} (ID: ${resident.resident_ID})`;
                                listItem.addEventListener('click', () => window.populateResidentData(resident));
                                searchResultsList.appendChild(listItem);
                            });
                        } else {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.textContent = 'No residents found.';
                            searchResultsList.appendChild(listItem);
                            searchResultsList.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching residents (Add Modal):', error);
                        const listItem = document.createElement('li');
                        listItem.classList.add('list-group-item', 'list-group-item-danger');
                        listItem.textContent = 'Error loading residents.';
                        searchResultsList.appendChild(listItem);
                        searchResultsList.style.display = 'block';
                    });
            }
        };

        // Search for "Edit Account" Modal - Still uses server-side search for resident selection
        window.searchResidentsEdit = function() {
            const searchResidentEditInput = document.getElementById('searchResidentEdit');
            const searchResultsEditList = document.getElementById('searchResultsEdit');
            const searchTerm = searchResidentEditInput.value.trim();

            searchResultsEditList.innerHTML = '';
            searchResultsEditList.style.display = 'none';

            if (searchTerm.length > 2) {
                fetch(`searchResidentForAccount.php?query=${encodeURIComponent(searchTerm)}`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.residents && data.residents.length > 0) {
                            searchResultsEditList.style.display = 'block';
                            data.residents.forEach(resident => {
                                const listItem = document.createElement('li');
                                listItem.classList.add('list-group-item', 'list-group-item-action');
                                listItem.textContent = `${resident.first_name} ${resident.last_name} (ID: ${resident.resident_ID})`;
                                listItem.addEventListener('click', () => window.populateResidentDataEdit(resident));
                                searchResultsEditList.appendChild(listItem);
                            });
                        } else {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.textContent = 'No residents found.';
                            searchResultsEditList.appendChild(listItem);
                            searchResultsEditList.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching residents (Edit Modal):', error);
                        const listItem = document.createElement('li');
                        listItem.classList.add('list-group-item', 'list-group-item-danger');
                        listItem.textContent = 'Error loading residents.';
                        searchResultsEditList.appendChild(listItem);
                        searchResultsEditList.style.display = 'block';
                    });
            }
        };

        // New Function: Filter the displayed table rows
        window.filterTable = function() {
            const searchInput = document.querySelector('.search-input'); // Use class selector for the search bar
            const filter = searchInput.value.toLowerCase();
            const tableBody = document.getElementById('tableBody');
            const rows = tableBody.getElementsByTagName('tr');

            // Loop through all table rows, and hide those that don't match the search query
            for (let i = 0; i < rows.length; i++) {
                let rowText = rows[i].textContent.toLowerCase();
                if (rowText.includes(filter)) {
                    rows[i].style.display = ""; // Show row
                } else {
                    rows[i].style.display = "none"; // Hide row
                }
            }
        };


        // --- DOMContentLoaded ---
        document.addEventListener('DOMContentLoaded', function() {
            // --- Sidebar Toggling and Responsiveness ---
            const toggleButton = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const topnavbar = document.getElementById('topnavbar');
            const maincontent = document.getElementById('maincontent');
            const sidebarToggleContainer = document.getElementById('sidebarToggleContainer');

            function updateTogglePosition() {
                const isMobile = window.innerWidth <= 991;
                if (isMobile) {
                    if (sidebar.classList.contains('active')) {
                        if (sidebarToggleContainer) sidebarToggleContainer.style.left = '234px';
                        if (toggleButton) toggleButton.style.left = '239px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.background = '#ebebeb';
                    } else {
                        if (topnavbar) topnavbar.style.margin = '14px 10px 0px 40px';
                        if (maincontent) maincontent.style.margin = '14px 10px 0px 40px';
                        if (toggleButton) toggleButton.style.left = '75px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.left = '71px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.background = '#0077f7';
                    }
                } else {
                    if (sidebar.classList.contains('sidebar-collapsed')) {
                        if (topnavbar) topnavbar.style.margin = '14px 10px 0px 120px';
                        if (maincontent) maincontent.style.margin = '14px 10px 0px 120px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.left = '71px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.background = '#0077f7';
                        if (toggleButton) toggleButton.style.left = '75px';
                    } else {
                        if (topnavbar) topnavbar.style.margin = '14px 10px 0px 285px';
                        if (maincontent) maincontent.style.margin = '14px 10px 0px 285px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.left = '234px';
                        if (sidebarToggleContainer) sidebarToggleContainer.style.background = '#ebebeb';
                        if (toggleButton) toggleButton.style.left = '239px';
                    }
                }
            }

            if (toggleButton) {
                toggleButton.addEventListener('click', () => {
                    const isMobile = window.innerWidth <= 991;
                    if (isMobile) {
                        if (sidebar) sidebar.classList.toggle('active');
                    } else {
                        if (sidebar) sidebar.classList.toggle('sidebar-collapsed');
                    }
                    updateTogglePosition();
                    if (toggleIcon && sidebar) {
                        if (
                            sidebar.classList.contains('sidebar-collapsed') ||
                            (window.innerWidth <= 991 && !sidebar.classList.contains('active'))
                        ) {
                            toggleIcon.innerText = 'chevron_right';
                        } else {
                            toggleIcon.innerText = 'chevron_left';
                        }
                    }
                });
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth > 991) {
                    if (sidebar) sidebar.classList.remove('active');
                } else {
                    if (sidebar) sidebar.classList.remove('sidebar-collapsed');
                    if (content) content.classList.remove('sidebar-collapsed');
                }
                if (toggleIcon) toggleIcon.innerText = 'chevron_left';
                updateTogglePosition();
            });

            const dropdowns = document.querySelectorAll('#sidebar .dropdown-toggle');
            dropdowns.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const parent = toggle.closest('.dropdown');
                    if (parent) parent.classList.toggle('open');
                });
            });

            updateTogglePosition();

            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'short', year: 'numeric', month: 'short',
                    day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
                };
                const currentDateTimeElement = document.getElementById('currentDateTime');
                if (currentDateTimeElement) {
                    currentDateTimeElement.textContent = now.toLocaleString('en-US', options);
                }
            }

            updateDateTime();
            setInterval(updateDateTime, 1000);

            // --- Shared Function for Populating Role Dropdowns ---
            function populateRolesDropdown(selectElementId) {
                const selectElement = document.getElementById(selectElementId);
                if (!selectElement) return;

                fetch('getRolesForSelect.php')
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        selectElement.innerHTML = '<option value="">Select a Role</option>';
                        if (data.success && data.roles) {
                            data.roles.forEach(role => {
                                const option = document.createElement('option');
                                option.value = role.role_id;
                                option.textContent = role.role_name;
                                selectElement.appendChild(option);
                            });
                        } else {
                            console.error('Error fetching roles:', data.message || 'Unknown error.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error for roles:', error);
                    });
            }

            // --- Add New Account Modal Logic ---
            const createAccountModal = document.getElementById('createAccount');
            const saveAccountBtn = createAccountModal ? createAccountModal.querySelector('#saveBtn') : null;
            const searchResidentInput = document.getElementById('searchResident');
            const searchResultsList = document.getElementById('searchResults');
            const accountResidentIdInput = document.getElementById('accountResidentId');
            const accountFullNameInput = document.getElementById('accountFullName');
            const accountPasswordInput = document.getElementById('accountPassword');
            const accountRoleSelect = document.getElementById('accountRoleSelect');
            const accountStatusSelect = document.getElementById('accountStatusSelect');

            if (createAccountModal) {
                createAccountModal.addEventListener('show.bs.modal', function() {
                    populateRolesDropdown('accountRoleSelect'); // Populate roles for add modal

                    if (searchResidentInput) searchResidentInput.value = '';
                    if (searchResultsList) {
                        searchResultsList.innerHTML = '';
                        searchResultsList.style.display = 'none';
                    }
                    if (accountResidentIdInput) accountResidentIdInput.value = '';
                    if (accountFullNameInput) accountFullNameInput.value = '';
                    if (accountPasswordInput) accountPasswordInput.value = '';
                    if (accountRoleSelect) accountRoleSelect.value = ''; // Clear selected role
                    if (accountStatusSelect) accountStatusSelect.value = 'active'; // Default status
                });
            }

            document.addEventListener('click', (event) => {
                if (searchResidentInput && searchResultsList && !searchResidentInput.contains(event.target) && !searchResultsList.contains(event.target)) {
                    searchResultsList.style.display = 'none';
                }
            });

            if (saveAccountBtn) {
                saveAccountBtn.addEventListener('click', () => {
                    const residentId = accountResidentIdInput ? accountResidentIdInput.value : null;
                    const password = accountPasswordInput ? accountPasswordInput.value : '';
                    const roleId = accountRoleSelect ? accountRoleSelect.value : '';
                    const status = accountStatusSelect ? accountStatusSelect.value : '';

                    const fullNameForValidation = accountFullNameInput ? accountFullNameInput.value.trim() : '';

                    if (!residentId || !password || !roleId || !status || !fullNameForValidation) {
                        alert('Please ensure Resident ID, Full Name, Password, Role, and Status are selected/filled.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('resident_id', residentId);
                    formData.append('password', password);
                    formData.append('role_id', roleId);
                    formData.append('status', status);

                    fetch('saveAccount.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message || 'Account created successfully!');
                            const bootstrapModal = bootstrap.Modal.getInstance(createAccountModal);
                            bootstrapModal.hide();
                            fetchAndDisplayAccounts(); // Refresh table
                        } else {
                            alert('Error creating account: ' + (data.message || 'Unknown error.'));
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error (create account):', error);
                        alert('An error occurred while creating the account. Please try again.');
                    });
                });
            }

            // --- Edit Account Modal Logic ---
            const editAccountModal = document.getElementById('editAccountModal');
            const editSaveBtn = editAccountModal ? editAccountModal.querySelector('#editSaveBtn') : null;

            const editAccountResidentIdInput = document.getElementById('editAccountResidentId');
            const editAccountFullNameInput = document.getElementById('editAccountFullName');
            const editAccountPasswordInput = document.getElementById('editAccountPassword');
            const editAccountRoleSelect = document.getElementById('editAccountRoleSelect');
            const editAccountStatusSelect = document.getElementById('editAccountStatusSelect');
            const searchResidentEditInput = document.getElementById('searchResidentEdit');
            const searchResultsEditList = document.getElementById('searchResultsEdit');


            window.populateEditAccountModal = function(residentIdToEdit) {
                if (!editAccountModal) return;

                // Clear previous content
                if (editAccountResidentIdInput) editAccountResidentIdInput.value = '';
                if (editAccountFullNameInput) editAccountFullNameInput.value = '';
                if (editAccountPasswordInput) editAccountPasswordInput.value = ''; // Clear password field
                if (editAccountRoleSelect) editAccountRoleSelect.value = '';
                if (editAccountStatusSelect) editAccountStatusSelect.value = '';
                if (searchResidentEditInput) searchResidentEditInput.value = '';
                if (searchResultsEditList) {
                    searchResultsEditList.innerHTML = '';
                    searchResultsEditList.style.display = 'none';
                }

                populateRolesDropdown('editAccountRoleSelect'); // Populate roles for edit modal

                fetch(`getAccountDetails.php?resident_id=${encodeURIComponent(residentIdToEdit)}`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.account) {
                            const account = data.account;
                            if (editAccountResidentIdInput) editAccountResidentIdInput.value = account.resident_id;
                            if (editAccountFullNameInput) editAccountFullNameInput.value = account.full_name;
                            // Password is NOT populated for security. User must type new password if they want to change.
                            if (editAccountRoleSelect) editAccountRoleSelect.value = account.role_id;
                            if (editAccountStatusSelect) editAccountStatusSelect.value = account.status;

                            // Show the modal
                            const bootstrapModal = new bootstrap.Modal(editAccountModal);
                            bootstrapModal.show();

                        } else {
                            alert('Error loading account details: ' + (data.message || 'Account not found.'));
                            console.error('Error loading account details:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error (get account details):', error);
                        alert('An error occurred while fetching account details. Please try again.');
                    });
            };

            if (editSaveBtn) {
                editSaveBtn.addEventListener('click', () => {
                    const residentId = editAccountResidentIdInput ? editAccountResidentIdInput.value : null;
                    const password = editAccountPasswordInput ? editAccountPasswordInput.value : ''; // Only update if non-empty
                    const roleId = editAccountRoleSelect ? editAccountRoleSelect.value : '';
                    const status = editAccountStatusSelect ? accountStatusSelect.value : '';

                    if (!residentId || !roleId || !status) {
                        alert('Resident ID, Role, and Status are required.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('resident_id', residentId);
                    if (password) { // Only send password if user typed something (i.e., wants to change it)
                        formData.append('password', password);
                    }
                    formData.append('role_id', roleId);
                    formData.append('status', status);

                    fetch('updateAccount.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message || 'Account updated successfully!');
                            const bootstrapModal = bootstrap.Modal.getInstance(editAccountModal);
                            bootstrapModal.hide();
                            fetchAndDisplayAccounts(); // Refresh table
                        } else {
                            alert('Error updating account: ' + (data.message || 'Unknown error.'));
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error (update account):', error);
                        alert('An error occurred while updating the account. Please try again.');
                    });
                });
            }

            document.addEventListener('click', (event) => {
                if (searchResidentEditInput && searchResultsEditList && !searchResidentEditInput.contains(event.target) && !searchResultsEditList.contains(event.target)) {
                    searchResultsEditList.style.display = 'none';
                }
            });


            // --- Table Display and Action Buttons ---
            function fetchAndDisplayAccounts() {
                const tableBody = document.getElementById('tableBody');
                if (!tableBody) {
                    console.error("Table body with ID 'tableBody' not found.");
                    return;
                }

                tableBody.innerHTML = '<tr><td colspan="6" class="text-center">Loading accounts...</td></tr>';

                // Fetch from getAdminAccounts.php for administrator/staff accounts
                const fetchUrl = 'getAdminAccounts.php'; // This is specific to Administrator Accounts

                fetch(fetchUrl)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        tableBody.innerHTML = '';
                        allAccounts = []; // Clear previous data

                        if (data.success && data.data && data.data.length > 0) {
                            allAccounts = data.data; // Store the fetched data
                            data.data.forEach(account => {
                                const row = tableBody.insertRow();
                                row.innerHTML = `
                                    <td>${account.resident_id}</td>
                                    <td>${account.full_name}</td>
                                    <td>${account.role_name}</td>
                                    <td>${account.status}</td>
                                    <td>${account.last_modified}</td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; padding: 0;">
                                                <i class="material-icons" style="font-size: 24px; color: #6c757d;">more_horiz</i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="populateEditAccountModal('${account.resident_id}')">Edit</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="deleteAccount('${account.resident_id}', '${account.full_name}')">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                `;
                            });
                            window.filterTable(); // Apply any existing search filter after table is populated
                        } else {
                            const row = tableBody.insertRow();
                            row.innerHTML = `<td colspan="6" class="text-center">${data.message || 'No accounts found.'}</td>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching accounts for table:', error);
                        tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error loading accounts: ${error.message}</td></tr>`;
                    });
            }

            // Global Delete Account Function (called from table dropdown)
            window.deleteAccount = function(residentId, fullName) {
                if (confirm(`Are you sure you want to delete the account for ${fullName} (ID: ${residentId})? This action cannot be undone.`)) {
                    const formData = new FormData();
                    formData.append('resident_id', residentId);

                    fetch('deleteAccount.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message || 'Account deleted successfully!');
                            fetchAndDisplayAccounts(); // Refresh table
                        } else {
                            alert('Error deleting account: ' + (data.message || 'Unknown error.'));
                            console.error('Delete error:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error (delete account):', error);
                        alert('An error occurred while deleting the account. Please try again.');
                    });
                }
            };

            // Initial load of accounts
            fetchAndDisplayAccounts();

            // Attach event listener to the table search input using its class
            const tableSearchInput = document.querySelector('.search-input');
            if (tableSearchInput) {
                tableSearchInput.addEventListener('keyup', window.filterTable);
            }
        });
    </script>
</body>
</html>