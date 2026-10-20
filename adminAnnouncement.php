<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Announcement</title>
  <title>Barangay Balinad Portal</title>
  <link rel="icon" href="barangayBalinad.png" type="image/png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="sidebar.css">
  <link rel="stylesheet" href="userDashboard.css">

  
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <title>Barangay Balinad Portal</title>
  <link rel="icon" href="barangayBalinad.png" type="image/png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="adminDashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>

  .post {
  display: flex; 
  align-items: center; 
  justify-content: start; 
  border-radius: 50px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  padding: 10px 24px;
  border: 1px solid black;
  }

  #postAnnouncement {
  margin: 0;
  font-size: 16px;
  }


  .announcementModal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.announcementModal form {
  background-color: #fff;
  padding: 30px;
  border-radius: 12px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.announcementModal h2 {
  margin-top: 0;
}

.announcementModal input,
.announcementModal textarea {
  width: 100%;
  padding: 10px;
  margin-top: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

#announcementBtn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  cursor: pointer;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.modal-header h2 {
  margin: 0;
  font-size: 24px;
}

.close-btn {
  font-size: 35px;
  font-weight: bold;
  background: none;
  border: none;
  color: #333;
  cursor: pointer;
  padding: 0 10px;
  line-height: 1;
}

.announcementList {
  padding: 20px;
  max-width: 100%;
  overflow-x: hidden;
}

.announcement-item {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  word-wrap: break-word;
  overflow-wrap: break-word;
  white-space: normal;
}

.announcement-item p,
.announcement-item h5 {
  word-break: break-word;
  overflow-wrap: break-word;
  white-space: normal;
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
                        <img src="user.png" style="width:40px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);" />
                        <span class="xp-user-live ms-1"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end small-menu position-absolute" id="profileDropdown">
                        <li><a class="dropdown-item" href="#"><span class="material-icons me-2">person_outline</span>Profile</a></li>
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
      
        
            
<!--------------------------------------->
            <div class="main-content p-4" id="maincontent" style="min-height: 100vh;">

              <div class="post" onclick="postAnnouncement()">
                <p id="postAnnouncement">Post an Announcement</p>
              </div>

              <div class="announcementModal">
                <form action="submitAnnouncement.php" method="POST">
                  <div class="modal-header">
                    <h2>Post an Announcement</h2>
                    <button type="button" class="close-btn" onclick="closeModal()" aria-label="Close">×</button>
                  </div>

                  <label for="title">Title</label>
                  <input type="text" id="title" name="title" required>

                  <label for="announcementContent">Content</label>
                  <textarea id="content" name="content" rows="6" required></textarea>

                  <button id="announcementBtn" type="submit">Post Announcement</button>
                </form>
              </div>

              <hr style="margin-top: 50px;">

              <div class="announcementList">  
                    <?php
                    $conn = new mysqli("localhost", "root", "", "barangay_db");

                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM announcement ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $isModified = ($row['modified'] === 'yes') ? "<span class='badge bg-warning text-dark'>Modified</span>" : "";

                        echo "
                        
                          <div class='announcement-item mb-3'>
                            <div class='d-flex justify-content-between align-items-center'>
                              <p class='small mb-1' style='color: #0077f7;'>
                                Announcement# " . $row['id'] . " | " . $row['dateToday'] . " $isModified
                              </p>

                              <div class='dropdown'>
                                <button class='btn btn-sm btn-light dropdown-toggle' type='button' id='dropdownMenuButton" . $row['id'] . "' data-bs-toggle='dropdown' aria-expanded='false'>
                                  ⋮
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton" . $row['id'] . "'>
                                  <li>
                                    <button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#editModal'
                                      data-id='" . $row['id'] . "' 
                                      data-title='" . htmlspecialchars($row['title'], ENT_QUOTES) . "' 
                                      data-content='" . htmlspecialchars($row['content'], ENT_QUOTES) . "'>Edit</button>
                                  </li>
                                  <li>
                                    <a class='dropdown-item text-danger' href='deleteAnnouncement.php?id=" . $row['id'] . "' 
                                      onclick='return confirm(\"Are you sure you want to delete this announcement?\")'>Delete</a>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <h5 class='announcement-title mb-2 fw-bold'>" . htmlspecialchars($row['title']) . "</h5>
                            <p>" . nl2br(htmlspecialchars($row['content'])) . "</p>
                            <hr>
                          </div>
                        ";

                      }
                    } else {
                      echo "<p style='text-align:center;'>No announcements posted yet.</p>";
                    }

                    $conn->close();
                    ?>
                </div>

                    <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <form action="updateAnnouncement.php" method="POST" class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <label for="edit-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                        <label for="edit-content" class="form-label mt-2">Content</label>
                        <textarea class="form-control" id="edit-content" name="content" rows="5" required></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Announcement</button>
                      </div>
                    </form>
                  </div>
                </div>

            </div>
<!-----END OF MAIN CONTENT-------->
      </div>      
    
    </div>
        
  </div>
    
</div>
  <!-- Bootstrap JS -->
   <!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="adminDashboard.js"></script>

  <script>


  function postAnnouncement(){
    document.querySelector('.announcementModal').style.display = 'flex';
    document.querySelector('.post').style.display = 'none';
  }

  function closeModal() {
  document.querySelector('.announcementModal').style.display = 'none';
  document.querySelector('.post').style.display = 'block';
  }

    document.addEventListener('DOMContentLoaded', function () {
      var editModal = document.getElementById('editModal');
      editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var title = button.getAttribute('data-title');
        var content = button.getAttribute('data-content');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-content').value = content;
      });
    });
  </script>
</body>
</html>