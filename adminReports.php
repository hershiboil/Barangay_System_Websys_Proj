<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Document</title>
  <title>Barangay Balinad Portal</title>
  <link rel="icon" href="barangayBalinad.png" type="image/png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="adminDashboard1.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }


        .container-choice {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 50px;
        }

        .status-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 190px;
        height: 190px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: 0.3s;
        }

        .status-box:hover {
        transform: scale(1.05);
        }

        .status-box span.material-icons {
        font-size: 36px;
        margin-bottom: 8px;
        }

        /* Optional background colors */
        .status-box.pending {
        background-color: #ffeaa7;
        }

        .status-box.reject {
        background-color: #fab1a0;
        }

        .status-box.approved {
        background-color: #a0e9a3;
        }

        

        .pending-modal, .claimed-modal, .approved-modal, .reject-modal, #back {
        display: none;
         flex-direction: column
        }

        .pending-modal {
        background: #ffffff;
        border: 1px solid #ccc;
        border-radius: 10px;
      }

      .title-box {
        padding: 30px;
        background: #0077f7;
        color: white;
        border-radius: 10px 10px 0 0; /* top-left, top-right, bottom-right, bottom-left */
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
              
          <li  class="">
            <a href="adminSettings.php"><i class="material-icons">settings</i><span>Settings
            </span></a>
        </li>
        </ul>

    </nav>

  <!--main content-->
  <div id="content" class="container-fluid px-3 py-4">
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

        <div class="title-box">
          <h3>Complaint Reports</h3>
        </div>

            <div class="container-choice row">

            <div class="status-box pending col-lg-4 col-md-4 col-sm-4" onclick="showPendingModal()" id="pending">
                <span class="material-icons">insert_drive_file</span>
                <h5>PENDING</h5>
            </div>

            <div class="status-box reject col-lg-4 col-md-4 col-sm-4" onclick="showRejectModal()" id="reject">
                <span class="material-icons">description</span>
                <h5>REJECTED</h5>
            </div>

            <div class="status-box approved col-lg-4 col-md-4 col-sm-4" onclick="showApprovedModal()" id="approved">
                <span class="material-icons">task</span>
                <h5>ACCOMPLISHED</h5>
            </div>

            </div>
        

            <div class="pending-modal container p-4 bg-light rounded shadow">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h3 class="text-primary m-0">Pending Requests</h3>
                  <button class="btn btn-primary ms-auto mb-3" onclick="exitPendingModal()" id="back" style="display: none;">
              ← Back
                </button>                  
                </div>

                <?php
                  $conn = new mysqli("localhost", "root", "", "barangay_db");

                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT f.id, f.type, f.report_status, f.description, f.created_at, r.first_name, r.middle_name, r.last_name 
                          FROM residents_info r
                          INNER JOIN complaints_entry f ON r.resident_ID = f.resident_ID
                          WHERE f.report_status = 'pending'";
                  $result = $conn->query($sql);
                ?>

                <table class="table table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th>Name</th>
                      <th>Complaint Type</th>
                      <th>Description</th>
                      <th>Date of complaint</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows <= 0): ?>
                      <tr>
                        <td colspan="2" class="text-danger text-center">No Complaint Reports yet.</td>
                      </tr>
                    <?php endif; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                          <form method="post" action="adminReportPending.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-success btn-sm accomplish-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#accomplishModal" 
                                    data-id="<?= $row['id'] ?>">
                              Accomplish
                            </button>
                            <button type="submit" name="reject" class="btn btn-danger btn-sm me-2">Reject</button>
                          </form>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
                      <div class="modal fade" id="accomplishModal" tabindex="-1" aria-labelledby="accomplishModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <form method="POST" action="adminReportPending.php">
                                <div class="modal-content">
                                  <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="accomplishModalLabel">SOLVE ISSUE</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="accomplish_id" id="accomplish_id">
                                    <div class="mb-3">
                                      <label for="reason" class="form-label">Provide Solutions To The Problem</label>
                                      <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="submit_accomplish" class="btn btn-success">Submit Solution</button>
                                  </div>
                                </div>
                              </form>
                            </div>               
                      </div>
                </div>

            <div class="approve-modal container my-4 p-4 border rounded shadow bg-white" style="display: none; flex-direction: column;">
                <h3 class="text-primary fw-bold">Accomplished Report Complaint</h3>
                <button class="btn btn-primary  ms-auto mb-3" onclick="exitApproveModal()" id="backApprove" style="display: none;">
              ← Back
                </button>  
                <?php
                  $conn = new mysqli("localhost", "root", "", "barangay_db");
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT f.id, f.type, f.solution, f.report_status, f.description, f.created_at, r.first_name, r.middle_name, r.last_name 
                        FROM residents_info r
                        INNER JOIN complaints_entry f ON r.resident_ID = f.resident_ID
                        WHERE f.report_status = 'accomplished'";
                        $result = $conn->query($sql);
                ?>

                <table class="table table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th>Name</th>
                      <th>Complaint Type</th>
                      <th>Complaint Solution</th>
                      <th>Date of complaint</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php if ($result->num_rows <= 0): ?>
                      <tr>
                        <td colspan="2" class="text-danger text-center">No Complaint Reports yet.</td>
                      </tr>
                    <?php endif; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['solution']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>

            </div>

            

            <div class="reject-modal container my-4 p-4 border rounded shadow bg-white" style="display: none; flex-direction: column;">
                <h3 class="text-primary fw-bold">Rejected Complaint</h3>
                <button class="btn btn-primary ms-auto mb-3" onclick="exitRejectModal()" id="backReject" style="display: none;">
              ← Back
                </button> 

                <?php
                  $conn = new mysqli("localhost", "root", "", "barangay_db");
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT f.id, f.type, f.report_status, f.description, f.created_at, r.first_name, r.middle_name, r.last_name 
                        FROM residents_info r
                        INNER JOIN complaints_entry f ON r.resident_ID = f.resident_ID
                        WHERE f.report_status = 'rejected'";
                        $result = $conn->query($sql);
                ?>

                <table class="table table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th>Name</th>
                      <th>Complaint Type</th>
                      <th>Description</th>
                      <th>Date of complaint</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php if ($result->num_rows <= 0): ?>
                      <tr>
                        <td colspan="2" class="text-danger text-center">No Complaint Reports yet.</td>
                      </tr>
                    <?php endif; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>

            </div>

            
            

    </div>
      
  </div>
  
