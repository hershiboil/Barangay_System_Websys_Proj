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
            <p>Balinad Daraga, Albay</p>
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
                  <a href="adminListOfOfficials.php">
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
               <a href="#" class="nav-link position-relative" id="notificationToggle">
                <span class="material-icons">notifications</span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                      id="notificationCount" style="font-size: 0.7rem; display: none;">
                  0
                </span>
              </a>
            <ul class="dropdown-menu dropdown-menu-end position-absolute"
              id="notificationDropdown"
              style="width: 300px; max-height: 400px; overflow-y: auto; overflow-x: hidden;">
              
              <?php
                // Database connection for messages
                $host = 'localhost';
                $user = 'root';
                $pass = '';
                $db   = 'barangay_db';  

                $conn = new mysqli($host, $user, $pass, $db);
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                // Fetch messages
                $sqlMessages = "SELECT name, email, subject, message, date_sent, 'message' AS source_type FROM messages_entry ORDER BY date_sent DESC";
                $resultMessages = $conn->query($sqlMessages);

                $connComplaints = new mysqli($host, $user, $pass, $db);
                if ($connComplaints->connect_error) {
                  die("Connection failed: " . $connComplaints->connect_error);
                }

                // Fetch complaints
                $sqlComplaints = "SELECT id, type, description, created_at, 'complaint' AS source_type FROM complaints_entry ORDER BY created_at DESC";
                $resultComplaints = $connComplaints->query($sqlComplaints);

                $connRequests = new mysqli($host, $user, $pass, $db);
                if ($connRequests->connect_error) {
                  die("Connection failed: " . $connRequests->connect_error);
                }

                // Fetch requests
                $sqlRequests = 
                "SELECT 
                  fr.id,
                  fr.request_type, 
                  fr.request_date, 
                  ri.first_name, 
                  ri.middle_name, 
                  ri.last_name,
                  'request' AS source_type
                FROM file_requests fr
                JOIN residents_info ri ON fr.resident_ID = ri.resident_ID
                ORDER BY fr.request_date DESC";
                $resultRequests = $connRequests->query($sqlRequests);

                // Merge messages, complaints, and requests into notifications array
                $notifications = [];

                // Add messages to the notifications array
                if ($resultMessages->num_rows > 0) {
                  while ($row = $resultMessages->fetch_assoc()) {
                    $notifications[] = $row;
                  }
                }

                // Add complaints to the notifications array
                if ($resultComplaints->num_rows > 0) {
                  while ($row = $resultComplaints->fetch_assoc()) {
                    $notifications[] = $row;
                  }
                }

                // Add requests to the notifications array
                if ($resultRequests->num_rows > 0) {
                  while ($row = $resultRequests->fetch_assoc()) {
                    $notifications[] = $row;
                  }
                }

                // Sort the notifications by date (most recent first)
                usort($notifications, function ($a, $b) {
                  $dateA = ($a['source_type'] == 'message') ? $a['date_sent'] : ($a['source_type'] == 'complaint' ? $a['created_at'] : $a['request_date']);
                  $dateB = ($b['source_type'] == 'message') ? $b['date_sent'] : ($b['source_type'] == 'complaint' ? $b['created_at'] : $b['request_date']);
                  return strtotime($dateB) - strtotime($dateA);
                });

                // Display the notifications
                foreach ($notifications as $notification) {
                  if ($notification['source_type'] == 'message') {
                    $preview = substr($notification['message'], 0, 50);
                    if (strlen($notification['message']) > 50) $preview .= '...';
                    echo '<a href="view_message.php?name=' . urlencode($notification['name']) . '&email=' . urlencode($notification['email']) . '&subject=' . urlencode($notification['subject']) . '&message=' . urlencode($notification['message']) . '&date=' . urlencode($notification['date_sent']) . '" style="text-decoration: none; color: inherit;">
                            <div class="notification-item" style="padding: 12px; border-bottom: 1px solid #eee;">
                                <div style="display: flex; align-items: flex-start;">
                                    <div style="background-color: #fff3cd; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 12px;">📩</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: bold; font-size: 14px;">Message from: ' . htmlspecialchars($notification['name']) . '</div>
                                        <div style="font-weight: bold; font-size: 12px; color: #888;">Suject: ' . htmlspecialchars($notification['subject']). '</div>
                                        <div style="font-weight: bold; font-size: 12px; color:cornflowerblue;">' . htmlspecialchars($preview) . '</div>
                                        <div style="font-size: 12px; color: #888; margin-top: 4px;">' . date("M d, Y | H:i", strtotime($notification['date_sent'])) . '</div>
                                    </div>
                                </div>
                            </div>
                          </a>';
                  } elseif ($notification['source_type'] == 'complaint') {
                    $complaintPreview = substr($notification['description'], 0, 50);
                    if (strlen($notification['description']) > 50) $complaintPreview .= '...';
                    echo '<a href="view_complaints.php?id=' . $notification['id'] . '" style="text-decoration: none; color: inherit;">
                            <div class="notification-item" style="padding: 12px; border-bottom: 1px solid #eee;">
                                <div style="display: flex; align-items: flex-start;">
                                    <div style="background-color: #d4edda; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 12px;">⚠️</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: bold; font-size: 14px;">Complaint: ' . htmlspecialchars($notification['type']) . '</div>
                                        <div style="font-weight: bold; font-size: 13px; color: cornflowerblue;">' . htmlspecialchars(strip_tags($complaintPreview)) . '</div>    
                                        <div style="font-size: 12px; color: #888; margin-top: 4px;">' . date("M d, Y | H:i", strtotime($notification['created_at'])) . '</div>
                                    </div>
                                </div>
                            </div>
                          </a>';
                  } elseif ($notification['source_type'] == 'request') {
                    $requestPreview = substr($notification['request_type'], 0, 50);
                    if (strlen($notification['request_type']) > 50) $requestPreview .= '...';
                  

                      $firstName = $notification['first_name'];
                      $middleInitial = $notification['middle_name'] ? strtoupper(substr($notification['middle_name'], 0, 1)) . '.' : '';
                      $lastName = $notification['last_name'];
                      $fullName = htmlspecialchars("$firstName $middleInitial $lastName");

                    $requestType = strtolower($notification['request_type']);

                    if ($requestType == 'residency') {
                        $link = 'adminResidency.php?id=' . $notification['id'];
                    } elseif ($requestType == 'indigency') {
                        $link = 'adminIndigency.php?id=' . $notification['id'];
                    } elseif ($requestType == 'clearance') {
                        $link = 'adminClearance.php?id=' . $notification['id'];
                    } elseif ($requestType == 'businesspermit') {
                        $link = 'adminBusinessPermit.php?id=' . $notification['id'];
                    } else {
                        // If no matching type, skip rendering
                        return;
                    }

                    echo '<a href="' . $link . '" style="text-decoration: none; color: inherit;">
                            <div class="notification-item" style="padding: 12px; border-bottom: 1px solid #eee;">
                                <div style="display: flex; align-items: flex-start;">
                                    <div style="background-color: #cce5ff; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 12px;">📄</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: bold; font-size: 14px;">' . $fullName . '</div>
                                        <div style="font-weight: bold; font-size: 12px; color: green;">Requested: ' . htmlspecialchars($notification['request_type']) . '</div>
                                        <div style="font-size: 12px; color: #888; margin-top: 4px;">' . date("M d, Y | H:i", strtotime($notification['request_date'])) . '</div>
                                    </div>
                                </div>
                            </div>
                          </a>';
                }
              }

                // Close database connections
                $conn->close();
                $connComplaints->close();
                $connRequests->close();
                ?>

            </ul>
          </li>

                  
               <li class="nav-item dropdown position-relative">
                  <a class="nav-link d-flex align-items-center" href="#"
                   id="profileToggle">
                    <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="width:50px; height: 50px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
                    <span class="xp-user-live ms-1"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end small-menu position-absolute" id="profileDropdown">
                    <li><a class="dropdown-item" href="3" data-page="3"><span class="material-icons me-2">person_outline</span>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-icons me-2">settings</span>Settings</a></li>
                    <li><a class="dropdown-item" href="frontpage.php" data-page="frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
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
        <h2>Position List</h2>

        <!--Search bar-->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form class="m-0">
                <div class="search d-flex align-items-center">
                    <span class="search-icon material-icons me-2">search</span>
                    <input class="search-input form-control" type="search" placeholder="Search">
                </div>
            </form>
            <!--Create Position Button-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPosition">+ Create Position</button>
        </div>

        <!--Position Modal-->
        <div class="modal fade" id="createPosition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Position</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="positionTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="positionTitle">
                        </div>
                                
                        <div class="mb-3">
                            <label for="positionLimit" class="form-label">Limit</label>
                            <input type="number" class="form-control" id="positionLimit">
                        </div>
                                
                        <div class="mb-3">
                            <label for="positionDescription" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="positionDescription" rows="5" style="height: 150px;"></textarea>
                        </div>
                                
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" id="cancelBtn" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>             
                    </div> 
                </div>
            </div>
        </div>

        <!--Position Table-->
        <table class="table table-borderless table-rounded">
            <thead>
              <tr class="table-primary">
                <th scope="col" style="width: 200px;">Position</th>
                <th scope="col" style="width: 100px;">Limit</th>
                <th scope="col" style="width: 300px;">Description</th>
                <th scope="col" style="width: 200px;">Last Modified</th>
                <th scope="col" style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
        
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId">
                      <div class="mb-3">
                      <label for="editName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                      <label for="editLimit" class="form-label">Limit</label>
                      <input type="number" class="form-control" id="editLimit" required>
                    </div>
                    <div class="mb-3">
                      <label for="editDescription" class="form-label">Description</label>
                      <textarea class="form-control" id="editDescription" rows="3"></textarea>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" id="saveEditBtn" class="btn btn-primary">Save Changes</button>
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
    const toggleButton = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    // Function to update toggle button position based on sidebar state
    function updateTogglePosition() {
        const isMobile = window.innerWidth <= 991;

        if (isMobile) {
            if (sidebar.classList.contains('active')) {
                sidebarToggleContainer.style.left = '234px';
                toggleButton.style.left = '239px';
                sidebarToggleContainer.style.background = '#ebebeb';
            } else {
                topnavbar.style.margin = '14px 10px 0px 40px';
                maincontent.style.margin = '14px 10px 0px 40px';
                toggleButton.style.left = '75px';
                sidebarToggleContainer.style.left = '71px';
                sidebarToggleContainer.style.background = '#0077f7';
            }
        } else {
            if (sidebar.classList.contains('sidebar-collapsed')) {
                topnavbar.style.margin = '14px 10px 0px 120px';
                maincontent.style.margin = '14px 10px 0px 120px';
                sidebarToggleContainer.style.left = '71px';
                sidebarToggleContainer.style.background = '#0077f7';
                toggleButton.style.left = '75px';
            } else {
                topnavbar.style.margin = '14px 10px 0px 285px';
                maincontent.style.margin = '14px 10px 0px 285px';
                sidebarToggleContainer.style.left = '234px';
                sidebarToggleContainer.style.background = '#ebebeb';
                toggleButton.style.left = '239px';
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
            sidebar.classList.remove('active');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            content.classList.remove('sidebar-collapsed');
        }
        toggleIcon.innerText = 'chevron_left';
        updateTogglePosition();
    });

    // Sidebar dropdowns functionality
    document.addEventListener('DOMContentLoaded', () => {
        const dropdowns = document.querySelectorAll('#sidebar .dropdown-toggle');
        dropdowns.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = toggle.closest('.dropdown');
                parent.classList.toggle('open');
            });
        });

        updateTogglePosition();
    });

    // Update current date and time
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'short', year: 'numeric', month: 'short',
            day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleString('en-US', options);
    }

    // Initial load and update every second
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Save position event
    document.getElementById("saveBtn").addEventListener("click", function () {
      const title = document.getElementById("positionTitle").value.trim();
      const limit = document.getElementById("positionLimit").value.trim();
      const description = document.getElementById("positionDescription").value.trim();

      if (!title || !limit) {
          alert("Title and Limit fields are required.");
          return;
      }

      fetch("addPosition.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `title=${encodeURIComponent(title)}&limit=${encodeURIComponent(limit)}&description=${encodeURIComponent(description)}`
      })
      .then(response => response.text())
      .then(data => {
          if (data === "success") {
              // Clear the input fields
              document.getElementById("positionTitle").value = "";
              document.getElementById("positionLimit").value = "";
              document.getElementById("positionDescription").value = "";

              // Reload the table
              loadTableData();

              // Optionally close modal
              const modal = bootstrap.Modal.getInstance(document.getElementById("createPosition"));
              modal.hide();
          } else {
              alert("Failed to add position: " + data); // Shows error from PHP
          }
      })
      .catch(error => {
          alert("Error: " + error);
      });
    });

    // Load table data
    function loadTableData() {
        fetch("getPosition.php")
            .then(res => res.json())
            .then(data => {
                const tableBody = document.getElementById("tableBody");
                tableBody.innerHTML = ""; // Clear previous data

                data.forEach(pos => {
                    const row = document.createElement("tr");

                    row.innerHTML = `
                      <td>${pos.title}</td>
                      <td>${pos.pos_limit}</td>
                      <td>${pos.description}</td>
                      <td>${new Date(pos.last_modified).toLocaleString()}</td>
                      <td>
                          <div class="dropdown">
                              <button class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                                  <span class="material-icons">more_horiz</span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li>
                                      <a class="dropdown-item" href="#" onclick="editPosition(${pos.id}, '${pos.title}', ${pos.pos_limit}, '${pos.description}')">
                                          Edit
                                      </a>
                                  </li>
                                  <li>
                                      <a class="dropdown-item" href="#" onclick="deletePosition(${pos.id})">Delete</a>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </td>
                  `;


                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Failed to load table data.");
            });
    }

    // Store the ID to be edited globally
    let currentEditId = null;

    // Called when clicking Edit button
    function editPosition(id, title, limit, description) {
        document.getElementById("editId").value = id;
        document.getElementById("editName").value = title;
        document.getElementById("editLimit").value = limit;
        document.getElementById("editDescription").value = description;

        const modal = new bootstrap.Modal(document.getElementById("editModal"));
        modal.show();
    }


    // When Save button is clicked inside modal
    document.getElementById("saveEditBtn").addEventListener("click", () => {
        const id = document.getElementById("editId").value;
        const newTitle = document.getElementById("editName").value.trim();
        const newLimit = document.getElementById("editLimit").value;
        const newDesc = document.getElementById("editDescription").value.trim();

        if (!newTitle || !newLimit) {
            alert("Please fill in the required fields.");
            return;
        }

        fetch("editPosition.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${id}&title=${encodeURIComponent(newTitle)}&limit=${encodeURIComponent(newLimit)}&description=${encodeURIComponent(newDesc)}`
        })
        .then(res => res.text())
        .then(data => {
            if (data === "success") {
                bootstrap.Modal.getInstance(document.getElementById("editModal")).hide();
                loadTableData();
            } else {
                alert("Update failed.");
            }
        });
    });


    // Called when clicking Delete button
    function deletePosition(id) {
        document.getElementById("deleteId").value = id;
        const modal = new bootstrap.Modal(document.getElementById("deleteModal"));
        modal.show();
    }

    // When Confirm Delete button is clicked
    document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
        const id = document.getElementById("deleteId").value;

        fetch("deletePosition.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${id}`
        })
        .then(res => res.text())
        .then(data => {
            if (data === "success") {
                bootstrap.Modal.getInstance(document.getElementById("deleteModal")).hide();
                loadTableData();
            } else {
                alert("Delete failed.");
            }
        });
    });

    // Load table data on page load
    window.onload = loadTableData;

</script>
