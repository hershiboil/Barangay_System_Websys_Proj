<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_id'])) {
    header("Location: frontpage.php"); // redirect if not logged in
    exit();
}

$resident_ID = $_SESSION['resident_id'];

$sql = "SELECT first_name, middle_name, last_name, barangay, municipality, province, purok, street, profile_photo FROM residents_info WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $first_Name = $row['first_name'];
    $middle_Initial = strtoupper(substr($row['middle_name'], 0, 1)) . ".";
    $last_Name = $row['last_name'];
    $address = $row['street'] . ', Purok ' . $row['purok'] . ', ' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];
    $user_profile = $row['profile_photo'];
} else {
   echo "Failed to retrieve user info.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="icon" href="barangayBalinad.png" type="image/png">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="adminDashboard1.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
  
    .panel {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-start;
      height: 200px;
      background-color: #0077f7;
      color: #fff;
      border-radius: 10px;
      padding: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .panel .icon-circle {
      background-color: rgb(255, 255, 255); /* translucent white */
      padding: 12px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
    }

    .panel .icon-circle i.material-icons {
      font-size: 28px;
      color: black;
    }

    .population {
      background: #f9f9f9;
      border: 1px solid black;
      border-radius: 10px;
      padding: 20px;
      height: 100%; 
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .equal-height-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px; 
    }

    .equal-height-row > .col-lg-6 {
      display: flex;
      flex-direction: column;
    }

    .population h5 {
      margin-bottom: 20px;
    }

    .card {
      margin-top: 20px;
    }


          .container-choice {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
    }

    .status-box {
      background-color: #f0f4ff; /* pastel blue */
      border-radius: 12px;
      padding: 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 119, 247, 0.15);
      border: 2px solid transparent;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .status-box i {
      font-size: 36px;
      margin-bottom: 8px;
      color: #0056c7;
      transition: color 0.3s ease;
    }

    .status-box h5 {
      font-size: 18px;
      color: #0056c7;
      margin: 0;
      transition: color 0.3s ease;
    }

    .status-box:hover {
      background-color: #0077f7;
      border-color: #0056c7;
      box-shadow: 0 6px 16px rgba(0, 119, 247, 0.3);
      transform: translateY(-3px);
    }

    .status-box:hover i,
    .status-box:hover h5 {
      color: white;
    }

    .thick-hr {
      border: none;
      height: 4px;
      background: rgb(66, 80, 94);
      border-radius: 8px;
      margin: 20px 0;
    }

    .stat{
      display:none;
      gap: 20px;
    }

    .statistics, .population, #tablePopulation {
        display: flex;
    }


    .officialBox {
    position: relative;
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    width: 230px;
  }

  .officialBox img {
    width: 100%;
    height: auto;
    border-radius: 5px;
  }

  .dots-button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    float: right;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #ffffff;
    min-width: 120px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    overflow: hidden;
  }

  .dropdown-content button {
    width: 100%;
    padding: 10px;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
  }

  .dropdown-content button:hover {
    background-color: #f0f0f0;
  }

   .population .card {
  max-width: 500px;
  margin: 20px auto;
  border-radius: 10px;
}


.calendar-container {
  max-width: 400px;
  margin: 40px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  font-family: 'Poppins', sans-serif;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.calendar-header h2 {
  font-size: 1.5rem;
  margin: 0;
}

.calendar-header button {
  background-color: #0d6efd;
  border: none;
  color: white;
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1rem;
}

.calendar-days,
.calendar-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 6px;
  text-align: center;
}

.calendar-days div {
  font-weight: 600;
  color: #555;
}

.calendar-dates div {
  padding: 10px 0;
  border-radius: 6px;
  background-color: #f1f3f5;
  transition: background 0.3s;
}

.calendar-dates div:hover {
  background-color: #0d6efd;
  color: white;
  cursor: pointer;
}

.today {
  background-color: #0d6efd;
  color: white;
}

