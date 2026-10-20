<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blotter List</title>
  <title>Barangay Balinad Portal</title>
  <link rel="icon" href="barangayBalinad.png" type="image/png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="adminDashboard1.css">

  <style>

.print-button {
  background-color: #0d6efd; /* Bootstrap primary color */
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 16px;
  font-weight: 500;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.print-button:hover {
  background-color: #0b5ed7;
}

.print-button:active {
  background-color: #0a58ca;
}




     @media print {
    * {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    }

    #previewModal,
    #previewModal * {
        visibility: visible;
    }

    #previewModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        height: auto !important;
        overflow: visible !important;
        background-color: white !important;
    }

    .btn,
    .modal-header,
    .modal-footer {
        display: none !important;
    }

    

    }
  </style>
  
</head>
<body>

<div class="wrapper d-flex">
    
    <!-- Sidebar -->
    <nav id="sidebar">
  
        <div class="sidebar-header">
          <img src="barangayBalinad.png" class="logo-img"/>
          <div class="text-conatinerp">
            <h3>CONNECT</h3>
            <p>Balinad Daraga, Albay</p>
          </div>
        </div>

        <ul class="list-unstyled components">

            <li  class="">
              <a href="adminDashboard.php"><i class="material-icons">dashboard</i>
              <span>Dashboard</span></a>
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
                  <a href="adminListOfOfficials.php">
                    <i class="material-icons">assignment_ind</i><span>List of Officials</span></a>
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

            <li class="dropdown">
                <a href="#pageSubmenu5" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">gavel</i><span>Blotter</span></a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu5">

                  <li style="margin-left: 20px;">
                    <a href="adminBlotter.html">
                      <i class="material-icons">article</i><span>Blotter</span></a>
                  </li>

                  <li style="margin-left: 20px;">
                    <a href="adminBlotterlist.php">
                      <i class="material-icons">view_list</i><span>Blotter List</span></a>
                  </li>
                </ul>
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
    
    <div class="main-content p-4" id="maincontent" style="min-height: 100vh;">
    <h1>Blotter List</h1>
