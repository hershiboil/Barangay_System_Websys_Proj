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
                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <span class="material-icons me-2">person_outline</span>Profile
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <span class="material-icons me-2">settings</span>Settings
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                        <span class="material-icons me-2">logout</span>Logout
                      </a>
                    </li>
                    
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
        <h2>Former Officials</h2>

        <!--Search bar-->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <form class="m-0">
              <div class="search d-flex align-items-center">
                <span class="search-icon material-icons me-2">search</span>
                <input class="search-input form-control" type="search" placeholder="Search" id="searchInput">
              </div>
          </form>
          <!--Add New Official Button-->
          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewOfficial">+ Add new official</button>
             
                  <div class="col-12 mt-2">
                    <button type="button" id="exportCsvLink" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#exportModal">Export</button>
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


            <!--New Official Modal-->
            <div class="modal fade" id="addNewOfficial" tabindex="-1" aria-labelledby="multiStepModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <form class="modal-content" id="addNewOfficialForm" action="saveOfficial.php" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title" id="multiStepModalLabel">New Official Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                 
                  <div class="modal-body">
                    <!-- Personal Info -->
                    <div class="form-step active">
                      <div class="mt-3 mb-3" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-right: 20px; position: relative;">
                        <label for="searchResident" class="form-label" style="margin-bottom: 0; font-size: 0.9rem;">Search Resident:</label>
                        <input type="text" class="form-control form-control-sm" id="searchResident" name="searchResident" placeholder="Enter name or ID" onkeyup="searchResidents()" style="max-width: 200px;">
                        <ul id="searchResults" class="list-group" style="position: absolute; top: 100%; right: 20px; z-index: 1000; width: 200px; max-height: 150px; overflow-y: auto; display: none;"></ul>
                      </div>

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
                            <div class="mb-3">
                               <label for="resident_ID" class="form-label">Resident ID</label>
                               <input type="text" class="form-control" id="resident_ID" name="resident_ID" required>
                             </div>
                                      
                            <!--Position Dropdown-->
                            <div class="mb-3">
                              <label for="position" class="form-label">Position</label>
                              <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" id="positionDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                  Select Position
                                </button>
                                <ul class="dropdown-menu w-100 bg-white text-dark" aria-labelledby="positionDropdownBtn"></ul>
                                </div>
                                <input type="hidden" name="position" id="position" required>
                              <div class="invalid-feedback">Please select a position.</div>
                            </div>
                             <!--Term Dates-->
                             <div class="row">
                               <div class="col-md-6 mb-3">
                                 <label for="term_start" class="form-label">Term Start Date</label>
                                 <input type="date" name="term_start" id="term_start" class="form-control" required>
                                 <div class="invalid-feedback">Term Start Date is required.</div>
                               </div>
                                        
                               <div class="col-md-6 mb-3">
                                 <label for="term_end" class="form-label">Term End Date</label>
                                 <input type="date" name="term_end" id="term_end" class="form-control" required>
                                 <div class="invalid-feedback">Term End Date is required.</div>
                               </div>
                             </div>
                             <!-- Appointed or Elected Dropdown -->         
                             <div class="mb-3">
                               <label for="appointedOrElected" class="form-label">Appointed or Elected</label>
                               <input type="text" id="appointed_or_elected" name="appointed_or_elected" class="form-control d-none" required>
                               <div class="dropdown">
                                 <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" id="appointedDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                   Select Type
                                 </button>
                                 <ul class="dropdown-menu w-100 bg-white text-dark">
                                   <li><a class="dropdown-item" href="#" onclick="selectDropdown('appointed_or_elected', 'appointedDropdown', 'Appointed')">Appointed</a></li>
                                   <li><a class="dropdown-item" href="#" onclick="selectDropdown('appointed_or_elected', 'appointedDropdown', 'Elected')">Elected</a></li>
                                 </ul>
                               </div>
                            
                             <!-- Oath Taking Date -->
                             <div class="mt-3 mb-3">
                               <label for="oath_taking_date" class="form-label">Oath Taking Date</label>
                               <input type="date" name="oath_taking_date" id="oath_taking_date" class="form-control" required>
                               <div class="invalid-feedback">Oath Taking is required.</div>
                             </div>
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

                            <div class="mb-3">
                              <div class="row">
                                <div class="col-md-4 mb-3">
                                  <label for="age">Age</label>
                                  <input type="number" class="form-control" id="age" name="age" min="0" max="100"/>
                                </div>
                                <div class="col-md-4 mb-3">
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
                                <div class="col-md-4 mb-3">
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
                            <input type="text" class="form-control" id="tin_num" name="tin_num" />
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
                    <button type="submit" class="btn btn-success d-none" id="submitBtn">Save Official</button>
                  </div>
                </form>
              </div>

            </div>  

      </div>

        <table class="table table-borderless table-rounded">
            <thead class="table-primary">
              <tr>
                <th scope="col" style="width: 600px;">Officials Name</th>
                <th scope="col" style="width: 200px;">Position</th>
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


    function updateTogglePosition() {
      const isMobile = window.innerWidth <= 991;

      if (isMobile) {
        if (sidebar.classList.contains('active')) {
          sidebarToggleContainer.style.left= '234px';
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
        sidebarToggleContainer.style.left= '234px';
        sidebarToggleContainer.style.background = '#ebebeb';
          toggleButton.style.left = '239px';
        }
      }
    }

    toggleButton.addEventListener('click', () => {
      const isMobile = window.innerWidth <= 991;

      if (isMobile) {
        sidebar.classList.toggle('active');
      } else {
        sidebar.classList.toggle('sidebar-collapsed');
      }

      updateTogglePosition();

      if (
        sidebar.classList.contains('sidebar-collapsed') ||
        (window.innerWidth <= 991 && !sidebar.classList.contains('active'))
      ) {
        toggleIcon.innerText = 'chevron_right';
      } else {
        toggleIcon.innerText = 'chevron_left';
      }
    });

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

    updateDateTime();

    setInterval(updateDateTime, 1000);

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

    function selectDropdown(hiddenInputId, buttonId, value) {
        document.getElementById(hiddenInputId).value = value;
        document.getElementById(buttonId).textContent = value;
        document.getElementById(hiddenInputId).classList.remove('is-invalid');
        document.getElementById(hiddenInputId).setCustomValidity('');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const appointedDropdownMenu = document.querySelector('#appointedDropdown + ul');
        if (appointedDropdownMenu) {
            appointedDropdownMenu.addEventListener('click', function(e) {
                if (e.target.classList.contains('dropdown-item')) {
                    e.preventDefault();
                    selectDropdown('appointed_or_elected', 'appointedDropdown', e.target.textContent);
                }
            });
        }
    });

    const searchInput = document.getElementById('searchResident');
    const searchResultsList = document.getElementById('searchResults');

    if (searchInput && searchResultsList) {
        searchInput.addEventListener('focus', () => {
            if (searchResultsList.children.length > 0) {
                searchResultsList.style.display = 'block';
            }
        });

        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                searchResultsList.style.display = 'none';
            }, 200);
        });

        searchInput.addEventListener('keyup', () => {
            searchResidents();
        });
    }


    async function searchResidents() {
        const searchTerm = searchInput.value.trim();
        searchResultsList.innerHTML = '';
        searchResultsList.style.display = 'none';

        if (searchTerm.length > 2) {
            try {
                const response = await fetch(`searchResidentsForOfficial.php?query=${encodeURIComponent(searchTerm)}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const results = await response.json();

                if (results && results.length > 0) {
                    searchResultsList.style.display = 'block';
                    results.forEach(resident => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('list-group-item', 'list-group-item-action');
                        listItem.textContent = `${resident.first_name} ${resident.last_name} (ID: ${resident.resident_ID})`;
                        listItem.dataset.resident = JSON.stringify(resident);
                        listItem.addEventListener('click', () => {
                            populateResidentData(JSON.parse(listItem.dataset.resident));
                            searchResultsList.style.display = 'none';
                        });
                        searchResultsList.appendChild(listItem);
                    });
                } else {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item');
                    listItem.textContent = 'No residents found.';
                    searchResultsList.appendChild(listItem);
                    searchResultsList.style.display = 'block';
                }
            } catch (error) {
                console.error('Error fetching residents:', error);
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'list-group-item-danger');
                listItem.textContent = 'Error loading residents.';
                searchResultsList.appendChild(listItem);
                searchResultsList.style.display = 'block';
            }
        }
    }

    function populateResidentData(resident) {
        if (!resident) {
            console.warn('populateResidentData called with empty resident data');
            return;
        }

        document.getElementById('resident_ID').value = resident.resident_ID || '';
        document.getElementById('first_name').value = resident.first_name || '';
        document.getElementById('middle_name').value = resident.middle_name || '';
        document.getElementById('last_name').value = resident.last_name || '';
        document.getElementById('suffix').value = resident.suffix || '';
        document.getElementById('nick_name').value = resident.nick_name || '';

        document.getElementById('birthdate').value = resident.birthdate || '';
        document.getElementById('birthplace').value = resident.birthplace || '';
        document.getElementById('age').value = resident.age || '';

        document.getElementById('gender').value = resident.gender || '';
        document.getElementById('blood_type').value = resident.blood_type || '';
        document.getElementById('civil_status').value = resident.civil_status || '';
        document.getElementById('nationality').value = resident.nationality || '';
        document.getElementById('religion').value = resident.religion || '';

        document.getElementById('contact_number').value = resident.contact_number || '';
        document.getElementById('email').value = resident.email || '';

        document.getElementById('province').value = resident.province || '';
        document.getElementById('municipality').value = resident.municipality || '';
        document.getElementById('zip_code').value = resident.zip_code || '';
        document.getElementById('barangay').value = resident.barangay || '';
        document.getElementById('purok').value = resident.purok || '';
        document.getElementById('street').value = resident.street || '';

        document.getElementById('father_name').value = resident.father_name || '';
        document.getElementById('father_contact').value = resident.father_contact || '';
        document.getElementById('mother_name').value = resident.mother_name || '';
        document.getElementById('mother_contact').value = resident.mother_contact || '';
        document.getElementById('spouse_name').value = resident.spouse_name || '';
        document.getElementById('spouse_contact').value = resident.spouse_contact || '';
        document.getElementById('guardian_name').value = resident.guardian_name || '';
        document.getElementById('guardian_relation').value = resident.guardian_relation || '';
        document.getElementById('guardian_contact').value = resident.guardian_contact || '';

        document.getElementById('national_ID_num').value = resident.national_ID_num || '';
        document.getElementById('sss_num').value = resident.sss_num || '';
        document.getElementById('tin_num').value = resident.tin_num || '';
        document.getElementById('gsis_num').value = resident.gsis_num || '';
        document.getElementById('pagibig_num').value = resident.pagibig_num || '';
        document.getElementById('philhealth_num').value = resident.philhealth_num || '';

        document.getElementById('resident_status').value = resident.resident_status || '';
        document.getElementById('voter').value = resident.voter || '';
        document.getElementById('pwd').value = resident.pwd || '';
        document.getElementById('senior_citizen').value = resident.senior_citizen || '';
        document.getElementById('solo_parent').value = resident.solo_parent || '';
        document.getElementById('is_4ps').value = resident.is_4ps || '';

        document.getElementById('profilePreview').src = resident.profile_photo|| 'img/default.png';

        searchInput.value = `${resident.first_name} ${resident.last_name}`;
        searchResultsList.style.display = 'none';
    }


    function populatePositionDropdown() {
        const positionDropdownBtn = document.getElementById('positionDropdownBtn');
        const positionDropdownMenu = document.querySelector('#positionDropdownBtn + .dropdown-menu');
        const positionInput = document.getElementById('position');

        if (positionDropdownBtn && positionDropdownMenu && positionInput) {
            fetch('getPositionOptions.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`JS: HTTP error, status = ${response.status}`);
                    }
                    return response.json();
                })
                .then(positions => {
                    if (!positions || positions.length === 0) {
                        positionDropdownMenu.innerHTML = '<li><a class="dropdown-item disabled">No positions found</a></li>';
                        return;
                    }

                    positionDropdownMenu.innerHTML = '';
                    positions.forEach(position => {
                        const li = document.createElement('li');
                        const button = document.createElement('a');
                        button.classList.add('dropdown-item');
                        button.href = '#';
                        button.dataset.id = position.id;
                        button.textContent = position.name;

                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            positionInput.value = this.dataset.id;
                            positionDropdownBtn.textContent = this.textContent;
                        });

                        li.appendChild(button);
                        positionDropdownMenu.appendChild(li);
                    });
                })
                .catch(error => {
                    console.error('JS: Error fetching positions:', error);
                    positionDropdownMenu.innerHTML = '<li><a class="dropdown-item disabled">Error loading positions</a></li>';
                });
        }
    }

    document.addEventListener('DOMContentLoaded', populatePositionDropdown);


    const addNewOfficialForm = document.getElementById('addNewOfficialForm');
    if (addNewOfficialForm) {
        addNewOfficialForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const currentActiveStep = document.querySelector('.form-step.active');
            let allFieldsValid = true;
            if (currentActiveStep) {
                currentActiveStep.querySelectorAll('[required]').forEach(input => {
                    if (!input.checkValidity()) {
                        allFieldsValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
            }


            const residentId = document.getElementById('resident_ID').value;
            const position = document.getElementById('position').value;

            if (!residentId) {
                alert('Please select a resident first.');
                allFieldsValid = false;
            }
            if (!position) {
                alert('Please select an official position.');
                allFieldsValid = false;
            }

            if (!allFieldsValid) {
                return;
            }

            const formData = new FormData(this);
            formData.append('resident_ID', residentId);
            formData.append('position_id', position);

            try {
                const response = await fetch('saveOfficial.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.status === 'success') {
                    alert(data.message);
                    addNewOfficialForm.reset();
                    document.getElementById('profilePreview').src = 'img/default.png';
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addNewOfficial'));
                    if (modal) modal.hide();
                    fetchAndDisplayOfficials();
                } else {
                    alert('Error saving official: ' + data.message);
                }
            } catch (error) {
                console.error('Fetch error during save official:', error);
                alert('An error occurred while trying to save the official.');
            }
        });
    } else {
        console.error("Error: 'addNewOfficialForm' element not found.");
    }

    const addNewOfficialModalElement = document.getElementById('addNewOfficial');
    if (addNewOfficialModalElement) {
        addNewOfficialModalElement.addEventListener('show.bs.modal', function () {
            currentStep = 0;
            showStep(currentStep);

            addNewOfficialForm.reset();
            document.getElementById('profilePreview').src = 'img/default.png';

            populatePositionDropdown();

            if (searchInput) searchInput.value = '';
            if (searchResultsList) searchResultsList.innerHTML = '';
            if (searchResultsList) searchResultsList.style.display = 'none';

            document.getElementById('resident_ID').value = '';
        });
    }

    (function () {
      'use strict';
      window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity() && form.id !== 'addNewOfficialForm') {
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
        const mainSearchInput = document.getElementById('searchInput');

        if (exportCsvLink && mainSearchInput) {
            exportCsvLink.addEventListener('click', function(event) {
                event.preventDefault();
                const searchTerm = mainSearchInput.value;
                exportCsvLink.href = 'export_csv.php?search=' + encodeURIComponent(searchTerm);
                window.location.href = exportCsvLink.href;
            });
        } else {
            if (!exportCsvLink) {
                console.warn("Element with ID 'exportCsvLink' not found.");
            }
            if (!mainSearchInput) {
                console.warn("Element with ID 'searchInput' (for main table search) not found.");
            }
        }
    });

    const formSteps = document.querySelectorAll('.form-step');
    const nextBtn = document.getElementById('nextStep');
    const prevBtn = document.getElementById('prevStep');
    const submitBtn = document.getElementById('submitBtn');

    let currentStep = 0;

    function showStep(index) {
      formSteps.forEach((step, i) => {
        step.classList.toggle('active', i === index);
      });
      if (prevBtn) prevBtn.disabled = index === 0;
      if (nextBtn) nextBtn.classList.toggle('d-none', index === formSteps.length - 1);
      if (submitBtn) submitBtn.classList.toggle('d-none', index !== formSteps.length - 1);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const currentActiveStep = formSteps[currentStep];
            let allFieldsValid = true;
            currentActiveStep.querySelectorAll('[required]').forEach(input => {
                if (!input.checkValidity()) {
                    allFieldsValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (allFieldsValid) {
                if (currentStep < formSteps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            } else {
                alert('Please fill out all required fields in the current step before proceeding.');
            }
        });
    }


    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    }

    const officialsTableBody = document.getElementById('residentTableBody');

    const escapeHtmlString = (str) => {
        if (str === null || str === undefined) return '';
        return String(str).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
    };

    async function fetchAndDisplayOfficials(searchQuery = '') {
        let url = `getOfficials.php?query=${encodeURIComponent(searchQuery)}`;

        try {
            const response = await fetch(url);
            const officials = await response.json();

            if (officialsTableBody) {
                officialsTableBody.innerHTML = '';

                if (officials.length > 0) {
                    officials.forEach(official => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${escapeHtmlString(official.resident_ID)}</td>
                            <td>${escapeHtmlString(official.first_name)} ${official.middle_name ? escapeHtmlString(official.middle_name) + ' ' : ''}${escapeHtmlString(official.last_name)} ${official.suffix ? escapeHtmlString(official.suffix) : ''}</td>
                            <td>${escapeHtmlString(official.position_name || official.position)}</td> <td>${escapeHtmlString(official.term_start)}</td>
                            <td>${escapeHtmlString(official.term_end)}</td>
                            <td>${escapeHtmlString(official.status)}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                                        <span class="material-icons">more_horiz</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#"
                                              onclick="editOfficial(
                                                  '${escapeHtmlString(official.resident_ID)}',
                                                  '${escapeHtmlString(official.first_name)}',
                                                  '${escapeHtmlString(official.middle_name || '')}',
                                                  '${escapeHtmlString(official.last_name)}',
                                                  '${escapeHtmlString(official.suffix || '')}',
                                                  '${escapeHtmlString(official.nick_name || '')}',
                                                  '${escapeHtmlString(official.birthdate)}',
                                                  '${escapeHtmlString(official.birthplace || '')}',
                                                  '${escapeHtmlString(official.age)}',
                                                  '${escapeHtmlString(official.gender)}',
                                                  '${escapeHtmlString(official.blood_type || '')}',
                                                  '${escapeHtmlString(official.civil_status)}',
                                                  '${escapeHtmlString(official.nationality || '')}',
                                                  '${escapeHtmlString(official.religion || '')}',
                                                  '${escapeHtmlString(official.contact_number || '')}',
                                                  '${escapeHtmlString(official.email || '')}',
                                                  '${escapeHtmlString(official.province || '')}',
                                                  '${escapeHtmlString(official.municipality || '')}',
                                                  '${escapeHtmlString(official.zip_code || '')}',
                                                  '${escapeHtmlString(official.barangay || '')}',
                                                  '${escapeHtmlString(official.purok || '')}',
                                                  '${escapeHtmlString(official.street || '')}',
                                                  '${escapeHtmlString(official.father_name || '')}',
                                                  '${escapeHtmlString(official.father_contact || '')}',
                                                  '${escapeHtmlString(official.mother_name || '')}',
                                                  '${escapeHtmlString(official.mother_contact || '')}',
                                                  '${escapeHtmlString(official.spouse_name || '')}',
                                                  '${escapeHtmlString(official.spouse_contact || '')}',
                                                  '${escapeHtmlString(official.guardian_name || '')}',
                                                  '${escapeHtmlString(official.guardian_relation || '')}',
                                                  '${escapeHtmlString(official.guardian_contact || '')}',
                                                  '${escapeHtmlString(official.national_ID_num || '')}',
                                                  '${escapeHtmlString(official.sss_num || '')}',
                                                  '${escapeHtmlString(official.tin_num || '')}',
                                                  '${escapeHtmlString(official.gsis_num || '')}',
                                                  '${escapeHtmlString(official.pagibig_num || '')}',
                                                  '${escapeHtmlString(official.philhealth_num || '')}',
                                                  '${escapeHtmlString(official.resident_status)}',
                                                  '${escapeHtmlString(official.voter)}',
                                                  '${escapeHtmlString(official.pwd)}',
                                                  '${escapeHtmlString(official.senior_citizen)}',
                                                  '${escapeHtmlString(official.solo_parent)}',
                                                  '${escapeHtmlString(official.is_4ps)}',
                                                  '${escapeHtmlString(official.position_id)}', '${escapeHtmlString(official.term_start)}',
                                                  '${escapeHtmlString(official.term_end)}',
                                                  '${escapeHtmlString(official.appointed_or_elected)}',
                                                  '${escapeHtmlString(official.oath_taking_date)}'
                                                  )" data-bs-toggle="modal" data-bs-target="#editOfficialModal">
                                                Edit
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" onclick="handleDeleteOfficialClick('${escapeHtmlString(official.resident_ID)}')">Delete</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="archiveOfficial('${official.resident_ID}')">Archive</a></li>
                                    </ul>
                                </div>
                            </td>
                        `;
                        officialsTableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="7" class="text-center">No officials found.</td>`;
                    officialsTableBody.appendChild(row);
                }
            } else {
                console.error("Error: 'residentTableBody' element not found.");
            }
        } catch (error) {
            console.error('Error fetching officials:', error);
            if (officialsTableBody) {
                officialsTableBody.innerHTML = `<td colspan="7" class="text-center text-black">No officials yet.</td>`;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchAndDisplayOfficials();
    });
    const mainSearchInput = document.getElementById('searchInput'); 
    if (mainSearchInput) {
        mainSearchInput.addEventListener('keyup', () => {
            fetchAndDisplayOfficials(mainSearchInput.value);
        });
    }

    function editOfficial(
        resident_ID, first_name, middle_name, last_name, suffix, nick_name,
        birthdate, birthplace, age, gender, blood_type, civil_status, nationality, religion,
        contact_number, email, province, municipality, zip_code, barangay, purok, street,
        father_name, father_contact, mother_name, mother_contact, spouse_name, spouse_contact,
        guardian_name, guardian_relation, guardian_contact,
        national_ID_num, sss_num, tin_num, gsis_num, pagibig_num, philhealth_num,
        resident_status, voter, pwd, senior_citizen, solo_parent, is_4ps,
        position_id, term_start, term_end, appointed_or_elected, oath_taking_date
    ) {
        console.log('Editing official:', first_name, last_name, 'ID:', resident_ID);
    }

    async function handleDeleteOfficialClick(residentID) {
        if (confirm(`Are you sure you want to delete official with Resident ID: ${residentID}? This action cannot be undone.`)) {
            try {
                const response = await fetch('deleteOfficial.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `resident_ID=${encodeURIComponent(residentID)}`
                });
                const data = await response.json();
                if (data.status === 'success') {
                    alert(data.message);
                    fetchAndDisplayOfficials();
                } else {
                    alert('Error deleting official: ' + data.message);
                }
            } catch (error) {
                console.error('Fetch error during delete official:', error);
                alert('An error occurred while trying to delete the official.');
            }
        }
    }

    async function archiveOfficial(residentID) {
        if (confirm(`Are you sure you want to archive official with Resident ID: ${residentID}?`)) {
            try {
                const response = await fetch('archiveOfficial.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `resident_ID=${encodeURIComponent(residentID)}`
                });
                const data = await response.json();
                if (data.status === 'success') {
                    alert(data.message);
                    fetchAndDisplayOfficials();
                } else {
                    alert('Error archiving official: ' + data.message);
                }
            } catch (error) {
                console.error('Fetch error during archive official:', error);
                alert('An error occurred while trying to archive the official.');
            }
        }
    }

</script>
  
  
</body>
</html>

<?php $conn->close(); ?>