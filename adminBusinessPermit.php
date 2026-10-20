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

        .container-choice {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .pending {
            background-color: #fce4ec;
            border-left: 5px solid #ec407a;
        }

        .claimed {
            background-color: #e8f5e9;
            border-left: 5px solid #66bb6a;
        }

        .approved {
            background-color: #e3f2fd;
            border-left: 5px solid #42a5f5;
        }

        .reject {
            background-color: #ffebee;
            border-left: 5px solid #f44336;
        }

        .status-box h3 {
            font-weight: 600;
            color: #333;
        }

        .status-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }



        .status-box {
            height: 80px; /* Set thinner height */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 0 20px; /* Horizontal padding only */
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
                    <li><a class="dropdown-item" href="#"><span class="material-icons me-2">logout</span>Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
      
        </div>
      </div>      
    <!--end of top-navbar-->
    

        <div class="main-content p-4" id="maincontent" style="min-height: 100vh;">

          <h1>BUSINESS PERMIT</h1>
            <div class="container-choice">

            <div class="status-box pending" onclick="showPendingModal()" id="pending">
                <h3>PENDING</h3>
            </div>

            <div class="status-box claimed" onclick="showClaimedModal()" id="claimed">
                <h3>CLAIM</h3>
            </div>

            <div class="status-box approved" onclick="showApprovedModal()" id="approved">
                <h3>APPROVED</h3>
            </div>

            <div class="status-box reject" onclick="showRejectModal()" id="reject">
                <h3>REJECTS</h3>
            </div>

            </div>
            
            <button class="btn btn-primary ms-auto mb-3" onclick="exitModal()" id="back" style="display: none;">
              ← Back
            </button>

            <div class="pending-modal container p-4 bg-light rounded shadow">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h3 class="text-primary m-0">Pending Requests</h3>                  
                </div>

                <?php
                  $conn = new mysqli("localhost", "root", "", "barangay_db");

                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT f.id, f.status, r.first_name, r.middle_name, r.last_name 
                          FROM residents_info r
                          INNER JOIN file_requests f ON r.resident_ID = f.resident_ID
                          WHERE f.status = 'Pending' AND f.request_type = 'businessPermit'";
                  $result = $conn->query($sql);
                ?>

                <table class="table table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows <= 0): ?>
                      <tr>
                        <td colspan="2" class="text-danger text-center">No Business certificate requests yet.</td>
                      </tr>
                    <?php endif; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                        <td>
                          <form method="post" action="certificatePendingBusiness.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="approve" class="btn btn-success btn-sm me-2">Approve</button>
                            <button type="button" class="btn btn-danger btn-sm reject-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#rejectModal" 
                                    data-id="<?= $row['id'] ?>">
                              Reject
                            </button>
                          </form>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
                <!-- Reject Reason Modal -->
                      <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <form method="POST" action="certificatePendingBusiness.php">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="rejectModalLabel">Rejection Reason</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="reject_id" id="reject_id">
                                <div class="mb-3">
                                  <label for="reason" class="form-label">Reason for Rejection:</label>
                                  <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submit_reject" class="btn btn-danger">Submit Rejection</button>
                              </div>
                            </div>
                          </form>
                        </div>               
                   </div>
                </div>

            <div class="approved-modal container my-4 p-4 border rounded shadow bg-white" style="display: none; flex-direction: column;">

                <!-- Title -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h3 class="text-primary fw-bold">Approved Requests</h3>
                </div>

                <!-- PHP Table -->
                <?php
                    $conn = new mysqli("localhost", "root", "", "barangay_db");
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT f.id, f.status, r.first_name, r.middle_name, r.last_name 
                            FROM residents_info r
                            INNER JOIN file_requests f ON r.resident_ID = f.resident_ID
                            WHERE f.status = 'Approved' AND f.request_type = 'businessPermit'";
                    $result = $conn->query($sql);
                ?>

                <div class="table-responsive">
                  <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) . "</td>
                            <td>
                              <button type='button' class='btn btn-success btn-sm claim-btn' data-bs-toggle='modal' data-bs-target='#claimModal' data-id='{$row['id']}'>
                                Claim
                              </button>
                            </td>
                          </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='3' class='text-danger text-center'>No approved certificates yet.</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <form method="POST" action="certificateClaimBusiness.php">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="claimModalLabel">Set Dates</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="request_id" id="request_id">
                          <label for="claim_date" class="form-label">Claim Date:</label>
                          <input type="date" name="claim_date" class="form-control" required>
                        
                          <label for="expiration_date" class="form-label">Expiration Date:</label>
                          <input type="date" name="expiration_date" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" name="save_claim_date" class="btn btn-primary">Save Date</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>


            
            <div class="claimed-modal container my-4 p-4 border rounded shadow bg-white" style="display: none; flex-direction: column;">
                <h3 class="text-primary fw-bold">Claim Requests</h3>
                
                <?php
                  $conn = new mysqli("localhost", "root", "", "barangay_db");
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT f.id, f.business_location, f.business_name, f.expired_at, f.claim_date, f.status, r.first_name, r.middle_name, r.last_name, r.occupation, r.purok 
                          FROM residents_info r
                          INNER JOIN file_requests f ON r.resident_ID = f.resident_ID
                          WHERE f.status = 'Claimed' AND f.request_type = 'businessPermit'";
                  $result = $conn->query($sql);
                ?>

                <table class="table table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th>Name</th>
                      <th>Claim Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows <= 0): ?>
                            <tr>
                              <td colspan="2" class="text-danger text-center">No Business certificate claimed yet.</td>
                            </tr>
                          <?php endif; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['claim_date']) ?></td>
                        <td>
                          <form method="post" action="updateIndigency.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button"
                              class="btn btn-outline-primary btn-sm"
                              onclick="printIndigencyFromRow(
                                '<?= $row['first_name'] ?>',
                                '<?= $row['middle_name'] ?>',
                                '<?= $row['last_name'] ?>',
                                '<?= $row['business_location'] ?>',
                                '<?= $row['business_name'] ?>',
                                '<?= $row['expired_at'] ?>',
                                '<?= $row['claim_date'] ?>'
                              )">
                              🖨️ Print
                            </button>
                          </form>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>

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
                                      <h1>BARANGAY BUSINESS PERMIT</h1>
                                  </div>
                              
                                  <div class="text-body">
                                      
                                      <p style="font-weight: bold; margin-top: 20px;">TO WHOM IT MAY CONCERN:</p>

                                      
                                      <div class="details">
                                       
                                          <div class="part-container">
                                            <p>Pursuant to existing ordinance of this barangay, CLEARANCE is granted to<span class="underlineName" id="print_first_name"></span><span class="underlineName" id="print_middle_name"></span><span class="underlineName" id="print_last_name"></span></p>
                                                              
                                          </div>

                                          <div class="part-container">
                                            <p>And owner of <span class="underlineBusiness" id="print_business_name"></span></p>                      
                                          </div>

                                          <div class="part-container">
                                            <p>Located at <span class="underlineBusiness" id="print_business_location"></span></p>                      
                                          </div>

                                  
                                          
                                      </div>
                        
                                      <div class="part-container">
                                          <p>Applicant is hereby advised to follow strictly existing ordinance in relation with the conduct of his/her business. Violation of the same is a ground for the revocation of this clearance.</p>
                                    </div>
                              
                                    <div class="paragraph">
                                      <p>Clearance is valid up to <span class="underline" id="print_expired_at"></span> unless revoked due to a valid cause.</p>
                                    </div >

                                    <div class="paragraph">
                                      <p>Issued this <span class="underline" id="print_claim_date"></span> at Barangay Balinad Daraga, Albay Philippines</p>
                                    </div >

                                    <div class="footer">
                                      <h4>Leni Robredo</h4>
                                      <p>Punong Barangay</p>
                                    </div>
                                                
                                  </div>
                        
                                  <h6>Not valid without seal</h6>
                              </div>
                            </div>
            </div>

            
              <div class="reject-modal container my-4 p-4 border rounded shadow bg-white" style="display: none; flex-direction: column;">
                <h3 class="text-primary fw-bold">Rejected Requests</h3>
                
                    <?php
                        $conn = new mysqli("localhost", "root", "", "barangay_db");

                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT f.id, f.rejection_reason, f.status, r.first_name, r.middle_name, r.last_name 
                                FROM residents_info r
                                INNER JOIN file_requests f ON r.resident_ID = f.resident_ID
                                WHERE f.status = 'Rejected' AND f.request_type = 'businessPermit'";
                        $result = $conn->query($sql);
                    ?>

                        <table class="table table-bordered text-center">
                        <thead class="table-dark">
                          <tr>
                            <th>Name</th>
                            <th>Rejection Reason</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($result->num_rows <= 0): ?>
                            <tr>
                              <td colspan="2" class="text-danger text-center">No BUsiness certificate rejected yet.</td>
                            </tr>
                          <?php endif; ?>
                          <?php while ($row = $result->fetch_assoc()):
                          ?>
                            <tr>
                              <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                              <td><?= htmlspecialchars($row['rejection_reason']) ?></td>

                            </tr>
                          <?php endwhile; ?>
                        </tbody>
                      </table>
                          </div>
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



  //-------------------------PRINT MODAL---------------------------------
  function printIndigencyFromRow(firstName, middleName, lastName, business_location, business_name, expired_at, claimDate) {
    // Set content into print placeholders
    document.getElementById("print_first_name").textContent = firstName || "<i>Not provided</i>";
    document.getElementById("print_middle_name").textContent = middleName || "<i>Not provided</i>";
    document.getElementById("print_last_name").textContent = lastName || "<i>Not provided</i>";
    document.getElementById("print_business_location").textContent = business_location || "<i>Not provided</i>";
    document.getElementById("print_business_name").textContent = business_name || "<i>Not provided</i>";
    document.getElementById("print_expired_at").textContent = expired_at || "<i>Not provided</i>";
    document.getElementById("print_claim_date").textContent = claimDate || "<i>Not provided</i>";

    // Get print content
    const printContent = document.getElementById("print-section").innerHTML;

    // Create iframe and print
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
                font-family: 'Poppins', sans-serif;
                font-size: 16px;
                line-height: 1.6;
                background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
                color: #1a237e;
            }

            .print-button {
                background: linear-gradient(90deg, #1976d2 0%, #0d6efd 100%);
                color: #fff;
                border: none;
                padding: 8px 20px;
                font-size: 16px;
                font-weight: 500;
                border-radius: 6px;
                cursor: pointer;
                transition: background 0.3s, box-shadow 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 2px 8px rgba(13, 110, 253, 0.08);
            }

            .print-button:hover, .btn-primary:hover, .btn-success:hover, .btn-danger:hover, .btn-outline-primary:hover {
                background: linear-gradient(90deg, #0a58ca 0%, #1976d2 100%);
                color: #fff;
                box-shadow: 0 4px 16px rgba(13, 110, 253, 0.15);
            }

            .print-button:active {
                background: #0a58ca;
            }

            .container-choice {
                display: flex;
                flex-direction: row;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                justify-content: space-between;
                gap: 24px;
                flex-wrap: wrap;
                margin-bottom: 32px;
            }

            .status-box {
                height: 90px;
                min-width: 180px;
                box-shadow: 0 4px 16px rgba(13, 110, 253, 0.08);
                border-radius: 12px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: transform 0.3s, box-shadow 0.3s;
                padding: 0 24px;
                cursor: pointer;
                border: 2px solid transparent;
            }

            .status-box h3 {
                font-weight: 700;
                color: #0d47a1;
                letter-spacing: 1px;
            }

            .status-box:hover {
                transform: translateY(-6px) scale(1.03);
                box-shadow: 0 8px 24px rgba(13, 110, 253, 0.18);
                border-color: #1976d2;
            }

            .pending {
                background: #e3f2fd;
                border-left: 6px solid #1976d2;
            }

            .claimed {
                background: #bbdefb;
                border-left: 6px solid #0d6efd;
            }

            .approved {
                background: #e1f5fe;
                border-left: 6px solid #42a5f5;
            }

            .reject {
                background: #f8bbd0;
                border-left: 6px solid #d32f2f;
            }

            .pending-modal, .claimed-modal, .approved-modal, .reject-modal, #back {
                display: none;
                flex-direction: column;
            }

            .pending-modal, .claimed-modal, .approved-modal, .reject-modal {
                background: #f5faff;
                border: 1.5px solid #90caf9;
                border-radius: 14px;
                box-shadow: 0 6px 24px rgba(13, 110, 253, 0.10);
            }

            .table thead.table-dark {
                background: linear-gradient(90deg, #1976d2 0%, #0d6efd 100%) !important;
                color: #fff;
            }

            .table-bordered > :not(caption) > * > * {
                border-color: #90caf9;
            }

            .btn-primary, .btn-success, .btn-danger, .btn-outline-primary {
                border-radius: 6px;
                font-weight: 500;
                transition: background 0.2s, color 0.2s;
            }

            .btn-outline-primary {
                color: #1976d2;
                border-color: #1976d2;
                background: #fff;
            }

            .btn-outline-primary:hover {
                background: #1976d2;
                color: #fff;
            }

            #back {
                background: #1976d2;
                color: #fff;
                border-radius: 6px;
                font-weight: 500;
                border: none;
                transition: background 0.2s;
            }

            #back:hover {
                background: #0d47a1;
            }

            h1, h3, h4 {
                color: #0d47a1;
                font-weight: 700;
            }

            ::-webkit-scrollbar-thumb {
                background: #90caf9;
                border-radius: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #e3f2fd;
            }
            ::-webkit-scrollbar {
                width: 8px;
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



  //--------------------------REJECT MODAL--------------------------------
  document.querySelectorAll('.reject-btn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      document.getElementById('reject_id').value = id;
    });
  });

  //--------------------------CLAIMED MODAL-------------------------------
  const claimButtons = document.querySelectorAll('.claim-btn');
  const requestIdInput = document.getElementById('request_id');

  claimButtons.forEach(button => {
    button.addEventListener('click', () => {
      const requestId = button.getAttribute('data-id');
      requestIdInput.value = requestId;
    });
  });

  //MODALS
  function showPendingModal() {
    document.getElementById('back').style.display = 'flex';
    document.querySelector('.pending-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('claimed').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }

  function showClaimedModal() {
    document.getElementById('back').style.display = 'flex';
    document.querySelector('.claimed-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('claimed').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }
 
  function showApprovedModal() {
    document.getElementById('back').style.display = 'flex';
    document.querySelector('.approved-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('claimed').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }

  function showRejectModal() {
    document.getElementById('back').style.display = 'flex';
    document.querySelector('.reject-modal').style.display = 'flex';
    document.getElementById('pending').style.display = 'none';
    document.getElementById('claimed').style.display = 'none';
    document.getElementById('reject').style.display = 'none';
    document.getElementById('approved').style.display = 'none';
  }

  function exitModal() {
    document.querySelector('.container-choice').style.display = 'flex';
    
    document.getElementById('pending').style.display = 'flex';
    document.getElementById('claimed').style.display = 'flex';
    document.getElementById('reject').style.display = 'flex';
    document.getElementById('approved').style.display = 'flex';



    document.getElementById('back').style.display = 'none';
    document.querySelector('.pending-modal').style.display = 'none';
    document.querySelector('.claimed-modal').style.display = 'none';
    document.querySelector('.approved-modal').style.display = 'none';
    document.querySelector('.reject-modal').style.display = 'none';
  }

  

</script>
   
  
</body>
</html>