</div>
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="adminDashboard.js"></script>
<script>


  //--------------------------REJECT MODAL--------------------------------
  document.querySelectorAll('.accomplish-btn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      document.getElementById('accomplish_id').value = id;
    });
  });

  
  //MODALS
  function showPendingModal() {
    document.getElementById('back').style.display = 'flex';
    document.querySelector('.pending-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }


  function showApprovedModal() {
    document.getElementById('backApprove').style.display = 'flex';
    document.querySelector('.approve-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }

   function showRejectModal() {
    document.getElementById('backReject').style.display = 'flex';
    document.querySelector('.reject-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }

  function exitPendingModal() {
    document.querySelector('.container-choice').style.display = 'flex';
    document.getElementById('pending').style.display = 'flex';
    document.getElementById('approved').style.display = 'flex';
    document.getElementById('reject').style.display = 'flex';

    document.getElementById('back').style.display = 'none';
    document.querySelector('.pending-modal').style.display = 'none';
    document.querySelector('.approve-modal').style.display = 'none';
    document.querySelector('.reject-modal').style.display = 'none';
  }

  function exitApproveModal() {
    document.querySelector('.container-choice').style.display = 'flex';
    document.getElementById('pending').style.display = 'flex';
    document.getElementById('approved').style.display = 'flex';
    document.getElementById('reject').style.display = 'flex';

    document.getElementById('backApprove').style.display = 'none';
    document.querySelector('.pending-modal').style.display = 'none';
    document.querySelector('.approve-modal').style.display = 'none';
    document.querySelector('.reject-modal').style.display = 'none';
  }

  function exitRejectModal() {
    document.querySelector('.container-choice').style.display = 'flex';
    document.getElementById('pending').style.display = 'flex';
    document.getElementById('approved').style.display = 'flex';
    document.getElementById('reject').style.display = 'flex';

    document.getElementById('backReject').style.display = 'none';
    document.querySelector('.pending-modal').style.display = 'none';
    document.querySelector('.approve-modal').style.display = 'none';
    document.querySelector('.reject-modal').style.display = 'none';
  }

  

</script>
   
  
</body>
</html>