.statistics{
    padding: 30px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.welcome-banner {
    background: linear-gradient(to right, #4A90E2, #5BC0EB, #83C5F7);
    border-radius: 12px;
    padding: 30px;
    font-family: 'Segoe UI', sans-serif;
    margin: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    color: white;
}

.welcome-content {
    display: flex;
    align-items: center;
}

@media (max-width: 768px) {
    .welcome-content {
        flex-direction: column;
        text-align: center;
}

.profile-img {
    margin: 0 0 15px 0;
   }
}

.profile-img {
    height: 120px;
    width: 120px;
    border-radius: 50%;
    margin-right: 20px;
}

.text-content span {
    font-size: 30px;
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #e0f0ff;
}

.text-content h2 {
    margin: 0;
    font-size: 24px;
    color: #004080;
    font-weight: bold;
}

.text-content p {
    margin: 5px 0 0;
    color: #004080;
    font-size: 18px;
}

a span {
    color: #d0e8ff;
}

</style>
  
  </head>
<body>

  <div class="wrapper d-flex">

    <nav id="sidebar">

      <div class="sidebar-header">
        <img src="barangayBalinad.png" class="logo-img"/>
        <div class="text-conatinerp">
          <h3>CONNECT</h3>
          <p>Balinad Daraga, Albay</p>
        </div>
        </div>
      <ul class="list-unstyled components">

        <li  class="">
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

        <li class="">
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

    <div id="content" class="flex-grow-1">
      <div class="top-navbar px-3 py-2 d-flex align-items-center justify-content-between" id="topnavbar" >
        <div class="d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap w-100">

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

            <div class="xp-profilebar d-flex align-items-center ms-auto">
            <nav class="navbar p-0">
              <ul class="nav navbar-nav flex-row align-items-center mb-0">

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

                  
      
                <!-- Profile Dropdown -->
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
       
       
       
        <!-----------------------------MAIN CONTENT------------------------------->
      
        <div class="main-content p-4" id="maincontent" style="min-height: 100vh;">
          <div class="welcome-banner">
            <div class="welcome-content">
              <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
              <div class="text-content">
                <span>CIUDAD NIN LEGAZPI: AN MAOGMANG LUGAR</span>
                <h2><?php echo strtoupper($first_Name . " " . $middle_Initial . " " . $last_Name); ?></h2>
                <p>Barangay Admin | <?php echo $address; ?></p>
              </div>    
            </div>
            </div>


        <!----CONTAINER CHOICE---------->
        <div class="container-choice row gx-4 gy-3">
                <div class="status-box col-lg-3 col-md-4 col-sm-6" onclick="showStatisticsModal()">
                    <i class="fas fa-chart-bar"></i>
                    <h5>Statistics</h5>
                </div>

                <div class="status-box col-lg-3 col-md-4 col-sm-6" onclick="showOfficialsModal()">
                    <i class="fas fa-user-tie"></i>
                    <h5>Officials</h5>
                </div>
        </div>
        <!----END CONTAINER CHOICE---------->
            <hr class="thick-hr">


  <!-------OFFICIALS----------------------->
        <div class="stat row g-3 justify-content-center mt-3">
            <h5>Barangay Officials</h5>
            <?php
                                $conn = new mysqli("localhost", "root", "", "barangay_db");

                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT officialID, officialName, officialPosition, imgPath FROM barangay_officials";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $officialID = htmlspecialchars($row['officialID']);
                    $officialName = htmlspecialchars($row['officialName']);
                    $officialPosition = htmlspecialchars($row['officialPosition']);
                    $imgPath = htmlspecialchars($row['imgPath']);

                    echo "
                    <div class='officialBox'>
                        <div class='dropdown' style='margin-left: 170px;'>
                        <button class='dots-button' onclick='toggleDropdown(this)'>⋮</button>
                        <div class='dropdown-content'>
                            <button onclick='updateOfficial(\"$officialID\", \"$officialName\", \"$imgPath\")'>Update</button>
                            <button onclick='deleteOfficial({$officialID})'>Delete</button>
                        </div>
                        </div>
                        <img src='{$imgPath}' alt='Official Image'>
                        <h5>{$officialName}</h5>
                        <h5 style='color: #0077f7; font-weight: bold;'>{$officialPosition}</h5>
                    </div>";
                }
                } else {
                echo "<p>No officials found.</p>";
                }

                $conn->close();
            ?>
        </div>
        <!-------END OFFICIALS----------------------->
        
        <div class="modal fade" id="updateOfficialModal" tabindex="-1" aria-labelledby="updateOfficialModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOfficialModalLabel">Update Official Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateOfficialForm" method="POST" action="update_official.php" enctype="multipart/form-data">
                    <input type="hidden" id="updateOfficialID" name="officialID">

                    <div class="mb-3">
                        <label for="newName" class="form-label">New Name:</label>
                        <input type="text" class="form-control" id="newName" name="newName" required>
                    </div>

                    <div class="mb-3">
                        <label for="newImage" class="form-label">New Image:</label>
                        <input type="file" class="form-control" id="newImage" name="newImage" accept="image/*">
                        <small class="text-muted">Leave blank to keep the current image.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image:</label>
                        <img id="currentOfficialImage" src="" alt="Current Official Image" style="max-width: 100px; height: auto; display: block; margin-top: 5px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

        <!------STATISTICS------------------->
        <div class="statistics row g-3 justify-content-center mt-3">
                  <h5>Statistics</h5>
                  <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="panel">
                      <div class="icon-circle">
                        <i class="material-icons">diversity_3</i>
                      </div>
                      <div>
                        <p>Total Population</p>
                        <?php
                          $conn = new mysqli("localhost", "root", "", "barangay_db");

                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }

                          $sql = "SELECT COUNT(*) AS population FROM residents_info";
                          $result = $conn->query($sql);

                          if ($result && $row = $result->fetch_assoc()) {
                            echo "<h6><strong>{$row['population']}</strong></h6>";
                          } else {
                            echo "<h6>Error retrieving population data.</h6>";
                          }

                          $conn->close();
                        ?>
                        
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="panel">
                      <div class="icon-circle">
                        <i class="material-icons">schedule</i>
                      </div>
                      <div>
                        <p>Certificate Request</p>
                        <?php
                          $conn = new mysqli("localhost", "root", "", "barangay_db");

                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }

                          $sql = "SELECT COUNT(*) AS pending_certificate FROM file_requests WHERE status = 'Pending'";
                          $result = $conn->query($sql);

                          if ($result && $row = $result->fetch_assoc()) {
                            echo "<h6><strong>{$row['pending_certificate']}</strong></h6>";
                          } else {
                            echo "<h6>Error retrieving population data.</h6>";
                          }

                          $conn->close();
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="panel">
                      <div class="icon-circle">
                        <i class="material-icons">assignment_late</i>
                      </div>
                      <div>
                        <p>Pending Reports</p>
                         <?php
                          $conn = new mysqli("localhost", "root", "", "barangay_db");

                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }

                          $sql = "SELECT COUNT(*) AS pending_report FROM complaints_entry WHERE report_status = 'pending'";
                          $result = $conn->query($sql);

                          if ($result && $row = $result->fetch_assoc()) {
                            echo "<h6><strong>{$row['pending_report']}</strong></h6>";
                          } else {
                            echo "<h6>Error retrieving population data.</h6>";
                          }

                          $conn->close();
                        ?>
                      </div>
                    </div>
                </div>
        <!------END STATISTICS------------------->
    

        <!------------POPULATION--------------------->
         <div class="row justify-content-center equal-height-row" style="margin-top: 30px;"> 
                    <div class="col-lg-4 col-md-3">
                      <div class="population">
                        <h5>POPULATION</h5>
                        <canvas id="purokChart" style="width: 100%; height: 300px;"></canvas>
                      </div>
                    </div>

                    <div class="col-lg-7 col-md-3">
                      <div class="population" id="tablePopulation">
                        <?php
                          $conn = new mysqli("localhost", "root", "", "barangay_db");

                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }

                          $sql = "
                            SELECT
                              SUM(CASE WHEN voter = 'yes' THEN 1 ELSE 0 END) AS voterCount,
                              SUM(CASE WHEN pwd = 'yes' THEN 1 ELSE 0 END) AS pwdCount,
                              SUM(CASE WHEN senior_citizen = 'yes' THEN 1 ELSE 0 END) AS seniorCount,
                              SUM(CASE WHEN solo_parent = 'yes' THEN 1 ELSE 0 END) AS soloCount,
                              SUM(CASE WHEN is_4ps = 'yes' THEN 1 ELSE 0 END) AS fourPsCount
                            FROM residents_info
                          ";

                          $result = $conn->query($sql);
                          if ($result && $row = $result->fetch_assoc()) {
                            echo "
                              <div class='card shadow-sm'>
                                <div class='card-header bg-primary text-white'>
                                  <h5 class='mb-0'>Population Breakdown</h5>
                                </div>
                                <div class='card-body'>
                                  <ul class='list-group'>
                                    <li class='list-group-item'>Voters: <strong>{$row['voterCount']}</strong></li>
                                    <li class='list-group-item'>PWD: <strong>{$row['pwdCount']}</strong></li>
                                    <li class='list-group-item'>Senior Citizens: <strong>{$row['seniorCount']}</strong></li>
                                    <li class='list-group-item'>Solo Parents: <strong>{$row['soloCount']}</strong></li>
                                    <li class='list-group-item'>4Ps Members: <strong>{$row['fourPsCount']}</strong></li>
                                  </ul>
                                </div>
                              </div>";
                          } else {
                            echo "<p>Error retrieving population data.</p>";
                          }

                          $conn->close();
                        ?>
                      </div>
                    </div>
                </div>

        <!------------END POPULATION--------------------->

        <!-----------------------------END MAIN CONTENT------------------------------->

      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="adminDashboard.js"></script>

