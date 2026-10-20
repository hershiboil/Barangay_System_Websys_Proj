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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  

  <link rel="stylesheet" href="adminDashboard1.css">

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
        height: 87vh;
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
              <a href="adminDashboard.php"><i class="material-icons">dashboard</i><span>Dashboard
    </span></a>
          </li>
            
          <li class="dropdown">
            <a href="adminAnnouncement.php">
              <i class="material-icons">campaign</i>
              <span>Announcement</span>
            </a>
          </li>

          <li class="dropdown">
            <a href="#pageSubmenu1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">manage_accounts</i><span>Barangay Officials</span></a>

            <ul class="collapse list-unstyled menu" id="pageSubmenu1">
              
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
                <ul class="collapse list-unstyled menu" id="pageSubmenu2">

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
                <ul class="collapse list-unstyled menu" id="pageSubmenu3">

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
    
    <div class="main-content p-4" id="maincontent">
        <h2>Roles </h2>

        <!--Search bar-->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form class="m-0">
                <div class="search d-flex align-items-center">
                    <span class="search-icon material-icons me-2">search</span>
                    <input class="search-input form-control" type="search" placeholder="Search">
                </div>
            </form>
            <!--Create Position Button-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">+ Create Role</button>
        </div>
        <!-- Add new role modal -->
        <div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="role_name" class="form-label">Role Name</label>
                    <input type="text" class="form-control modal-input" id="role_name" name="role_name">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="role_description" class="form-label">Role Description</label>
                    <input type="text" class="form-control modal-input" id="role_description" name="role_description">
                  </div>
                </div>
                <div class="container">
                  <div class="row row-cols-1 row-cols-md-3">
                    <div class="col h-100">
                      <div class="border p-3 mb-3 rounded" style="min-height: 290px;">
                        <h5>Dashboard</h5>
                        <div class="form-check">
                          <input class="form-check-input permission-item-dashboard" type="checkbox" value="create_dashboard" id="dashboardCreate">
                          <label class="form-check-label" for="dashboardCreate">
                            Create
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-dashboard" type="checkbox" value="view_dashboard" id="dashboardView">
                          <label class="form-check-label" for="dashboardView">View</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-dashboard" type="checkbox" value="edit_dashboard" id="dashboardEdit">
                          <label class="form-check-label" for="dashboardEdit">Edit</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-dashboard" type="checkbox" value="delete_dashboard" id="dashboardDelete">
                          <label class="form-check-label" for="dashboardDelete">Delete
                          </label>
                        </div>
                        <div class="mt-auto pt-3 text-end">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input select-all-toggle" type="checkbox" id="DashboardSelectAll" data-target-group="dashboard-permissions">
                            <label class="form-check-label" for="DashboardSelectAll">Select All</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col h-100">
                      <div class="border p-3 mb-3 rounded" style="min-height: 290px;">
                        <h5>Announcement</h5>
                          <div class="form-check">
                          <input class="form-check-input permission-item-announcement" type="checkbox" value="create_announcement" id="announcementCreate">
                          <label class="form-check-label" for="announcementCreate">Create</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-announcement" type="checkbox" value="view_announcement" id="announcementView">
                          <label class="form-check-label" for="announcementView">View</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-announcement" type="checkbox" value="edit_announcement" id="announcementEdit">
                          <label class="form-check-label" for="announcementEdit">Edit</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input permission-item-announcement" type="checkbox" value="delete_announcement" id="announcementDelete">
                          <label class="form-check-label" for="announcementDelete">Delete</label>
                        </div>
                        <div class="mt-auto pt-3 text-end">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input select-all-toggle" type="checkbox" id="announcementSelectAll" data-target-group="announcement-permissions">
                          <label class="form-check-label" for="announcementSelectAll">Select All</label>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="col h-100">
                      <div class="border p-3 mb-3 rounded" style="min-height: 200px;">
                        <h5>Barangay Officials</h5>
                        <div class="row row-cols-1 row-cols-md-2">
                          <div class="col">
                            <div class="p-2 mb-2">
                              <h6>Current Officials</h6>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="create_currentOfficials" id="currentOfficialsCreate">
                                <label class="form-check-label" for="currentOfficialsCreate">Create</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="view_currentOfficials" id="currentOfficialsView">
                                <label class="form-check-label" for="currentOfficialsView">View</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="edit_currentOfficials" id="currentOfficialsEdit">
                                <label class="form-check-label" for="currentOfficialsEdit">Edit</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="delete_currentOfficials" id="currentOfficialsDelete">
                                <label class="form-check-label" for="currentOfficialsDelete">Delete</label>
                              </div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="p-2 mb-2">
                              <h6>Former Officials</h6>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="create_formerOfficials" id="formerOfficialsCreate">
                                <label class="form-check-label" for="formerOfficialsCreate">Create</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="view_formerOfficials" id="formerOfficialsView">
                                <label class="form-check-label" for="formerOfficialsView">View</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="edit_formerOfficials" id="formerOfficialsEdit">
                                <label class="form-check-label" for="formerOfficialsEdit">Edit</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="delete_formerOfficials" id="formerOfficialsDelete">
                                <label class="form-check-label" for="formerOfficialsDelete">Delete</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input permission-item-officials" type="checkbox" value="restore_formerOfficials" id="formerOfficialsRestore">
                                <label class="form-check-label" for="formerOfficialsRestore">Restore</label>
                              </div>
                              <div class="mt-auto pt-3 text-end">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input select-all-toggle" type="checkbox" id="officialsSelectAll" data-target-group="officials-permissions">
                                  <label class="form-check-label" for="officialsSelectAll">Select All</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row row-cols-1 row-cols-md-3 mt-3">
                    <div class="col h-100">
                      <div class="border p-3 mb-3 rounded " style="min-height: 280px;">
                        <h5>Residents</h5>
                        <div class="row row-cols-1 row-cols-md-2">
                          <div class="col">
                            <div class=" p-2 mb-2">
                              <h6>All Residents</h6>
                              <div class="form-check">
                                <input class="form-check-input permission-item-residents" type="checkbox" value="create_allResident" id="allResidentCreate">
                                <label class="form-check-label" for="allResidentCreate">Create</label>
                              </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="view_allResident" id="allResidentView">
                              <label class="form-check-label" for="allResidentView">View</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="edit_allResident" id="allResidentEdit">
                              <label class="form-check-label" for="allResidentEdit">Edit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="delete_allResident" id="allResidentDelete">
                              <label class="form-check-label" for="allResidentDelete">Delete</label>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Archived Residents</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="create_archivedResident" id="archivedResidentCreate">
                              <label class="form-check-label" for="archivedResidentCreate">Create</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="view_archivedResident" id="archivedResidentView">
                              <label class="form-check-label" for="archivedResidentView">View</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="restore_archivedResident" id="archivedResidentRestore">
                              <label class="form-check-label" for="archivedResidentRestore">Restore</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-residents" type="checkbox" value="delete_archivedResident" id="archivedResidentDelete">
                              <label class="form-check-label" for="archivedResidentDelete">Delete</label>
                            </div>
                            <div class="mt-auto pt-3 text-end">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input select-all-toggle" type="checkbox" id="residentSelectAll" data-target-group="residents-permissions">
                                <label class="form-check-label" for="residentSelectAll">Select All</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col h-100">
                    <div class="border p-3 mb-3 rounded" style="min-height: 280px;">
                      <h5>Users</h5>
                      <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Residents</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="create_residents" id="residentsCreate">
                              <label class="form-check-label" for="residentsCreate">Create</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="view_residents" id="residentsView">
                              <label class="form-check-label" for="residentsView">View</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="edit_residents" id="residentsEdit">
                              <label class="form-check-label" for="residentsEdit">Edit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="delete_residents" id="residentsDelete">
                              <label class="form-check-label" for="residentsDelete">Delete</label>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Administrator</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="create_admin" id="adminCreate">
                              <label class="form-check-label" for="adminCreate">Create</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="view_admin" id="adminView">
                              <label class="form-check-label" for="adminView">View</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="restore_admin" id="adminRestore">
                              <label class="form-check-label" for="adminRestore">Edit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input permission-item-users" type="checkbox" value="delete_admin" id="adminDelete">
                              <label class="form-check-label" for="adminDelete">Delete</label>
                            </div>
                            <div class="mt-auto pt-4 text-end">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input select-all-toggle" type="checkbox" id="usersSelectAll" data-target-group="users-permissions">
                                <label class="form-check-label" for="usersSelectAll">Select All</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col h-100">
                    <div class="border p-3 mb-3 rounded" style="min-height: 280px;">
                      <h5>Certificates</h5>
                      <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Indigency</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-certificates" type="checkbox" value="view_indigency" id="indigencyView">
                              <label class="form-check-label" for="indigencyView">View</label>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Residency</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-certificates" type="checkbox" value="view_residency" id="residencyView">
                              <label class="form-check-label" for="residencyView">View</label>
                            </div>
                          </div>
                        </div>
                         <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Clearance</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-certificates" type="checkbox" value="view_clearance" id="clearanceView">
                              <label class="form-check-label" for="clearanceView">View</label>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class=" p-2 mb-2">
                            <h6>Business Permit</h6>
                            <div class="form-check">
                              <input class="form-check-input permission-item-certificates" type="checkbox" value="view_business" id="businessView">
                              <label class="form-check-label" for="businessView">View</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mt-auto pt-3 text-end">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input select-all-toggle" type="checkbox" id="certificatesSelectAll" data-target-group="certificates-permissions">
                          <label class="form-check-label" for="certificatesSelectAll">Select All</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col h-100">
                    <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                      <h5>Roles and Permissions</h5>
                      <div class="form-check">
                        <input class="form-check-input permission-item-roles" type="checkbox" value="create_roles" id="rolesCreate">
                        <label class="form-check-label" for="rolesCreate">Create</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-roles" type="checkbox" value="view_roles" id="rolesView">
                        <label class="form-check-label" for="rolesView">View</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-roles" type="checkbox" value="restore_roles" id="rolesRestore">
                        <label class="form-check-label" for="rolesRestore">Edit</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-roles" type="checkbox" value="delete_roles" id="rolesDelete">
                        <label class="form-check-label" for="rolesDelete">Delete</label>
                      </div>
                      <div class="mt-auto pt-3 text-end permission-item-roles">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input select-all-toggle" type="checkbox" id="rolesSelectAll" data-target-group="roles-permissions">
                          <label class="form-check-label" for="rolesSelectAll">Select All</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col h-100">
                    <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                      <h5>Position</h5>
                      <div class="form-check">
                        <input class="form-check-input permission-item-position" type="checkbox" value="create_position" id="positionCreate">
                        <label class="form-check-label" for="positionCreate">Create</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-position" type="checkbox" value="view_position" id="positionView">
                        <label class="form-check-label" for="positionView">View</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-position" type="checkbox" value="restore_position" id="positionEdit">
                        <label class="form-check-label" for="positionRestore">Edit</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input permission-item-position" type="checkbox" value="delete_position" id="positionDelete">
                        <label class="form-check-label" for="positionDelete">Delete</label>
                      </div>
                      <div class="mt-auto pt-3 text-end">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input select-all-toggle" type="checkbox" id="positionSelectAll" data-target-group="position-permissions">
                          <label class="form-check-label" for="positionSelectAll">Select All</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col h-100">
                    <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                      <h5>Reports and Blotters</h5>
                      <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                          <h6>Reports</h6>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="create_reports" id="reportsCreate">
                            <label class="form-check-label" for="reportsCreate">Create</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="view_reports" id="reportsView">
                            <label class="form-check-label" for="reportsView">View</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="restore_reports" id="reportsRestore">
                            <label class="form-check-label" for="reportsRestore">Edit</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="delete_reports" id="reportsDelete">
                            <label class="form-check-label" for="reportsDelete">Delete</label>
                          </div>
                        </div>
                        <div class="col">
                          <h6>Blotter</h6>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="create_blotter" id="blotterCreate">
                            <label class="form-check-label" for="blotterCreate">Create</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="view_blotter" id="blotterView">
                            <label class="form-check-label" for="blotterView">View</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="restore_blotter" id="blotterRestore">
                            <label class="form-check-label" for="blotterRestore">Edit</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="delete_blotter" id="blotterDelete">
                            <label class="form-check-label" for="blotterDelete">Delete</label>
                          </div>
                          <div class="mt-auto pt-3 text-end">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input select-all-toggle" type="checkbox" id="reportsBlotterSelectAll" data-target-group="reportsBlotter-permissions">
                              <label class="form-check-label" for="reportsBlotterSelectAll">Select All</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3 mb-3 me-3">
              <button type="button" class="btn btn-outline-secondary me-2" id="cancelBtn" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
            </div>
          </div>
        </div>

      <!-- Edit Modal -->
      <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Role</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control modal-input" id="edit_role_name" name="edit_role_name">
                            <input type="hidden" id="edit_role_id" name="edit_role_id"> </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_role_description" class="form-label">Role Description</label>
                            <input type="text" class="form-control modal-input" id="edit_role_description" name="edit_role_description">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 290px;">
                                    <h5>Dashboard</h5>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-dashboard" type="checkbox" value="create_dashboard" id="dashboardCreateEdit">
                                        <label class="form-check-label" for="dashboardCreateEdit">
                                            Create
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-dashboard" type="checkbox" value="view_dashboard" id="dashboardViewEdit">
                                        <label class="form-check-label" for="dashboardViewEdit">View</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-dashboard" type="checkbox" value="edit_dashboard" id="dashboardEditEdit">
                                        <label class="form-check-label" for="dashboardEditEdit">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-dashboard" type="checkbox" value="delete_dashboard" id="dashboardDeleteEdit">
                                        <label class="form-check-label" for="dashboardDeleteEdit">Delete
                                        </label>
                                    </div>
                                    <div class="mt-auto pt-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select-all-toggle" type="checkbox" id="DashboardSelectAllEdit" data-target-group="dashboard-permissions">
                                            <label class="form-check-label" for="DashboardSelectAllEdit">Select All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 290px;">
                                    <h5>Announcement</h5>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-announcement" type="checkbox" value="create_announcement" id="announcementCreateEdit">
                                        <label class="form-check-label" for="announcementCreateEdit">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-announcement" type="checkbox" value="view_announcement" id="announcementViewEdit">
                                        <label class="form-check-label" for="announcementViewEdit">View</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-announcement" type="checkbox" value="edit_announcement" id="announcementEditEdit">
                                        <label class="form-check-label" for="announcementEditEdit">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-announcement" type="checkbox" value="delete_announcement" id="announcementDeleteEdit">
                                        <label class="form-check-label" for="announcementDeleteEdit">Delete</label>
                                    </div>
                                    <div class="mt-auto pt-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select-all-toggle" type="checkbox" id="announcementSelectAllEdit" data-target-group="announcement-permissions">
                                            <label class="form-check-label" for="announcementSelectAllEdit">Select All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 200px;">
                                    <h5>Barangay Officials</h5>
                                    <div class="row row-cols-1 row-cols-md-2">
                                        <div class="col">
                                            <div class="p-2 mb-2">
                                                <h6>Current Officials</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="create_currentOfficials" id="currentOfficialsCreateEdit">
                                                    <label class="form-check-label" for="currentOfficialsCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="view_currentOfficials" id="currentOfficialsViewEdit">
                                                    <label class="form-check-label" for="currentOfficialsViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="edit_currentOfficials" id="currentOfficialsEditEdit">
                                                    <label class="form-check-label" for="currentOfficialsEditEdit">Edit</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="delete_currentOfficials" id="currentOfficialsDeleteEdit">
                                                    <label class="form-check-label" for="currentOfficialsDeleteEdit">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-2 mb-2">
                                                <h6>Former Officials</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="create_formerOfficials" id="formerOfficialsCreateEdit">
                                                    <label class="form-check-label" for="formerOfficialsCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="view_formerOfficials" id="formerOfficialsViewEdit">
                                                    <label class="form-check-label" for="formerOfficialsViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="edit_formerOfficials" id="formerOfficialsEditEdit">
                                                    <label class="form-check-label" for="formerOfficialsEditEdit">Edit</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="delete_formerOfficials" id="formerOfficialsDeleteEdit">
                                                    <label class="form-check-label" for="formerOfficialsDeleteEdit">Delete</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-officials" type="checkbox" value="restore_formerOfficials" id="formerOfficialsRestoreEdit">
                                                    <label class="form-check-label" for="formerOfficialsRestoreEdit">Restore</label>
                                                </div>
                                                <div class="mt-auto pt-3 text-end">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input select-all-toggle" type="checkbox" id="officialsSelectAllEdit" data-target-group="officials-permissions">
                                                        <label class="form-check-label" for="officialsSelectAllEdit">Select All</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 mt-3">
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded " style="min-height: 280px;">
                                    <h5>Residents</h5>
                                    <div class="row row-cols-1 row-cols-md-2">
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>All Residents</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="create_allResident" id="allResidentCreateEdit">
                                                    <label class="form-check-label" for="allResidentCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="view_allResident" id="allResidentViewEdit">
                                                    <label class="form-check-label" for="allResidentViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="edit_allResident" id="allResidentEditEdit">
                                                    <label class="form-check-label" for="allResidentEditEdit">Edit</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="delete_allResident" id="allResidentDeleteEdit">
                                                    <label class="form-check-label" for="allResidentDeleteEdit">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Archived Residents</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="create_archivedResident" id="archivedResidentCreateEdit">
                                                    <label class="form-check-label" for="archivedResidentCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="view_archivedResident" id="archivedResidentViewEdit">
                                                    <label class="form-check-label" for="archivedResidentViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="restore_archivedResident" id="archivedResidentRestoreEdit">
                                                    <label class="form-check-label" for="archivedResidentRestoreEdit">Restore</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-residents" type="checkbox" value="delete_archivedResident" id="archivedResidentDeleteEdit">
                                                    <label class="form-check-label" for="archivedResidentDeleteEdit">Delete</label>
                                                </div>
                                                <div class="mt-auto pt-3 text-end">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input select-all-toggle" type="checkbox" id="residentSelectAllEdit" data-target-group="residents-permissions">
                                                        <label class="form-check-label" for="residentSelectAllEdit">Select All</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 280px;">
                                    <h5>Users</h5>
                                    <div class="row row-cols-1 row-cols-md-2">
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Residents</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="create_residents" id="residentsCreateEdit">
                                                    <label class="form-check-label" for="residentsCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="view_residents" id="residentsViewEdit">
                                                    <label class="form-check-label" for="residentsViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="edit_residents" id="residentsEditEdit">
                                                    <label class="form-check-label" for="residentsEditEdit">Edit</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="delete_residents" id="residentsDeleteEdit">
                                                    <label class="form-check-label" for="residentsDeleteEdit">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Administrator</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="create_admin" id="adminCreateEdit">
                                                    <label class="form-check-label" for="adminCreateEdit">Create</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="view_admin" id="adminViewEdit">
                                                    <label class="form-check-label" for="adminViewEdit">View</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="restore_admin" id="adminRestoreEdit">
                                                    <label class="form-check-label" for="adminRestoreEdit">Edit</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-users" type="checkbox" value="delete_admin" id="adminDeleteEdit">
                                                    <label class="form-check-label" for="adminDeleteEdit">Delete</label>
                                                </div>
                                                <div class="mt-auto pt-4 text-end">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input select-all-toggle" type="checkbox" id="usersSelectAllEdit" data-target-group="users-permissions">
                                                        <label class="form-check-label" for="usersSelectAllEdit">Select All</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 280px;">
                                    <h5>Certificates</h5>
                                    <div class="row row-cols-1 row-cols-md-2">
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Indigency</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-certificates" type="checkbox" value="view_indigency" id="indigencyViewEdit">
                                                    <label class="form-check-label" for="indigencyViewEdit">View</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Residency</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-certificates" type="checkbox" value="view_residency" id="residencyViewEdit">
                                                    <label class="form-check-label" for="residencyViewEdit">View</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Clearance</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-certificates" type="checkbox" value="view_clearance" id="clearanceViewEdit">
                                                    <label class="form-check-label" for="clearanceViewEdit">View</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" p-2 mb-2">
                                                <h6>Business Permit</h6>
                                                <div class="form-check">
                                                    <input class="form-check-input permission-item-certificates" type="checkbox" value="view_business" id="businessViewEdit">
                                                    <label class="form-check-label" for="businessViewEdit">View</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto pt-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select-all-toggle" type="checkbox" id="certificatesSelectAllEdit" data-target-group="certificates-permissions">
                                            <label class="form-check-label" for="certificatesSelectAllEdit">Select All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                                    <h5>Roles and Permissions</h5>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-roles" type="checkbox" value="create_roles" id="rolesCreateEdit">
                                        <label class="form-check-label" for="rolesCreateEdit">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-roles" type="checkbox" value="view_roles" id="rolesViewEdit">
                                        <label class="form-check-label" for="rolesViewEdit">View</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-roles" type="checkbox" value="restore_roles" id="rolesRestoreEdit">
                                        <label class="form-check-label" for="rolesRestoreEdit">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-roles" type="checkbox" value="delete_roles" id="rolesDeleteEdit">
                                        <label class="form-check-label" for="rolesDeleteEdit">Delete</label>
                                    </div>
                                    <div class="mt-auto pt-3 text-end permission-item-roles">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select-all-toggle" type="checkbox" id="rolesSelectAllEdit" data-target-group="roles-permissions">
                                            <label class="form-check-label" for="rolesSelectAllEdit">Select All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                                    <h5>Position</h5>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-position" type="checkbox" value="create_position" id="positionCreateEdit">
                                        <label class="form-check-label" for="positionCreateEdit">Create</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-position" type="checkbox" value="view_position" id="positionViewEdit">
                                        <label class="form-check-label" for="positionViewEdit">View</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-position" type="checkbox" value="restore_position" id="positionEditEdit">
                                        <label class="form-check-label" for="positionEditEdit">Edit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input permission-item-position" type="checkbox" value="delete_position" id="positionDeleteEdit">
                                        <label class="form-check-label" for="positionDeleteEdit">Delete</label>
                                    </div>
                                    <div class="mt-auto pt-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input select-all-toggle" type="checkbox" id="positionSelectAllEdit" data-target-group="position-permissions">
                                            <label class="form-check-label" for="positionSelectAllEdit">Select All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="border p-3 mb-3 rounded" style="min-height: 240px;">
                                    <h5>Reports and Blotters</h5>
                                    <div class="row row-cols-1 row-cols-md-2">
                                        <div class="col">
                                            <h6>Reports</h6>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="create_reports" id="reportsCreateEdit">
                                                <label class="form-check-label" for="reportsCreateEdit">Create</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="view_reports" id="reportsViewEdit">
                                                <label class="form-check-label" for="reportsViewEdit">View</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="restore_reports" id="reportsRestoreEdit">
                                                <label class="form-check-label" for="reportsRestoreEdit">Edit</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="delete_reports" id="reportsDeleteEdit">
                                                <label class="form-check-label" for="reportsDeleteEdit">Delete</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6>Blotter</h6>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="create_blotter" id="blotterCreateEdit">
                                                <label class="form-check-label" for="blotterCreateEdit">Create</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="view_blotter" id="blotterViewEdit">
                                                <label class="form-check-label" for="blotterViewEdit">View</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="restore_blotter" id="blotterRestoreEdit">
                                                <label class="form-check-label" for="blotterRestoreEdit">Edit</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input permission-item-reportsBlotter" type="checkbox" value="delete_blotter" id="blotterDeleteEdit">
                                                <label class="form-check-label" for="blotterDeleteEdit">Delete</label>
                                            </div>
                                            <div class="mt-auto pt-3 text-end">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input select-all-toggle" type="checkbox" id="reportsBlotterSelectAllEdit" data-target-group="reportsBlotter-permissions">
                                                    <label class="form-check-label" for="reportsBlotterSelectAllEdit">Select All</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3 mb-3 me-3">
                    <button type="button" class="btn btn-outline-secondary me-2" id="editCancelBtn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="editSaveBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

      </div>
    </div>

    <table class="table table-borderless table-rounded">
      <thead>
        <tr class="table-primary">
          <th scope="col" style="width: 200px;">Role Name</th>
          <th scope="col" style="width: 300px;">Description</th>
          <th scope="col" style="width: 200px;">Last Modified</th>
          <th scope="col" style="width: 80px;">Action</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>
