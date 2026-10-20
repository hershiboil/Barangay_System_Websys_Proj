<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['resident_ID'])) {
    header("Location: frontpage.php"); // redirect if not logged in
    exit();
}

$resident_ID = $_SESSION['resident_ID'];

$sql = "SELECT first_name, middle_name, last_name, barangay, municipality, province, purok, street, profile_photo FROM residents_info WHERE resident_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resident_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
    $middleInitial = strtoupper(substr($row['middle_name'], 0, 1)) . ".";
    $lastName = $row['last_name'];
     $address = $row['street'] . ', Purok ' . $row['purok'] . ', ' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'];
    $user_profile = $row['profile_photo'];
} else {
   echo "Failed to retrieve user info.";
    exit();
}

$sql = "SELECT id, title, content, dateToday FROM announcement ORDER BY dateToday DESC";
$announcementResult = $conn->query($sql);

$total_query = "SELECT COUNT(*) AS total FROM residents_info";
$total_result = $conn->query($total_query);
$total_population = $total_result->fetch_assoc()['total'];

$purok_query = "SELECT purok, COUNT(*) AS count FROM residents_info GROUP BY purok";
$purok_result = $conn->query($purok_query);

$labels = [];
$counts = [];
while ($row = $purok_result->fetch_assoc()) {
    $labels[] = $row['purok'];
    $counts[] = $row['count'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Document</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="sidebar.css">
  <link rel="stylesheet" href="userDashboard1.css">

  <style>
   .card-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: flex-start;
}

.event-card { 
  background-color: #f0f8ff;
  border: 1px solid #ccc;
  border-radius: 12px;
  padding: 20px;
  width: 100%;
  max-width: 300px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  word-wrap: break-word;
  overflow-wrap: break-word;
  white-space: normal;
  flex: 1 1 300px;

}

.event-card h3,
.event-card h4,
.event-card p {
  margin: 0 0 10px;
  word-wrap: break-word;
  overflow-wrap: break-word;
}

.learn-more-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 500;
}

.learn-more-link:hover {
  text-decoration: underline;
}

.announcement {
  padding: 40px 20px;
 
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}


  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const badge = document.getElementById("userNotificationCount");
      const notificationToggle = document.getElementById("userNotificationToggle");
      const notificationDropdown = document.getElementById("userNotificationDropdown");
      const closeBtn = document.getElementById("closeUserNotifications");

      let currentCount = 0;

      function updateBadge() {
        const lastSeen = parseInt(localStorage.getItem('lastSeenUserNotificationCount')) || 0;

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
        fetch('userNotifications.php')
          .then(response => response.json())
          .then(data => {
            if (data.total !== undefined) {
              currentCount = data.total;
              updateBadge();
            }
          })
          .catch(error => {
            console.error('Error fetching user notifications:', error);
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
          localStorage.setItem('lastSeenUserNotificationCount', currentCount);
          updateBadge();
        }
      });

      // Close button in dropdown
      closeBtn.addEventListener('click', () => {
        notificationDropdown.style.display = 'none';
      });

      // Refresh every 10 seconds
      setInterval(fetchNotificationCount, 10000);
    });
    </script>


  
</head>
<body>