<script>
    fetch('adminDashboardPie.php')
    .then(response => response.json())
    .then(data => {
      const labels = data.map(item => 'Purok ' + item.purok);
      const totals = data.map(item => item.total);

      const ctx = document.getElementById('purokChart').getContext('2d');
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            label: 'Residents Per Purok',
            data: totals,
            backgroundColor: [
              '#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8', '#6f42c1'
            ],
          }]
        }
      });
    });

    function showOfficialsModal() {
    document.querySelector('.stat').style.display = 'flex';
    document.querySelector('.population').style.display = 'none';
    document.getElementById('tablePopulation').style.display = 'none';
    document.querySelector('.statistics').style.display = 'none';
    }

    function showStatisticsModal() {
    document.querySelector('.statistics').style.display = 'flex';
    document.querySelector('.population').style.display = 'flex';
    document.getElementById('tablePopulation').style.display = 'flex';
    document.querySelector('.stat').style.display = 'none';
    }

   


      function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

        // Close other dropdowns
        document.querySelectorAll('.dropdown-content').forEach(function (menu) {
          if (menu !== dropdown) menu.style.display = 'none';
        });
      }

      // Optional: close dropdowns when clicking outside
      window.onclick = function (event) {
        if (!event.target.matches('.dots-button')) {
          document.querySelectorAll('.dropdown-content').forEach(function (menu) {
            menu.style.display = 'none';
          });
        }
      };

      

      function updateOfficial(officialID, currentName, currentImagePath) {
        // Get the modal element
        const updateOfficialModal = new bootstrap.Modal(document.getElementById('updateOfficialModal'));

        // Get the form elements
        const updateOfficialIDInput = document.getElementById('updateOfficialID');
        const newNameInput = document.getElementById('newName');
        const currentOfficialImage = document.getElementById('currentOfficialImage');

        // Set the official ID in the hidden input field
        updateOfficialIDInput.value = officialID;

        // Set the current name in the name input field
        newNameInput.value = currentName;

        // Set the current image source
        currentOfficialImage.src = currentImagePath;

        // Show the modal
        updateOfficialModal.show();
        }

        function deleteOfficial(officialID) {
    if (confirm("Are you sure you want to reset this official's name and image?")) {
        // Create a form dynamically
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "delete_official.php";

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "officialID";
        input.value = officialID;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}
  </script>
</body>
</html>