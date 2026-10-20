<?php
  include 'connection.php';

  // Fetch resident data
  $sql = "SELECT
            resident_ID,
            first_name,
            middle_name,
            last_name,
            suffix,
            nick_name,
            birthdate,
            birthplace,
            age,
            gender,
            blood_type,
            occupation,
            civil_status,
            nationality,
            religion,
            contact_number,
            email,
            province,
            municipality,
            zip_code,
            barangay,
            purok,
            street,
            father_name,
            father_contact,
            mother_name,
            mother_contact,
            spouse_name,
            spouse_contact,
            guardian_name,
            guardian_relation,
            guardian_contact,
            national_ID_num,
            sss_num,
            tin_num,
            gsis_num,
            pagibig_num,
            philhealth_num,
            resident_status,
            voter,
            pwd,
            senior_citizen,
            solo_parent,
            is_4ps
        FROM residents_info";
  $result = $conn->query($sql);  // Store the resident data result in a separate variable

  // Fetch next auto-increment value
  $query = "SHOW TABLE STATUS LIKE 'residents_info'";
  $statusResult = $conn->query($query);  // Store the auto-increment value result in a separate variable
  $statusRow = $statusResult->fetch_assoc();
  $nextResidentID = $statusRow['Auto_increment'];
?>



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

   <script>
 document.addEventListener("DOMContentLoaded", function () {
  const badge = document.getElementById("notificationCount");
  const notificationToggle = document.getElementById("notificationToggle");
  const notificationDropdown = document.getElementById("notificationDropdown");
  const closeBtn = document.getElementById("closeNotifications");

  let currentCount = 0;

  function updateBadge() {
    const lastSeen = parseInt(localStorage.getItem('lastSeenNotificationCount')) || 0;

    if (badge) {
      if (currentCount > lastSeen) {
        badge.textContent = currentCount - lastSeen;
        badge.style.display = "inline-block";
      } else {
        badge.style.display = "none";
      }
    }
  }

  function fetchNotificationCount() {
    fetch('adminNotifications.php')
      .then(response => response.json())
      .then(data => {
        if (data.total !== undefined) {
          currentCount = data.total;
          updateBadge();
        }
      })
      .catch(error => {
        console.error('Error fetching notifications:', error);
      });
  }

  // Initial load
  fetchNotificationCount();

  // Clicking the notification icon
  notificationToggle.addEventListener('click', (e) => {
    e.preventDefault();

    if (notificationDropdown.style.display === 'block') {
      notificationDropdown.style.display = 'none';
    } else {
      notificationDropdown.style.display = 'block';

      // Mark as read: store current count
      localStorage.setItem('lastSeenNotificationCount', currentCount);
      updateBadge();
    }
  });

  // Close button in dropdown
  closeBtn.addEventListener('click', () => {
    notificationDropdown.style.display = 'none';
  });

  setInterval(fetchNotificationCount, 10000);
});
</script>

  <style>
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

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

   table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border: none;
    }
    th, td {
      padding: 10px;
      border: none;
      text-align: left;
    }
    .table-rounded thead th:first-child {
        border-top-left-radius: 0.9rem;
    }
    .table-rounded thead th:last-child {
        border-top-right-radius: 0.9rem;
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
    
      <!--All Residents content-->
      <div class="main-content p-4" id="maincontent">
        <h2>All Residents</h2>

        <!--Search bar-->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <form class="m-0">
              <div class="search d-flex align-items-center">
                <span class="search-icon material-icons me-2">search</span>
                <input class="search-input form-control" type="search" placeholder="Search" id="searchInput">
              </div>
          </form>
          <!--Add New Resident Button-->
          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewResident">+ Add new resident</button>
              <div class="mt-2">
                <div class="row g-2">
                  <div class="col-6">
                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#exportModal">Export</button>
                  </div>
                </div>
              </div>
          </div>

          <!-- Import CSV Modal -->
          <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form action="import_csv.php" method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="importModalLabel">Import Residents (CSV)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="csvFile" class="form-label">Upload CSV File</label>
                    <input class="form-control" type="file" name="csv_file" id="csvFile" accept=".csv" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Import</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Export CSV Modal -->
          <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exportModalLabel">Export Residents Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Click the button below to download all resident records in CSV format.</p>
                </div>
                <div class="modal-footer">
                  <a id="exportCsvLink" href="#" class="btn btn-success">Download CSV</a>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Edit Modal -->
          <div class="modal fade" id="editResidentModal" tabindex="-1" aria-labelledby="editResidentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <form id="editResidentForm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Resident Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="edit_resident_ID" name="resident_ID">
                    <h6>Personal Information</h6>
                    <!-- Full Name -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>First Name</label>
                          <input type="text" class="form-control" id="edit_first_name" name="first_name">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Middle Name</label>
                          <input type="text" class="form-control" id="edit_middle_name" name="middle_name">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id="edit_last_name" name="last_name">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Suffix</label>
                          <input type="text" class="form-control" id="edit_suffix" name="suffix">
                        </div>
                      </div>
                    </div>
                    <!-- Nickname, Birthdate, Birthplace, and Age -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Nickname</label>
                          <input type="text" class="form-control" id="edit_nick_name" name="nick_name">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Date of Birth</label>
                          <input type="date" class="form-control" id="edit_birthdate" name="birthdate">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label>Place of Birth</label>
                          <input type="text" class="form-control" id="edit_birthplace" name="birthplace">
                        </div>
                      </div><div class="col-md-3">
                        <div class="mb-3">
                          <label>Age</label>
                          <input type="number" class="form-control" id="edit_age" name="age">
                        </div>
                      </div>
                    </div>
                    <!-- Gender, Blood Type, and Occupation -->
                    <div class="row g-3">
                      <div class="col-md-4">
                        <label for="edit_gender" class="form-label">Gender</label>
                        <select class="form-control" id="edit_gender" name="gender">
                          <option>Male</option>
                          <option>Female</option>
                          <option>Other</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="edit_blood_type" class="form-label">Blood Type</label>
                        <select class="form-control" name="blood_type" id="edit_blood_type">
                          <option value="">Select Blood Type</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="edit_occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="edit_occupation" name="occupation" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <label for="edit_civil_status" class="form-label">Civil Status</label>
                        <select class="form-control" id="edit_civil_status" name="civil_status">
                          <option>Single</option>
                          <option>Married</option>
                          <option>Divorced</option>
                          <option>Widowed</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="edit_nationality">Nationality</label>
                        <input type="text" class="form-control" id="edit_nationality" name="nationality" />
                      </div>
                      <div class="col-md-4">
                        <label for="edit_religion">Religion</label>
                        <select class="form-control" name="religion" id="edit_religion" required>
                          <option value="Roman Catholic">Roman Catholic</option>
                          <option value="Christian">Christian</option>
                          <option value="Inglesia ni Cristo">Inglesia ni Cristo</option>
                          <option value="Seventh Day Adventist">Seventh Day Adventist</option>
                          <option value="Islam">Islam</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Contact Number</label>
                          <input type="text" class="form-control" id="edit_contact_number" name="contact_number">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <!-- Email -->
                        <div class="mb-3">
                          <label>Email</label>
                          <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                      </div>
                    </div>

                    <!-- Address Information -->
                    <h6>Adddress Information</h6>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Province</label>
                          <input type="text" class="form-control" id="edit_province" name="province">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Municipality</label>
                          <input type="text" class="form-control" id="edit_municipality" name="municipality">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>ZIP Code</label>
                          <input type="text" class="form-control" id="edit_zip_code" name="zip_code">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Barangay</label>
                          <input type="text" class="form-control" id="edit_barangay" name="barangay">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Purok</label>
                          <input type="text" class="form-control" id="edit_purok" name="purok">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Street</label>
                          <input type="text" class="form-control" id="edit_street" name="street">
                        </div>
                      </div>
                    </div>
                    
                    <!-- Family Background -->
                    <h6>Family Background</h6>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Father's Name</label>
                          <input type="text" class="form-control" id="edit_father_name" name="father_name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Father's Contact</label>
                          <input type="text" class="form-control" id="edit_father_contact" name="father_contact">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Mother's Name</label>
                          <input type="text" class="form-control" id="edit_mother_name" name="mother_name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Mother's Contact</label>
                          <input type="text" class="form-control" id="edit_mother_contact" name="mother_contact">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Spouse's Name</label>
                          <input type="text" class="form-control" id="edit_spouse_name" name="spouse_name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Spouse's Contact</label>
                          <input type="text" class="form-control" id="edit_spouse_contact" name="spouse_contact">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Guardian's Name</label>
                          <input type="text" class="form-control" id="edit_guardian_name" name="guardian_name">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Guardian's Relationship</label>
                          <input type="text" class="form-control" id="edit_guardian_relation" name="guardian_relation">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Guardian's Contact</label>
                          <input type="text" class="form-control" id="edit_guardian_contact" name="guardian_contact">
                        </div>
                      </div>
                    </div>
                    <!-- Government Identification -->
                    <h6>Government Identification</h6>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>National ID</label>
                          <input type="text" class="form-control" id="edit_national_ID_num" name="national_ID_num">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>SSS Number</label>
                          <input type="text" class="form-control" id="edit_sss_num" name="sss_num">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>TIN Number</label>
                          <input type="text" class="form-control" id="edit_tin_num" name="tin_num">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>GSIS Number</label>
                          <input type="text" class="form-control" id="edit_gsis_num" name="gsis_num">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Pag-Ibig Number</label>
                          <input type="text" class="form-control" id="edit_pagibig_num" name="pagibig_num">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>PhilHealth Number</label>
                          <input type="text" class="form-control" id="edit_philhealth_num" name="philhealth_num">
                        </div>
                      </div>
                    </div>

                    <h5>Other Informations</h5>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Resident Status</label>
                          <select class="form-control" id="edit_resident_status" name="resident_status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Voter</label>
                          <select class="form-control" id="edit_voter" name="voter">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>PWD</label>
                          <select class="form-control" id="edit_pwd" name="pwd">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Senior Citizen</label>
                          <select class="form-control" id="edit_senior_citizen" name="senior_citizen">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>Solo Parent</label>
                          <select class="form-control" id="edit_solo_parent" name="solo_parent">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label>4PS</label>
                          <input type="text" class="form-control" id="edit_is_4ps" name="is_4ps" />
                        </div>
                      </div>
                    </div>
                    

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <!--Add New Resident Modal-->
          <div class="modal fade" id="addNewResident" tabindex="-1" aria-labelledby="multiStepModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <form class="modal-content" id="residentForm" action="uploadResident.php" method="POST" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="multiStepModalLabel">Resident Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <!-- Personal Info -->
                <div class="form-step active">
                  <h6>Personal and Contact Information</h6>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="container">
                        <div class="text-center">
                          <!-- Profile Image -->
                          <img src="img/default.png" alt="Profile Photo" name="profile_photo" class="img-fluid rounded-circle mb-3" id="profilePreview" style="width: 150px; height: 150px; object-fit: cover;">
                                              
                          <!-- Upload Button -->
                          <div class="mb-3">
                            <input type="file" class="form-control d-none" id="profileInput" name="profile_photo" accept="image/*">
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('profileInput').click();">Change Photo</button>
                          </div>
                        </div>
                        <!-- Resident ID -->
                        <div class="form-group mb-3">
                          <label for="resident_ID_display">Resident ID (Auto-generated)</label>
                          <input type="text" id="resident_ID" class='form-control' value="<?php echo $nextResidentID; ?>" readonly>
                        </div>

                        <!-- Occupation -->
                        <div class="mb-3">
                          <label>Occupation</label>
                          <input type="text" class="form-control" name="occupation" />
                        </div>
                        <!-- Age and Bloodtype -->
                        <div class="row">
                          <div class="col-md-4 mb-3">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" min="0" max="100"/>
                          </div>
                          <div class="col-md-8 mb-3">
                            <label for="blood_type" class="form-label">Blood Type</label>
                            <select class="form-select" name="blood_type" id="blood_type">
                              <option value="">Select Blood Type</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                            </select>
                          </div>
                        </div>
                        <!-- Civil Status -->
                        <div class="mb-3">
                          <label for="civil_status" class="form-label">Civil Status</label>
                          <select class="form-select" name="civil_status" id="civil_status" required>
                            <option value="" selected disabled>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="container">
                        <!-- First Name and Middle Name-->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="first_name">First Name</label>
                              <input type="text" class="form-control" id="first_name" name="first_name" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="middle_name">Middle Name</label>
                              <input type="text" class="form-control" id="middle_name" name="middle_name" />
                            </div>
                          </div>
                        </div>
                        <!-- Last Name and Suffix-->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="last_name">Last Name</label>
                              <input type="text" class="form-control" id="last_name" name="last_name" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="suffix">Suffix</label>
                              <select class="form-select" name="suffix" id="suffix">
                                <option value="" selected disabled>Select Suffix</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- Nick Name and Gender -->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="nick_name">Nick Name</label>
                              <input type="text" class="form-control" id="nick_name" name="nick_name" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="gender">Gender</label>
                              <select class="form-select" name="gender" id="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                <option value="N/A">Prefer not to say</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- Date of Birth and Place of Birth-->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="birthdate">Date of Birth</label>
                              <input type="date" class="form-control" id="birthdate" name="birthdate" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="birthplace">Place of Birth</label>
                              <input type="text" class="form-control" id="birthplace" name="birthplace" />
                            </div>
                          </div>
                        </div>
                        <!-- Nationality and Religion-->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="nationality">Nationality</label>
                              <input type="text" class="form-control" id="nationality" name="nationality" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="religion">Religion</label>
                              <select class="form-select" name="religion" id="religion" required>
                                <option value="" selected disabled>Select Religion</option>
                                <option value="Roman Catholic">Roman Catholic</option>
                                <option value="Christian">Christian</option>
                                <option value="Inglesia ni Cristo">Inglesia ni Cristo</option>
                                <option value="Seventh Day Adventist">Seventh Day Adventist</option>
                                <option value="Islam">Islam</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- Contact Number and Email Address-->
                        <div class="mb-3">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="contact_number">Contact Number</label>
                              <input type="text" class="form-control" id="contact_number" name="contact_number" />
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="email">Email Address</label>
                              <input type="email" class="form-control" id="email" name="email" />
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>

                <!-- Address and Family Background -->
                <div class="form-step">
                  <h6>Address Information</h6>
                  <!--- Province, Municipality and ZIP Code -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="municipality">Municipality</label>
                        <input type="text" class="form-control" id="municipality" name="municipality" />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="zip_code">ZIP Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" />
                      </div>
                    </div>
                  </div>
                  <!-- Barangay, Purok, and Street -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="barangay">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay" />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="purok">Purok</label>
                        <input type="text" class="form-control" id="purok" name="purok" />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" id="street" name="street" />
                      </div>
                    </div>
                  </div>

                  <h6>Family Background</h6>
                  <!-- Father's Information -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="father_name">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="father_contact">Contact Number</label>
                        <input type="text" class="form-control" id="father_contact" name="father_contact" />
                      </div>
                    </div>
                  </div>
                  <!-- Mother's Information -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="mother_name">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="mother_contact">Contact Number</label>
                        <input type="text" class="form-control" id="mother_contact" name="mother_contact" />
                      </div>
                    </div>
                  </div>
                  <!-- Spouse's Information -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="spouse_name">Spouse's Name</label>
                        <input type="text" class="form-control" id="spouse_name" name="spouse_name" />
                      </div>
                      <div class="col-md-6">
                        <label for="spouse_contact">Contact Number</label>
                        <input type="text" class="form-control" id="spouse_contact" name="spouse_contact" />
                      </div>
                    </div>
                  </div>
                  <!-- Guardian's Information -->
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="guardian_name">Guardian Name</label>
                        <input type="text" class="form-control" id="guardian_name" name="guardian_name" />
                      </div>
                      <div class="col-md-4">
                        <label for="guardian_relation">Relation</label>
                        <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" />
                      </div>
                      <div class="col-md-4">
                        <label for="guardian_contact">Contact Number</label>
                        <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" />
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Government Identification-->
                <div class="form-step">
                  <h6>Government Identification</h6>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="national_ID_num">National ID</label>
                        <input type="text" class="form-control" id="national_ID_num" name="national_ID_num" />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="sss_num">SSS Number</label>
                        <input type="text" class="form-control" id="sss_num" name="sss_num" />
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="tin_num">Tin Number</label>
                        <input type="text" class="form-control" id="tin_nUm" name="tin_num" />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="gsis_num">GSIS Number</label>
                        <input type="text" class="form-control" id="gsis_num" name="gsis_num" />
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="pagibig_num">Pag-ibig Number</label>
                        <input type="text" class="form-control" id="pagibig_num" name="pagibig_num" />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="philhealthNum">PhilHealth Number</label>
                        <input type="text" class="form-control" id="philhealth_num" name="philhealth_num" />
                      </div>
                    </div>
                  </div>
                  <!-- Other Info -->
                  <h6>Other Information</h6>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="resident_status">Resident Status</label>
                        <select class="form-select" name="resident_status" id="resident_status" required>
                          <option value="" selected disabled>Select Status</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="voter">Voter</label>
                        <select class="form-select" name="voter" id="voter" required>
                          <option value="" selected disabled>Select </option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="pwd">Person with Disability</label>
                        <select class="form-select" name="pwd" id="pwd" required>
                          <option value="" selected disabled>Select </option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="senior_citizen">Senior Citizen</label>
                        <select class="form-select" name="senior_citizen" id="senior_citizen" required>
                          <option value="" selected disabled>Select </option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="solo_parent">Solo Parent</label>
                        <select class="form-select" name="solo_parent" id="solo_parent" required>
                          <option value="" selected disabled>Select </option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="is_4ps">4PS</label>
                        <select class="form-select" name="is_4ps" id="is_4ps" required>
                          <option value="" selected disabled>Select </option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="prevStep" disabled>Back</button>
                <button type="button" class="btn btn-primary" id="nextStep">Next</button>
                <button type="submit" class="btn btn-success d-none" id="submitBtn">Save Resident</button>
              </div>
            </form>
          </div>

        </div>   

      </div>

        <table class="table table-borderless table-rounded">
            <thead class="table-primary">
              <tr>
                <th scope="col" style="width: 600px;">Full Name</th>
                <th scope="col" style="width: 200px;">Gender</th>
                <th scope="col" style="width: 200px;">Age</th>
                <th scope="col" style="width: 200px;">Resident ID</th>
                <th scope="col" style="width: 200px;">Purok</th>
                <th scope="col" style="width: 200px;">PWD</th>
                <th scope="col" style="width: 200px;">Voter</th>
                <th scope="col" style="width: 200px;">Status</th>
                <th scope="col" style="width: 200px;">Action</th>
              </tr>
            </thead>
            <tbody id="residentTableBody">
              

            </tbody>
          </table>

        
    </div>
      
    
  </div>
  
</div>
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const topnavbar = document.getElementById('topnavbar');
    const maincontent = document.getElementById('maincontent');
    const sidebarToggleContainer = document.getElementById('sidebarToggleContainer');
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

    // Profile photo preview
    document.getElementById('profileInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });  

    //Dropdown
    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        const button = this.closest('.dropdown').querySelector('.dropdown-toggle');
        button.textContent = this.textContent;
      });
    });

    // Bootstrap form validation
    (function () {
      'use strict';
      window.addEventListener('load', function () {
        // Fetch all forms with class 'needs-validation'
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    
    document.addEventListener('DOMContentLoaded', function() {
    const exportCsvLink = document.getElementById('exportCsvLink');
    const searchInput = document.getElementById('searchInput');

    exportCsvLink.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior
      const searchTerm = searchInput.value;
      exportCsvLink.href = 'export_csv.php?search=' + encodeURIComponent(searchTerm);
      window.location.href = exportCsvLink.href; // Trigger the download
    });
  });
  
    // Multi-step form logic
    const formSteps = document.querySelectorAll('.form-step');
    const nextBtn = document.getElementById('nextStep');
    const prevBtn = document.getElementById('prevStep');
    const submitBtn = document.getElementById('submitBtn');

    let currentStep = 0;

    function showStep(index) {
      formSteps.forEach((step, i) => {
        step.classList.toggle('active', i === index);
      });
      prevBtn.disabled = index === 0;
      nextBtn.classList.toggle('d-none', index === formSteps.length - 1);
      submitBtn.classList.toggle('d-none', index !== formSteps.length - 1);
    }

    nextBtn.addEventListener('click', () => {
      if (currentStep < formSteps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });

    document.getElementById('residentForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Form submitted!');
      // Add actual form processing here
    });

    // Fetch next Resident ID
    const addNewResidentModalElement = document.getElementById('addNewResident');
    if (addNewResidentModalElement) { // Check if the element exists before adding listener
        addNewResidentModalElement.addEventListener('show.bs.modal', function () {
            fetch('getNextResidentID.php')
                .then(response => response.text())
                .then(nextId => {
                    document.getElementById('resident_ID_display').value = nextId;
                });
        });
    } else {
        console.error("Error: The 'addNewResident' modal element was not found when trying to attach its event listener.");
    }

    const searchInput = document.getElementById('searchInput');
    const residentTableBody = document.getElementById('residentTableBody');
    const editResidentForm = document.getElementById('editResidentForm');
    const editResidentModal = new bootstrap.Modal(document.getElementById('editResidentModal'));

    // Helper function to safely escape strings for JS function calls in HTML
    const escapeHtmlString = (str) => {
        if (str === null || str === undefined) return '';
        return String(str).replace(/'/g, "\\'").replace(/"/g, '\\"');
    };

    // --- Function to fetch and display residents (for Active residents) ---
    async function fetchAndDisplayResidents(searchQuery = '', statusFilter = 'Active') {
        let url = `searchResidents.php?query=${encodeURIComponent(searchQuery)}`;
        if (statusFilter) {
            url += `&status=${encodeURIComponent(statusFilter)}`;
        }

        try {
            const response = await fetch(url);
            const residents = await response.json();

            residentTableBody.innerHTML = ''; // IMPORTANT: This clears the existing table rows

            if (residents.length > 0) {
                residents.forEach(resident => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${escapeHtmlString(resident.first_name)} ${resident.middle_name ? escapeHtmlString(resident.middle_name) + ' ' : ''}${escapeHtmlString(resident.last_name)} ${resident.suffix ? escapeHtmlString(resident.suffix) : ''}</td>
                        <td>${escapeHtmlString(resident.gender)}</td>
                        <td>${escapeHtmlString(resident.age)}</td>
                        <td>${resident.resident_ID}</td>
                        <td>${escapeHtmlString(resident.purok)}</td>
                        <td>${escapeHtmlString(resident.voter)}</td>
                        <td>${escapeHtmlString(resident.pwd)}</td>
                        <td>${escapeHtmlString(resident.resident_status)}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                                    <span class="material-icons">more_horiz</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#"
                                          onclick="editResident(
                                              '${escapeHtmlString(resident.resident_ID)}',
                                              '${escapeHtmlString(resident.first_name)}',
                                              '${escapeHtmlString(resident.middle_name || '')}',
                                              '${escapeHtmlString(resident.last_name)}',
                                              '${escapeHtmlString(resident.suffix || '')}',
                                              '${escapeHtmlString(resident.nick_name || '')}',
                                              '${escapeHtmlString(resident.birthdate)}',
                                              '${escapeHtmlString(resident.birthplace || '')}',
                                              '${escapeHtmlString(resident.age)}',
                                              '${escapeHtmlString(resident.gender)}',
                                              '${escapeHtmlString(resident.blood_type || '')}',
                                              '${escapeHtmlString(resident.occupation || '')}',
                                              '${escapeHtmlString(resident.civil_status)}',
                                              '${escapeHtmlString(resident.nationality || '')}',
                                              '${escapeHtmlString(resident.religion || '')}',
                                              '${escapeHtmlString(resident.contact_number || '')}',
                                              '${escapeHtmlString(resident.email || '')}',
                                              '${escapeHtmlString(resident.province || '')}',
                                              '${escapeHtmlString(resident.municipality || '')}',
                                              '${escapeHtmlString(resident.zip_code || '')}',
                                              '${escapeHtmlString(resident.barangay || '')}',
                                              '${escapeHtmlString(resident.purok || '')}',
                                              '${escapeHtmlString(resident.street || '')}',
                                              '${escapeHtmlString(resident.father_name || '')}',
                                              '${escapeHtmlString(resident.father_contact || '')}',
                                              '${escapeHtmlString(resident.mother_name || '')}',
                                              '${escapeHtmlString(resident.mother_contact || '')}',
                                              '${escapeHtmlString(resident.spouse_name || '')}',
                                              '${escapeHtmlString(resident.spouse_contact || '')}',
                                              '${escapeHtmlString(resident.guardian_name || '')}',
                                              '${escapeHtmlString(resident.guardian_relation || '')}',
                                              '${escapeHtmlString(resident.guardian_contact || '')}',
                                              '${escapeHtmlString(resident.national_ID_num || '')}',
                                              '${escapeHtmlString(resident.sss_num || '')}',
                                              '${escapeHtmlString(resident.tin_num || '')}',
                                              '${escapeHtmlString(resident.gsis_num || '')}',
                                              '${escapeHtmlString(resident.pagibig_num || '')}',
                                              '${escapeHtmlString(resident.philhealth_num || '')}',
                                              '${escapeHtmlString(resident.resident_status)}',
                                              '${escapeHtmlString(resident.voter)}',
                                              '${escapeHtmlString(resident.pwd)}',
                                              '${escapeHtmlString(resident.senior_citizen)}',
                                              '${escapeHtmlString(resident.solo_parent)}',
                                              '${escapeHtmlString(resident.is_4ps)}'
                                              )" data-bs-toggle="modal" data-bs-target="#editResidentModal">
                                            Edit
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="#" onclick="handleDeleteClick('${escapeHtmlString(resident.resident_ID)}')">Delete</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="archiveResident('${escapeHtmlString(resident.resident_ID)}')">Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    residentTableBody.appendChild(row);
                });
            } else {
                residentTableBody.innerHTML = "<tr><td colspan='9'>No active residents found.</td></tr>";
            }
        } catch (error) {
            console.error('Error fetching residents:', error);
            residentTableBody.innerHTML = "<tr><td colspan='9'>Error loading residents.</td></tr>";
        }
    }

    // --- Function to handle resident deletion (now accepts residentID directly) ---
    async function handleDeleteClick(residentID) {
        if (confirm(`Are you sure you want to permanently delete resident ID ${residentID}? This action cannot be undone.`)) {
            try {
                const formData = new FormData();
                formData.append('resident_ID', residentID);

                const response = await fetch('deleteResident.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    alert('Resident deleted successfully!');
                    fetchAndDisplayResidents(searchInput.value, 'Active'); // Refresh active residents table
                } else {
                    alert('Error deleting resident: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during deletion.');
            }
        }
    }

    function editResident(
        residentID,
        firstName,
        middleName,
        lastName,
        suffix,
        nickName,
        birthdate,
        birthplace,
        age,
        gender,
        bloodType,
        occupation,
        civilStatus,
        nationality,
        religion,
        contactNumber,
        email,
        province,
        municipality,
        zipCode,
        barangay,
        purok,
        street,
        fatherName,
        fatherContact,
        motherName,
        motherContact,
        spouseName,
        spouseContact,
        guardianName,
        guardianRelation,
        guardianContact,
        nationalIDNum,
        sssNum,
        tinNum,
        gsisNum,
        pagibigNum,
        philhealthNum,
        residentStatus,
        voter,
        pwd,
        seniorCitizen,
        soloParent,
        is4ps
    ) {
        document.getElementById('edit_resident_ID').value = residentID;
        document.getElementById('edit_first_name').value = firstName;
        document.getElementById('edit_middle_name').value = middleName;
        document.getElementById('edit_last_name').value = lastName;
        document.getElementById('edit_suffix').value = suffix;
        document.getElementById('edit_nick_name').value = nickName;
        document.getElementById('edit_birthdate').value = birthdate;
        document.getElementById('edit_birthplace').value = birthplace;
        document.getElementById('edit_age').value = age;
        document.getElementById('edit_gender').value = gender;
        document.getElementById('edit_blood_type').value = bloodType;
        document.getElementById('edit_occupation').value = occupation;
        document.getElementById('edit_civil_status').value = civilStatus;
        document.getElementById('edit_nationality').value = nationality;
        document.getElementById('edit_religion').value = religion;
        document.getElementById('edit_contact_number').value = contactNumber;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_province').value = province;
        document.getElementById('edit_municipality').value = municipality;
        document.getElementById('edit_zip_code').value = zipCode;
        document.getElementById('edit_barangay').value = barangay;
        document.getElementById('edit_purok').value = purok;
        document.getElementById('edit_street').value = street;
        document.getElementById('edit_father_name').value = fatherName;
        document.getElementById('edit_father_contact').value = fatherContact;
        document.getElementById('edit_mother_name').value = motherName;
        document.getElementById('edit_mother_contact').value = motherContact;
        document.getElementById('edit_spouse_name').value = spouseName;
        document.getElementById('edit_spouse_contact').value = spouseContact;
        document.getElementById('edit_guardian_name').value = guardianName;
        document.getElementById('edit_guardian_relation').value = guardianRelation;
        document.getElementById('edit_guardian_contact').value = guardianContact;
        document.getElementById('edit_national_ID_num').value = nationalIDNum;
        document.getElementById('edit_sss_num').value = sssNum;
        document.getElementById('edit_tin_num').value = tinNum;
        document.getElementById('edit_gsis_num').value = gsisNum;
        document.getElementById('edit_pagibig_num').value = pagibigNum;
        document.getElementById('edit_philhealth_num').value = philhealthNum;
        document.getElementById('edit_resident_status').value = residentStatus;
        document.getElementById('edit_voter').value = voter;
        document.getElementById('edit_pwd').value = pwd;
        document.getElementById('edit_senior_citizen').value = seniorCitizen;
        document.getElementById('edit_solo_parent').value = soloParent;
        document.getElementById('edit_is_4ps').value = is4ps;


        const modal = new bootstrap.Modal(document.getElementById('editResidentModal'));
        modal.show();
    }

  document.getElementById('editResidentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Collect all data from the form
    const residentID = document.getElementById('edit_resident_ID').value;
    const firstName = document.getElementById('edit_first_name').value;
    const middleName = document.getElementById('edit_middle_name').value;
    const lastName = document.getElementById('edit_last_name').value;
    const suffix = document.getElementById('edit_suffix').value;
    const gender = document.getElementById('edit_gender').value;
    const age = document.getElementById('edit_age').value;
    const bloodType = document.getElementById('edit_blood_type').value;
    const civilStatus = document.getElementById('edit_civil_status').value;
    const birthdate = document.getElementById('edit_birthdate').value;
    const birthplace = document.getElementById('edit_birthplace').value;
    const contactNumber = document.getElementById('edit_contact_number').value;
    const email = document.getElementById('edit_email').value;
    const province = document.getElementById('edit_province').value;
    const municipality = document.getElementById('edit_municipality').value;
    const barangay = document.getElementById('edit_barangay').value;
    const purok = document.getElementById('edit_purok').value;
    const street = document.getElementById('edit_street').value;
    const zipCode = document.getElementById('edit_zip_code').value;
    const fatherName = document.getElementById('edit_father_name').value;
    const fatherContact = document.getElementById('edit_father_contact').value;
    const motherName = document.getElementById('edit_mother_name').value;
    const motherContact = document.getElementById('edit_mother_contact').value;
    const spouseName = document.getElementById('edit_spouse_name').value;
    const spouseContact = document.getElementById('edit_spouse_contact').value;
    const guardianName = document.getElementById('edit_guardian_name').value;
    const guardianRelation = document.getElementById('edit_guardian_relation').value;
    const guardianContact = document.getElementById('edit_guardian_contact').value;
    const occupation = document.getElementById('edit_occupation').value;
    const nickName = document.getElementById('edit_nick_name').value;
    const nationality = document.getElementById('edit_nationality').value;
    const religion = document.getElementById('edit_religion').value;
    const nationalIDNum = document.getElementById('edit_national_ID_num').value;
    const sssNum = document.getElementById('edit_sss_num').value;
    const tinNum = document.getElementById('edit_tin_num').value;
    const gsisNum = document.getElementById('edit_gsis_num').value;
    const pagibigNum = document.getElementById('edit_pagibig_num').value;
    const philhealthNum = document.getElementById('edit_philhealth_num').value;
    const residentStatus = document.getElementById('edit_resident_status').value;
    const voter = document.getElementById('edit_voter').value;
    const pwd = document.getElementById('edit_pwd').value;
    const seniorCitizen = document.getElementById('edit_senior_citizen').value;
    const soloParent = document.getElementById('edit_solo_parent').value;
    const is4ps = document.getElementById('edit_is_4ps').value;

    // Create a FormData object to send the data
    const formData = new FormData();
    formData.append('resident_ID', residentID);
    formData.append('first_name', firstName);
    formData.append('middle_name', middleName);
    formData.append('last_name', lastName);
    formData.append('suffix', suffix);
    formData.append('gender', gender);
    formData.append('age', age);
    formData.append('blood_type', bloodType);
    formData.append('civil_status', civilStatus);
    formData.append('birthdate', birthdate);
    formData.append('birthplace', birthplace);
    formData.append('contact_number', contactNumber);
    formData.append('email', email);
    formData.append('province', province);
    formData.append('municipality', municipality);
    formData.append('barangay', barangay);
    formData.append('purok', purok);
    formData.append('street', street);
    formData.append('zip_code', zipCode);
    formData.append('father_name', fatherName);
    formData.append('father_contact', fatherContact);
    formData.append('mother_name', motherName);
    formData.append('mother_contact', motherContact);
    formData.append('spouse_name', spouseName);
    formData.append('spouse_contact', spouseContact);
    formData.append('guardian_name', guardianName);
    formData.append('guardian_relation', guardianRelation);
    formData.append('guardian_contact', guardianContact);
    formData.append('occupation', occupation);
    formData.append('nick_name', nickName);
    formData.append('nationality', nationality);
    formData.append('religion', religion);
    formData.append('national_ID_num', nationalIDNum);
    formData.append('sss_num', sssNum);
    formData.append('tin_num', tinNum);
    formData.append('gsis_num', gsisNum);
    formData.append('pagibig_num', pagibigNum);
    formData.append('philhealth_num', philhealthNum);
    formData.append('resident_status', residentStatus);
    formData.append('voter', voter);
    formData.append('pwd', pwd);
    formData.append('senior_citizen', seniorCitizen);
    formData.append('solo_parent', soloParent);
    formData.append('is_4ps', is4ps);

    // Send data to a PHP script using fetch API
    fetch('updateResident.php', { // You can name this PHP file anything, e.g., update_resident.php
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Assuming your PHP script returns JSON
    .then(data => {
        console.log('Update response:', data);
        if (data.success) {
            alert('Resident data updated successfully!');
            // Optionally, refresh the page or update the table row
            location.reload(); // Reloads the page to show updated data
        } else {
            alert('Error updating resident data: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while trying to update resident data.');
    });

    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('editResidentModal'));
    modal.hide();
});

async function archiveResident(residentID) {
        if (confirm(`Are you sure you want to archive resident ID ${residentID}? This will move them to the archived list.`)) {
            try {
                const formData = new FormData();
                formData.append('resident_ID', residentID);
                formData.append('new_status', 'Inactive'); // Change status to Inactive

                const response = await fetch('updateResidentStatus.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    alert('Resident archived successfully!');
                    fetchAndDisplayResidents(searchInput.value, 'Active'); // Refresh the active residents table
                } else {
                    alert('Error archiving resident: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during archiving.');
            }
        }
    }

    // --- Initial Load and Search Event Listener ---
    document.addEventListener('DOMContentLoaded', () => {
        fetchAndDisplayResidents('', 'Active'); // Initial load of active residents

        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                fetchAndDisplayResidents(searchInput.value, 'Active'); // Live search
            });
        }
    });

</script>
  
  
</body>
</html>

<?php $conn->close(); ?>