<div class="wrapper d-flex">
    
    <!-- Sidebar -->
    <nav id="sidebar">
  
        <div class="sidebar-header">
          <img src="img/barangayBalinad.png" class="logo-img"/>
          <div class="text-container">
            <h3>CONNECT</h3>
            <p>Balinad Daraga, Albay</p>
          </div>
        </div>

        <ul class="list-unstyled components">
            <li  class="">
                <a href="userDashboard.php" class="load-page" data-page="userDashboard.php"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
            </li>
            <li  class="">
                <a href="userRequest.php" class="load-page" data-page="userRequest.php"><i class="material-icons">description</i><span>Certificates</span></a>
            </li>
            <li  class="">
                <a href="userReport.php" class="load-page" data-page="userReport.php"><i class="material-icons">report</i><span>Report</span></a>
            </li>   
            <li  class="">
                <a href="userActivityLog.php" class="load-page" data-page="userActivityLog.php"><i class="material-icons">history</i><span>Activity Log</span></a>
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
                <li class="nav-item dropdown me-3" style="position: relative;">
                  <a href="#" class="nav-link position-relative" id="userNotificationToggle">
                  <span class="material-icons">notifications</span>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        id="userNotificationCount" style="font-size: 0.7rem; display: none;">
                    0
                  </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end position-absolute"
                    id="userNotificationDropdown"
                    style="width: 300px; max-height: 400px; overflow-y: auto; overflow-x: hidden;">

                <?php
               
                $sql = "SELECT 
                          id,
                          request_type,
                          request_date,
                          status
                        FROM file_requests
                        WHERE resident_ID = ? AND (status = 'Approved' OR status = 'Rejected')
                        ORDER BY request_date DESC";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $resident_ID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $icon = ($row['status'] == 'Approved') ? '✅' : '❌';
                    $color = ($row['status'] == 'Approved') ? '#d4edda' : '#f8d7da';

                    echo '<div class="notification-item" style="padding: 12px; border-bottom: 1px solid #eee;">
                            <div style="display: flex; align-items: flex-start;">
                              <div style="background-color: ' . $color . '; border-radius: 50%; width: 40px; height: 40px; 
                                          display: flex; align-items: center; justify-content: center; font-size: 20px; 
                                          margin-right: 12px;">' . $icon . '</div>
                              <div style="flex: 1;">
                                <div style="font-weight: bold; font-size: 14px;">Your ' . htmlspecialchars($row['request_type']) . ' request was ' . $row['status'] . '.</div>
                                <div style="font-size: 12px; color: #888; margin-top: 4px;">' . date("M d, Y | H:i", strtotime($row['request_date'])) . '</div>
                              </div>
                            </div>
                          </div>';
                  }
                } else {
                  echo '<div class="notification-item text-center" style="padding: 12px; color: #888;">No new updates</div>';
                }

             
                ?>
                </ul>
                </li>
                  
      
                <!-- Profile Dropdown -->
              <li class="nav-item dropdown">
              <a class="nav-link d-flex align-items-center" href="#" id="profileToggle">
                <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="width:50px; height: 50px; border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
              </a>
              <ul class="dropdown-menu dropdown-menu-end small-menu" id="profileDropdown">
                <li><a class="dropdown-item" href="userProfile.php" data-page="userProfile.php"><span class="material-icons me-2">person_outline</span>Profile</a></li>
                <li><a class="dropdown-item" href="userSettings.php" data-page="userSettings.php"><span class="material-icons me-2">settings</span>Settings</a></li>
                <li><a class="dropdown-item load-page" href="frontpage.php" data-page="frontpage.php"><span class="material-icons me-2">logout</span>Logout</a></li>
              
              </ul>
            </li>
              </ul>
            </nav>
          </div>
      
        </div>
      </div>      
    <!--end of top-navbar-->

    <div class="main-content p-4" id="maincontent">
        <div class="welcome-banner">
            <div class="welcome-content">
              <img src="img/<?php echo htmlspecialchars($user_profile); ?>" alt="Profile Picture" class="img-fluid profile-img" style="border-radius:50%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);"/>
              <div class="text-content">
                <span>CIUDAD NIN DARAGA: AN MAOGMANG LUGAR</span>
                <h2><?php echo strtoupper($firstName . " " . $middleInitial . " " . $lastName); ?></h2>
                <p>Barangay Resident | <?php echo $address; ?></p>
              </div>    
            </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div class="statistics">
              <h2>POPULATION</h2>
              <div class="section">
                  <div class="chart-box">
                      <canvas id="populationChart"></canvas>
                  </div>
                  <div class="population-box">
                      <h3><?php echo $total_population; ?></h3>
                      <p>TOTAL POPULATION</p>
                      <?php foreach ($labels as $index => $purok): ?>
                          <p><?php echo $counts[$index] . ' - Purok ' . htmlspecialchars($purok); ?></p>
                      <?php endforeach; ?>
                  </div>
              </div>
          </div>
    
       <div class="announcement">
      <h2>ANNOUNCEMENT & EVENTS</h2>
      <div class="card-container">
        <?php if ($announcementResult->num_rows > 0): ?>
          <?php while($row = $announcementResult->fetch_assoc()): ?>
            <div class="event-card">
              <h4><?php echo date("F j, Y", strtotime($row['dateToday'])); ?></h4>
              <h3><?php echo htmlspecialchars($row['title']); ?></h3>
              <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 100))) . '...'; ?></p>
              <a href="view_announcement.php?id=<?php echo $row['id']; ?>" class="learn-more-link">Learn more →</a>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No announcements available at the moment.</p>
        <?php endif; ?>
      </div>
    </div>




          <div class="barangay-officials">
            <div class="container py-5">
              <h2 class="text-center mb-4">BARANGAY OFFICIALS</h2>
              
              <div id="barangayCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselItems">
                     <!-- slides will be displayed here -->
                </div>
            
                <div class="carousel-indicators" id="carouselIndicators"></div>
                <button class="carousel-control-prev" type="button" data-bs-target="#barangayCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#barangayCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </button>
              </div>
            </div>
            </div>

            <div class="sk-officials">
                <div class="container py-5">
                  <h2 class="text-center mb-4">SK OFFICIALS</h2>
              
                  <div id="skCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
                    <div class="carousel-inner" id="skCarouselItems"></div>
              
                    <div class="carousel-indicators" id="skCarouselIndicators"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#skCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#skCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                      </button>
                  </div>
                </div>
              </div>
          
        <div class="location">
            <h4>OUR LOCATION</h4>
            <h2>VISIT OUR BARANGAY OFFICE</h2>
            <div class="map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3885.238943094969!2d123.69663357551119!3d13.147322487184407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a10408a56c7c47%3A0x79c0132af3af288b!2sBalinad%2C%20Daraga%2C%20Albay!5e0!3m2!1sen!2sph!4v1744735751782!5m2!1sen!2sph" 
                width="1120" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            </div>
        

        <div class="contact-section">
            <div class="contact-left">
                <h3>For inquiries and Concern, Contact Us</h3>
                <form action="send_message.php" method="post" id="messageForm">
                  <div class="form-row">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                  </div>
                  <div class="message">
                    <input type="text" name="subject" placeholder="Subject" required>
                    <textarea name="message" rows="5" placeholder="Message" required></textarea>
                    <button type="submit">Send message</button>
                  </div>
                </form>

                <div id="popup">
                
            </div>
            </div>
            <div class="contact-right">
                <h4>Contact Information</h4>
                <p>Barangay 17 Balinad Daraga, Albay</p>
                <p>Barangay Multi-Purpose Hall, Barangay 17, Burgos – M.H. del Pilar Street, Balinad Daraga, Albay, Philippines</p>
                <p><strong>secretariat@barangay17balinad.ph</strong></p>
            </div>
        </div>

        <div class="footer">
            Copyright © 2025 <strong>BARANGAY BALINAD DARAGA, ALBAY</strong>. All Rights Reserved.<br>
            Powered by Barangay Miming Team.
        </div>
    </div>

    
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="sidebar.js"></script>