<br>
<table class="table table-bordered">
   <thead class="table-primary">
    <tr>
      <th>Blotter Series</th>
      <th>Date</th>
      <th>Name of Complainant</th>
      <th>Complainant Contact</th>
      <th>Officer Name</th>
      <th>Position</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "barangay_db";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM blotter";
    $result = $connection->query($sql);

    if (!$result) {
      die("Invalid query: " . $connection->error);
    }

    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>" . $row["blotterSeries"] . "</td>
        <td>" . $row["dates"] . "</td>
        <td>" . $row["complainantName"] . "</td>
        <td>" . $row["complainantContact"] . "</td>
        <td>" . $row["officerName"] . "</td>
        <td>" . $row["position"] . "</td>
        <td style='display: flex; gap:10px;'>
          <button class='btn btn-primary btn-sm editBtn' 
        data-blotterseries='" . $row['blotterSeries'] . "'
        data-dates='" . $row['dates'] . "'
        data-complainantname='" . $row['complainantName'] . "'
        data-complainantage='" . $row['complainantAge'] . "'
        data-complainantaddress='" . $row['complainantAddress'] . "'
        data-complainantcontact='" . $row['complainantContact'] . "'
        data-defendantname='" . $row['defendantName'] . "'
        data-defendantage='" . $row['defendantAge'] . "'
        data-defendantaddress='" . $row['defendantAddress'] . "'
        data-defendantcontact='" . $row['defendantContact'] . "'
        data-complaints='" . $row['complaints'] . "'
        data-blotterdate='" . $row['blotterDate'] . "'
        data-blotterplace='" . $row['blotterPlace'] . "'
        data-blottertime='" . $row['blotterTime'] . "'
        data-narrative='" . htmlspecialchars($row['narrative'], ENT_QUOTES) . "'
        data-officername='" . $row['officerName'] . "'
        data-position='" . $row['position'] . "'
      >Edit</button>


          <button class='btn btn-danger btn-sm deleteBtn' 
            data-blotterSeries='" . $row['blotterSeries'] . "'
          >Delete</button>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="adminBlotterListSave.php" method="post" class="bg-white p-4 rounded">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Edit Blotter</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
          <input type="hidden" name="blotterSeries" id="editBlotterSeries">

          <div class="mb-3">
            <label>Date of blotter</label>
            <input type="date" class="form-control form-control-sm" name="dates" id="editDates">
          </div>

          <h5>Complainant</h5>
          <hr>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Name of Complainant</label>
              <input type="text" class="form-control form-control-sm" name="complainantName" id="editComplainantName">
            </div>
            <div class="col-md-6 mb-3">
              <label>Age</label>
              <input type="text" class="form-control form-control-sm" name="complainantAge" id="editComplainantAge">
            </div>
            <div class="col-md-6 mb-3">
              <label>Address</label>
              <input type="text" class="form-control form-control-sm" name="complainantAddress" id="editComplainantAddress">
            </div>
            <div class="col-md-6 mb-3">
              <label>Contact</label>
              <input type="text" class="form-control form-control-sm" name="complainantContact" id="editComplainantContact">
            </div>
          </div>

          <h5>Defendant</h5>
          <hr>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Name of Defendant</label>
              <input type="text" class="form-control form-control-sm" name="defendantName" id="editDefendantName">
            </div>
            <div class="col-md-6 mb-3">
              <label>Age</label>
              <input type="text" class="form-control form-control-sm" name="defendantAge" id="editDefendantAge">
            </div>
            <div class="col-md-6 mb-3">
              <label>Address</label>
              <input type="text" class="form-control form-control-sm" name="defendantAddress" id="editDefendantAddress">
            </div>
            <div class="col-md-6 mb-3">
              <label>Contact</label>
              <input type="text" class="form-control form-control-sm" name="defendantContact" id="editDefendantContact">
            </div>
          </div>

          <h5>Blotter Details</h5>
          <hr>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Complaint</label>
              <input type="text" class="form-control form-control-sm" name="complaints" id="editComplaints">
            </div>
            <div class="col-md-6 mb-3">
              <label>Place</label>
              <input type="text" class="form-control form-control-sm" name="blotterPlace" id="editBlotterPlace">
            </div>
            <div class="col-md-6 mb-3">
              <label>Date of Incident</label>
              <input type="date" class="form-control form-control-sm" name="blotterDate" id="editBlotterDate">
            </div>
            <div class="col-md-6 mb-3">
              <label>Time</label>
              <input type="text" class="form-control form-control-sm" name="blotterTime" id="editBlotterTime">
            </div>
          </div>

          <div class="mb-3">
            <label>Narrative</label>
            <textarea class="form-control form-control-sm" name="narrative" id="editNarrative" rows="4" style="resize: vertical; max-height: 150px;"></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Officer Name</label>
              <input type="text" class="form-control form-control-sm" name="officerName" id="editOfficerName">
            </div>
            <div class="col-md-6 mb-3">
              <label>Position</label>
              <input type="text" class="form-control form-control-sm" name="position" id="editPosition">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" onclick="printDivFromModal()" class="print-button">🖨️ Print</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
    
    <div id="print-section" style="display: none;">
  
        <div class="left">
            <img src="barangayBalinad.png" alt="barangayBalinad img">
                <div class="left-container">
                    <h4>Balinad Barangay Council</h4>
  
                    <div class="name-container">
                        <p>HON. LENI ROBREDO</p>
                        <h6>Punong Barangay</h6>
                    </div>
  
                    <h4>Sangguniang Barangay Members</h4>
  
                    <div class="name-container">
                        <p>HON. ELIAS MONTGOMERY</p>
                        <h6>Committee on Peace and Order</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. NOVA CASTILLO</p>
                        <h6>Committee on Health, Education and Social Welfare</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. JASPER WHITMORE</p>
                        <h6>Committee on Public Works and Infrastructure</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. LIANA VASQUEZ</p>
                        <h6>Committee on Environmental Protection</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. ORION SINCLAIR</p>
                        <h6>Committee on Appropriation</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. MARISOL DELGADO</p>
                        <h6>Committee on Agriculture</h6>
                    </div>
                    
                    <div class="name-container">
                        <p>HON. ZANE HOLLOWAY</p>
                        <h6>Committee on Women and Family (VAWC)</h6>
                    </div>
  
                    <div class="name-container">
                        <p>HON. SELENE LAURENT</p>
                        <p>SK Chairperson</p>
                        <h6>Committee on Youth  and Sports Development</h6>
                    </div>
  
                    <div class="name-container">
                        <p>FELIX CARMICHAEL</p>
                        <h6>Barangay Treasurer</h6>
                    </div>
  
                    <div class="name-container">
                        <p>AMARA STERLING</p>
                        <h6>Barangay Secretary</h6>
                    </div>
                </div>
        </div>
  
        <div class="right">
            <div class="header">
                <div class="text-header">
                    <p>Republic of the Philippines</p>
                    <p>Province of Albay</p>
                    <p>Daraga</p>
                    <h4>Barangay Balinad</h4>
                    <h3>OFFICE OF THE PUNONG BARANGAY</h3>
                    <p>Telephone No.(123)456-7891</p>
                </div>
            </div>
        
            <div class="body-title">
                <h2>BLOTTER FORM</h2>
            </div>
        
            <div class="text-body">
                
                <p style="font-weight: bold;">Barangay Blotter Series: <span class="underline" id="print_blotterSeries"></span></p>
                <p style="font-weight: bold;">Date of Blotter: <span class="underline" id="print_date"></span></p>

                
                <div class="details">
                    <div class="part-container">
                      <p>Name of Complainant: <span class="underline" id="print_complainantName"></span></p>
                      <p>Address: <span class="underline" id="print_complainantAddress"></span></p>
                      <p>Contact No.: <span class="underline" id="print_complainantContact"></span></p>
                      <p>Age: <span class="underline" id="print_complainantAge"></span></p>                      
                    </div>
            
                    <div class="part-container">
                      <p>Name of Defendant: <span class="underline" id="print_defendantName"></span></p>
                      <p>Address: <span class="underline" id="print_defendantAddress"></span></p>
                      <p>Contact No.: <span class="underline" id="print_defendantContact"></span></p>
                      <p>Age: <span class="underline" id="print_defendantAge"></span></p>                      
                    </div>
                </div>
  
                <div class="part-container">
                    <h4>Blotter Details</h4>
                    <p>Complaints: <span class="underline" id="print_complaints"></span></p>
                    <p>Date of Incident: <span class="underline" id="print_blotterDate"></span></p>
                    <p>Time: <span class="underline" id="print_blotterTime"></span></p>
                    <p>Place: <span class="underline" id="print_blotterPlace"></span></p>
              </div>
        
              <div class="paragraph">
                <h4>NARRATIVE</h4>
                <p id="print_narrative"></p>
              </div>
        
                <table style="width: 100%; margin-top: 50px;">
                    <tr>
                        <td style="text-align: center; width: 50%;">
                          <h4 id="print_complainantName_signature"></h4>
                          <p>Complainant</p>
                        </td>
                        <td style="text-align: center; width: 50%;">
                          <h4 id="print_officerName"></h4>
                          <p id="print_position"></p>
                        </td>
                    </tr>
                </table>
                
            </div>
  
            <h6>Not valid without seal</h6>
        </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="adminBlotterListDelete.php" method="get">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this record?
          <input type="hidden" name="blotterSeries" id="deleteBlotterSeries">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

    </div>
      
  </div>
  