</div>
      
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const topnavbar = document.getElementById('topnavbar');
    const maincontent = document.getElementById('maincontent');
    const sidebarToggleContainer = document.getElementById('sidebarToggleContainer');
    const toggleButton = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    function updateTogglePosition() {
        const isMobile = window.innerWidth <= 991;
        if (isMobile) {
            if (sidebar && sidebar.classList.contains('active')) {
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
            if (sidebar && sidebar.classList.contains('sidebar-collapsed')) {
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

    if (toggleButton && sidebar && toggleIcon) {
        toggleButton.addEventListener('click', () => {
            const isMobile = window.innerWidth <= 991;
            if (isMobile) {
                sidebar.classList.toggle('active');
            } else {
                sidebar.classList.toggle('sidebar-collapsed');
            }
            updateTogglePosition();
            toggleIcon.innerText = sidebar.classList.contains('sidebar-collapsed') || (window.innerWidth <= 991 && !sidebar.classList.contains('active')) ? 'chevron_right' : 'chevron_left';
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
            if (parent) {
                parent.classList.toggle('open');
            }
        });
    });

    updateTogglePosition();

    const notificationToggle = document.getElementById('notificationToggle');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const profileToggle = document.getElementById('profileToggleBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    function closeAllDropdowns() {
        if (notificationDropdown) notificationDropdown.classList.remove('show');
        if (profileDropdown) profileDropdown.classList.remove('show');
    }

    if (notificationToggle) {
        notificationToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const isShown = notificationDropdown.classList.contains('show');
            closeAllDropdowns();
            if (!isShown) {
                notificationDropdown.classList.add('show');
            }
        });
    }

    if (profileToggle) {
        profileToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const isShown = profileDropdown.classList.contains('show');
            closeAllDropdowns();
            if (!isShown) {
                profileDropdown.classList.add('show');
            }
        });
    }

    document.addEventListener('click', (event) => {
        const isClickInsideNotification = notificationToggle && notificationToggle.contains(event.target) || notificationDropdown && notificationDropdown.contains(event.target);
        const isClickInsideProfile = profileToggle && profileToggle.contains(event.target) || profileDropdown && profileDropdown.contains(event.target);

        if (!isClickInsideNotification && !isClickInsideProfile) {
            closeAllDropdowns();
        }
    });

    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        const currentDateTimeElement = document.getElementById('currentDateTime');
        if (currentDateTimeElement) {
            currentDateTimeElement.textContent = now.toLocaleString('en-US', options);
        }
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);

    const profileInput = document.getElementById('profileInput');
    const profilePreview = document.getElementById('profilePreview');

    if (profileInput && profilePreview) {
        profileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
        });
    });

    document.querySelectorAll('.select-all-toggle').forEach(function(selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const parentBox = this.closest('.border');
            if (parentBox) {
                const individualCheckboxesInGroup = parentBox.querySelectorAll('.form-check-input[class*="permission-item-"]');
                individualCheckboxesInGroup.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            }
        });
    });

    document.querySelectorAll('.border .form-check-input[class*="permission-item-"]').forEach(function(individualCheckbox) {
        individualCheckbox.addEventListener('change', function() {
            const parentBox = this.closest('.border');
            if (parentBox) {
                const individualCheckboxesInGroup = parentBox.querySelectorAll('.form-check-input[class*="permission-item-"]');
                const selectAllCheckbox = parentBox.querySelector('.select-all-toggle');

                if (selectAllCheckbox) {
                    const allChecked = Array.from(individualCheckboxesInGroup).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                }
            }
        });
    });

    const createRoleModal = document.getElementById('createRole');

    createRoleModal.addEventListener('hidden.bs.modal', function() {
        const roleNameInput = document.getElementById('role_name');
        if (roleNameInput) {
            roleNameInput.value = '';
        }

        const roleDescriptionInput = document.getElementById('role_description');
        if (roleDescriptionInput) {
            roleDescriptionInput.value = '';
        }

        const allCheckboxes = createRoleModal.querySelectorAll('input[type="checkbox"]');
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        const selectAllToggles = createRoleModal.querySelectorAll('.select-all-toggle');
        selectAllToggles.forEach(toggle => {
            toggle.checked = false;
        });
    });

    const saveButton = document.getElementById('saveBtn');
    if (saveButton) {
        saveButton.addEventListener('click', function() {
            const roleNameInput = document.getElementById('role_name');
            const roleDescriptionInput = document.getElementById('role_description');
            const roleName = roleNameInput ? roleNameInput.value.trim() : '';
            const roleDescription = roleDescriptionInput ? roleDescriptionInput.value.trim() : '';
            const permissions = Array.from(document.querySelectorAll('#createRole .modal-body input[type="checkbox"]:checked:not(.select-all-toggle)'))
                .map(checkbox => checkbox.value);
            console.log("Permissions being sent:", permissions);

            if (!roleName) {
                alert("Please enter a role name.");
                return;
            }

            const formData = new FormData();
            formData.append('role_name', roleName);
            formData.append('role_description', roleDescription);
            formData.append('permissions', JSON.stringify(permissions));

            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            fetch('saveRoles.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message || 'Role added successfully!');

                        const bootstrapModal = bootstrap.Modal.getInstance(createRoleModal);
                        if (bootstrapModal) {
                            bootstrapModal.hide();
                        } else {
                            createRoleModal.classList.remove('show');
                            createRoleModal.setAttribute('aria-hidden', 'true');
                            createRoleModal.style.display = 'none';
                            document.body.classList.remove('modal-open');
                            document.body.style.overflow = '';
                        }

                        fetchRoles();

                    } else {
                        alert('Error saving role: ' + (data.message || 'Unknown error.'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('An error occurred while saving the role. Please try again.');
                })
                .finally(() => {
                    saveButton.disabled = false;
                    saveButton.textContent = 'Save';
                });
        });
    }

    const editRoleModal = document.getElementById('editRoleModal');
    const editRoleIdInput = document.getElementById('edit_role_id');
    const editRoleNameInput = document.getElementById('edit_role_name');
    const editRoleDescriptionInput = document.getElementById('edit_role_description');
    const editSaveBtn = document.getElementById('editSaveBtn');

    if (editSaveBtn) {
        editSaveBtn.addEventListener('click', saveEditedRole);
    }

    function handleEditRole(roleId, roleName, roleDescription) {
        if (editRoleModal && editRoleIdInput && editRoleNameInput && editRoleDescriptionInput) {
            editRoleModal.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            editRoleModal.querySelectorAll('.select-all-toggle').forEach(cb => cb.checked = false);

            editRoleIdInput.value = roleId;
            editRoleNameInput.value = roleName;
            editRoleDescriptionInput.value = roleDescription;

            console.log("roleId being sent to getPermissions.php:", roleId);

            fetch(`getPermissions.php?role_id=${roleId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success' && data.permissions) {
                        data.permissions.forEach(permission => {
                            const checkbox = editRoleModal.querySelector(`input[type="checkbox"][value="${permission}"]`);
                            if (checkbox) {
                                checkbox.checked = true;
                            } else {
                                console.warn(`Checkbox for permission "${permission}" not found in edit modal.`);
                            }
                        });

                        editRoleModal.querySelectorAll('.select-all-toggle').forEach(function(selectAllCheckbox) {
                            const parentBox = selectAllCheckbox.closest('.border');
                            if (parentBox) {
                                const individualCheckboxesInGroup = parentBox.querySelectorAll('.form-check-input[class*="permission-item-"]:not(.select-all-toggle)');
                                const allChecked = Array.from(individualCheckboxesInGroup).every(cb => cb.checked);
                                selectAllCheckbox.checked = allChecked;
                            }
                        });

                    } else {
                        console.error('Error fetching permissions:', data.message || 'Unknown error.');
                        alert('Could not load permissions for this role.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error during permissions retrieval:', error);
                    alert('An error occurred while loading role permissions. Please try again.');
                })
                .finally(() => {
                    const bootstrapEditModal = new bootstrap.Modal(editRoleModal);
                    bootstrapEditModal.show();
                });

        } else {
            console.error("Edit modal elements not found. Check IDs and HTML structure. Ensure 'editRoleModal', 'edit_role_id', 'edit_role_name', 'edit_role_description' exist.");
            alert("Error: Edit functionality not fully set up. Missing modal elements. Please check console for details.");
        }
    }

    function handleDeleteRole(roleId, roleName) {
        if (confirm(`Are you sure you want to delete the role "${roleName}"? This action cannot be undone.`)) {
            fetch('deleteRole.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        role_id: roleId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message || 'Role deleted successfully!');
                        fetchRoles();
                    } else {
                        alert('Error deleting role: ' + (data.message || 'Unknown error.'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('An error occurred while deleting the role. Please try again.');
                });
        }
    }

    function saveEditedRole() {
        const roleId = editRoleIdInput.value;
        const roleName = editRoleNameInput.value.trim();
        const roleDescription = editRoleDescriptionInput.value.trim();

        if (!roleName) {
            alert('Role Name is required.');
            return;
        }

        const formData = new FormData();
        formData.append('role_id', roleId);
        formData.append('role_name', roleName);
        formData.append('role_description', roleDescription);

        editSaveBtn.disabled = true;
        editSaveBtn.textContent = 'Saving...';

        fetch('editRole.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message || 'Role updated successfully!');
                    const bootstrapEditModal = bootstrap.Modal.getInstance(editRoleModal);
                    if (bootstrapEditModal) {
                        bootstrapEditModal.hide();
                    }
                    fetchRoles();
                } else {
                    alert('Error updating role: ' + (data.message || 'Unknown error.'));
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An error occurred while updating the role. Please try again.');
            })
            .finally(() => {
                editSaveBtn.disabled = false;
                editSaveBtn.textContent = 'Save Changes';
            });
    }

    function fetchRoles() {
        const tableBody = document.getElementById('tableBody');
        if (tableBody) {
            fetch('getRoles.php')
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = '';
                    if (data.success && data.data) {
                        data.data.forEach(role => {
                            const row = tableBody.insertRow();

                            const nameCell = row.insertCell();
                            nameCell.textContent = role.role_name;

                            const descriptionCell = row.insertCell();
                            descriptionCell.textContent = role.description;

                            const modifiedCell = row.insertCell();
                            modifiedCell.textContent = role.last_modified;

                            const actionCell = row.insertCell();
                            actionCell.classList.add('text-center');

                            const dropdownDiv = document.createElement('div');
                            dropdownDiv.classList.add('dropdown');

                            const dropdownButton = document.createElement('button');
                            dropdownButton.classList.add('btn', 'btn-light', 'btn-sm', 'dropdown-toggle');
                            dropdownButton.type = 'button';
                            dropdownButton.id = `dropdownMenuButton_${role.role_id}`;
                            dropdownButton.setAttribute('data-bs-toggle', 'dropdown');
                            dropdownButton.setAttribute('aria-expanded', 'false');

                            const iconSpan = document.createElement('span');
                            iconSpan.classList.add('material-icons-outlined');
                            iconSpan.textContent = 'more_horiz';
                            dropdownButton.appendChild(iconSpan);

                            const dropdownMenu = document.createElement('ul');
                            dropdownMenu.classList.add('dropdown-menu');
                            dropdownMenu.setAttribute('aria-labelledby', `dropdownMenuButton_${role.role_id}`);

                            const editItem = document.createElement('li');
                            const editLink = document.createElement('a');
                            editLink.classList.add('dropdown-item');
                            editLink.href = '#';
                            editLink.textContent = 'Edit';
                            editLink.addEventListener('click', () => {
                                handleEditRole(role.role_id, role.role_name, role.description);
                            });
                            editItem.appendChild(editLink);

                            const deleteItem = document.createElement('li');
                            const deleteLink = document.createElement('a');
                            deleteLink.classList.add('dropdown-item', 'text-danger');
                            deleteLink.href = '#';
                            deleteLink.textContent = 'Delete';
                            deleteLink.addEventListener('click', () => {
                                handleDeleteRole(role.role_id, role.role_name);
                            });
                            deleteItem.appendChild(deleteLink);

                            dropdownMenu.appendChild(editItem);
                            dropdownMenu.appendChild(deleteItem);

                            dropdownDiv.appendChild(dropdownButton);
                            dropdownDiv.appendChild(dropdownMenu);

                            actionCell.appendChild(dropdownDiv);
                        });
                    } else if (data.error) {
                        console.error('Error fetching roles:', data.error);
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center">Error loading roles.</td></tr>';
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center">No roles found.</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    tableBody.innerHTML = '<tr><td colspan="4" class="text-center">Failed to connect to the server.</td></tr>';
                });
        }
    }

    fetchRoles();
});
</script>
  
  
</body>
</html>