<script>
document.getElementById("messageForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally (no page reload)
    
    var form = this;
    var formData = new FormData(form);

    // AJAX request to send the form data to send_message.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Display the success message dynamically on the page
            var message = xhr.responseText; // "Message sent successfully."
            var popup = document.getElementById("popup");

            popup.textContent = message; // Set the popup message
            popup.style.display = "block"; // Show the popup

            // Optionally, hide the popup after 3 seconds
            setTimeout(function() {
                popup.style.display = "none"; // Hide the popup
            }, 3000);

            // Optionally, reset the form after successful submission
            form.reset();
        } else {
            alert("Error: " + xhr.statusText);
        }
    };
    xhr.send(formData);
});


//barangay-officials
const officials = [
    { name: 'Leni Robredo', position: 'Barangay Chairman', image: 'img/leni.jpg' },
    { name: 'Risa Hontiveros', position: 'Barangay Secretary', image: 'img/risa.jpg' },
    { name: 'Rhona Lumbes', position: 'Barangay Kagawad', image: 'img/rhona.jpg' },
    { name: 'Bam Aquino', position: 'Barangay Kagawad', image: 'img/bam.jpg' },
    { name: 'Kiko Pangilinan', position: 'Barangay Kagawad', image: 'img/kiko.jpg' },
    { name: 'Stacey Sevilleja', position: 'Barangay Kagawad', image: 'img/stacey.jpg' },
    { name: 'Colet Vergara', position: 'Barangay Kagawad', image: 'img/colet.jpg' },
    { name: 'Sheena Catacutan', position: 'Barangay Kagawad', image: 'img/sheena.jpg' },
    { name: 'Maloi Ricalde', position: 'Barangay Kagawad', image: 'img/maloi.jpg' },
  ];
  
  function generateSlides() {
    const carouselItems = document.getElementById('carouselItems');
    const carouselIndicators = document.getElementById('carouselIndicators');
    let slidesPerGroup;
  
    if (window.innerWidth >= 992) {
      slidesPerGroup = 3;  
    } else if (window.innerWidth >= 768) {
      slidesPerGroup = 2;  
    } else {
      slidesPerGroup = 1;  
    }
  
    let slideCount = 0;
  
    carouselItems.innerHTML = '';
    carouselIndicators.innerHTML = '';
  
    // Generate slides
    officials.forEach((official, index) => {
      if (index % slidesPerGroup === 0) {
        // Create a new slide
        slideCount++;
        const slide = document.createElement('div');
        slide.classList.add('carousel-item');
        if (index === 0) slide.classList.add('active');
  
        const row = document.createElement('div');
        row.classList.add('row', 'justify-content-center');
  
        // Add images for this slide
        for (let i = 0; i < slidesPerGroup && index + i < officials.length; i++) {
          const officialData = officials[index + i];
          const col = document.createElement('div');
          col.classList.add('col-12', 'col-sm-6', 'col-md-6', 'col-lg-4', 'text-center');
  
          const img = document.createElement('img');
          img.src = officialData.image;
          img.classList.add('d-block', 'w-100');
          img.style.objectFit = 'cover';
          img.style.marginBottom = '20px';
          img.style.marginTop = '70px';
  
          const name = document.createElement('h2');
          name.classList.add('fs-5');
          name.textContent = officialData.name;
          name.style.fontWeight = 'bold';
          name.style.color = 'black';

          
          if (window.innerWidth >= 992) {
          img.style.height = '500px';
        } else if (window.innerWidth >= 768) {
          img.style.height = '400px';
        } else {
          img.style.height = '300px';
        }
  
          const position = document.createElement('p');
          position.classList.add('text-primary', 'fw-medium');
          position.textContent = officialData.position;
  
          col.appendChild(img);
          col.appendChild(name);
          col.appendChild(position);
          row.appendChild(col);
        }
  
        slide.appendChild(row);
        carouselItems.appendChild(slide);
  
        // Create indicator
        const indicator = document.createElement('button');
        indicator.type = 'button';
        indicator.setAttribute('data-bs-target', '#barangayCarousel');
        indicator.setAttribute('data-bs-slide-to', slideCount - 1);
        indicator.setAttribute('aria-label', `Slide ${slideCount}`);
        if (slideCount === 1) {
          indicator.classList.add('active');
          indicator.setAttribute('aria-current', 'true');
        }
        carouselIndicators.appendChild(indicator);
      }
    });
  }
  
  // Adjust slides on window resize
  window.addEventListener('resize', generateSlides);
  
  // Initialize slides when the page loads
  generateSlides();



  const skOfficials = [
    { name: 'Leni Robredo', position: 'SK Chairman', image: 'img/leni.jpg' },
    { name: 'Risa Hontiveros', position: 'SK Secretary', image: 'img/risa.jpg' },
    { name: 'Rhona Lumbes', position: 'SK Kagawad', image: 'img/rhona.jpg' },
    { name: 'Bam Aquino', position: 'SK Kagawad', image: 'img/bam.jpg' },
    { name: 'Kiko Pangilinan', position: 'SK Kagawad', image: 'img/kiko.jpg' },
    { name: 'Stacey Sevilleja', position: 'SK Kagawad', image: 'img/stacey.jpg' },
    { name: 'Colet Vergara', position: 'SK Kagawad', image: 'img/colet.jpg' },
    { name: 'Sheena Catacutan', position: 'SK Kagawad', image: 'img/sheena.jpg' },
    { name: 'Maloi Ricalde', position: 'SK Kagawad', image: 'img/maloi.jpg' },
];