</div>
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="adminDashboard.js"></script>
  
<script>
  // Edit Button
  const editModal = new bootstrap.Modal(document.getElementById('editModal'));
  const editBtns = document.querySelectorAll('.editBtn');

  editBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('editBlotterSeries').value = btn.getAttribute('data-blotterSeries');
      document.getElementById('editDates').value = btn.getAttribute('data-dates');
      document.getElementById('editComplainantName').value = btn.getAttribute('data-complainantName');
      document.getElementById('editComplainantAge').value = btn.getAttribute('data-complainantAge');
      document.getElementById('editComplainantAddress').value = btn.getAttribute('data-complainantAddress');
      document.getElementById('editComplainantContact').value = btn.getAttribute('data-complainantContact');
      document.getElementById('editDefendantName').value = btn.getAttribute('data-defendantName');
      document.getElementById('editDefendantAge').value = btn.getAttribute('data-defendantAge');
      document.getElementById('editDefendantAddress').value = btn.getAttribute('data-defendantAddress');
      document.getElementById('editDefendantContact').value = btn.getAttribute('data-defendantContact');
      document.getElementById('editNarrative').value = btn.getAttribute('data-narrative');
      document.getElementById('editBlotterDate').value = btn.getAttribute('data-blotterDate');
      document.getElementById('editBlotterPlace').value = btn.getAttribute('data-blotterPlace');
      document.getElementById('editBlotterTime').value = btn.getAttribute('data-blotterTime');
      document.getElementById('editComplaints').value = btn.getAttribute('data-complaints');
      document.getElementById('editOfficerName').value = btn.getAttribute('data-officerName');
      document.getElementById('editPosition').value = btn.getAttribute('data-position');
      editModal.show();
    });
  });

  // Delete Button
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  const deleteBtns = document.querySelectorAll('.deleteBtn');

  deleteBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('deleteBlotterSeries').value = btn.getAttribute('data-blotterSeries');
      deleteModal.show();
    });
  });



   // Print the formatted blotter section
  function printDivFromModal() {
      const narrativeEditor = document.getElementById("editNarrative");
      const narrative = narrativeEditor ? narrativeEditor.value : "<i>Not provided</i>";

      const fields = [
        ["blotterSeries", "editBlotterSeries"],
        ["date", "editDates"],
        ["complainantName", "editComplainantName"],
        ["complainantAge", "editComplainantAge"],
        ["complainantAddress", "editComplainantAddress"],
        ["complainantContact", "editComplainantContact"],
        ["defendantName", "editDefendantName"],
        ["defendantAge", "editDefendantAge"],
        ["defendantAddress", "editDefendantAddress"],
        ["defendantContact", "editDefendantContact"],
        ["complaints", "editComplaints"],
        ["blotterDate", "editBlotterDate"],
        ["blotterPlace", "editBlotterPlace"],
        ["blotterTime", "editBlotterTime"],
        ["narrative", "editNarrative"],
        ["officerName", "editOfficerName"],
        ["position", "editPosition"]
      ];

      fields.forEach(([printId, inputId]) => {
        const input = document.getElementById(inputId);
        const printElement = document.getElementById("print_" + printId);
        if (input && printElement) {
          printElement.innerHTML = input.value || "<i>Not provided</i>";
        }
      });

      // Signature line
      const signature = document.getElementById("editComplainantName").value || "Not provided";
      document.getElementById("print_complainantName_signature").innerText = signature;

      const printContent = document.getElementById("print-section").innerHTML;

      // Create and print via iframe
      const iframe = document.createElement("iframe");
      iframe.style.position = "fixed";
      iframe.style.right = "0";
      iframe.style.bottom = "0";
      iframe.style.width = "0";
      iframe.style.height = "0";
      iframe.style.border = "0";
      document.body.appendChild(iframe);

      const doc = iframe.contentWindow.document;
      doc.open();
      doc.write(`
      <!DOCTYPE html>
        <html>
        <head>
          <title>Print Document</title>
          <style>
            @media print {
              * {
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important;         
              }
            }
            body {
              font-family: 'Times New Roman', Times, serif;
            }

            .main-container {
              margin-top: 30px;
              display: flex;
              flex-direction: row;
            }

            .left {
              display: flex;
              flex-direction: column;
              position: fixed;
            }

            .left img {
              width: 100px;
              margin-left: 80px;
              margin-bottom: 10px;
            }

            .left-container {
              background: #acd4ff;
              padding: 15px;
              height: 800px;
            }

            .left-container h4 {
              text-align: center;
            }

            .name-container {
              margin-bottom: 20px;
            }

            .name-container p,
            .name-container h6 {
              margin: 0;
              line-height: 1.2;
            }

            .name-container p {
              font-weight: bold;
              font-size: 12px;
            }

            .name-container h6 {
              font-weight: normal;
            }

            .right {
              display: flex;
              flex-direction: column;
              margin-left: 290px;
              font-size: 11px;
            }

            .text-header {
              text-align: center;
            }

            .text-header p,
            .text-header h4,
            .text-header h3 {
              margin: 0;
              line-height: 1.2;
            }

            .body-title {
              text-align: center;
              margin-top: 30px;
            }

            .text-body p {
              margin: 0;
              line-height: 1.2;
            }

            .part-container {
              font-weight: bold;
              margin-bottom: 20px;
            }

            .part-container p {
              margin: 0;
              line-height: 1.2;
            }

            .details {
              margin-top: 30px;
              display: flex;
              flex-direction: column;
            }

            .footer {
              display: flex;
              flex-direction: row;
              text-align: center;
              gap: 20px;
            }

            .footer h4,
            .footer p {
              margin: 0;
              line-height: 1.2;
            }

            .right h6 {
              color: gray;
              text-align: right;
            }

            .underline {
              display: inline-block;
              border-bottom: 1px solid black;
              padding: 0 5px;
              min-width: 150px;
            }

            table h4,
            table p {
              margin-bottom: 0;
              line-height: 1;
            }
          </style>
        </head>
        <body>
          ${printContent}
        </body>
        </html>
      `);
      doc.close();

      iframe.onload = function () {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        iframe.contentWindow.onafterprint = function () {
          document.body.removeChild(iframe);
        };
      };
}



</script>

  
</body>
</html>