// Function to render SK carousel
function generateSkSlides() {
const container = document.getElementById('skCarouselItems');
const indicators = document.getElementById('skCarouselIndicators');
let slidesPerGroup;

if (window.innerWidth >= 992) {
slidesPerGroup = 3;
} else if (window.innerWidth >= 768) {
slidesPerGroup = 2;
} else {
slidesPerGroup = 1;
}

container.innerHTML = '';
indicators.innerHTML = '';

let slideCount = 0;

skOfficials.forEach((official, index) => {
if (index % slidesPerGroup === 0) {
  slideCount++;
  const slide = document.createElement('div');
  slide.classList.add('carousel-item');
  if (index === 0) slide.classList.add('active');

  const row = document.createElement('div');
  row.classList.add('row', 'justify-content-center');

  for (let i = 0; i < slidesPerGroup && index + i < skOfficials.length; i++) {
    const officialData = skOfficials[index + i];
    const col = document.createElement('div');
    col.classList.add('col-12', 'col-sm-6', 'col-md-6', 'col-lg-4', 'text-center');

         const img = document.createElement('img');
          img.src = officialData.image;
          img.classList.add('d-block', 'w-100');
          img.style.objectFit = 'cover';
          img.style.marginBottom = '20px';
          img.style.marginTop = '70px';

        if (window.innerWidth >= 992) {
          img.style.height = '500px';
        } else if (window.innerWidth >= 768) {
          img.style.height = '400px';
        } else {
          img.style.height = '300px';
        }
  
          const name = document.createElement('h2');
          name.classList.add('fs-5');
          name.textContent = officialData.name;
          name.style.fontWeight = 'bold';
          name.style.color = 'black';
  
          const position = document.createElement('p');
          position.classList.add('text-primary', 'fw-medium');
          position.textContent = officialData.position;

    col.appendChild(img);
    col.appendChild(name);
    col.appendChild(position);
    row.appendChild(col);
  }

  slide.appendChild(row);
  container.appendChild(slide);

  const indicator = document.createElement('button');
  indicator.type = 'button';
  indicator.setAttribute('data-bs-target', '#skCarousel');
  indicator.setAttribute('data-bs-slide-to', slideCount - 1);
  indicator.setAttribute('aria-label', `Slide ${slideCount}`);
  if (slideCount === 1) {
    indicator.classList.add('active');
    indicator.setAttribute('aria-current', 'true');
  }
  indicators.appendChild(indicator);
}
});
}



// Initial rendering
generateSkSlides();
window.addEventListener('resize', generateSkSlides);


const labels = <?php echo json_encode($labels); ?>;
const counts = <?php echo json_encode($counts); ?>;

// Chart config
const ctx = document.getElementById('populationChart').getContext('2d');
const populationChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Residents per Purok',
            data: counts,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = <?php echo $total_population; ?>;
                        const count = context.raw;
                        const percent = ((count / total) * 100).toFixed(1);
                        return `${count} residents (${percent}%)`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                },
                title: {
                    display: true,
                    text: 'No. of Residents'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Purok'
                }
            }
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
  const profileToggle = document.getElementById("profileToggle");
  const profileDropdown = document.getElementById("profileDropdown");

  profileToggle.addEventListener("click", function (e) {
    e.preventDefault();

    if (profileDropdown.style.display === "block") {
      profileDropdown.style.display = "none";
    } else {
      profileDropdown.style.display = "block";
    }
  });

  // Optional: Click outside to close dropdown
  document.addEventListener("click", function (e) {
    if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
      profileDropdown.style.display = "none";
    }
  });
});


</script>
  
  
</body>
</html>




