<?php
 include 'connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Barangay Balinad Portal</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <!-- Custom CSS -->
  <link rel="stylesheet" href="frontpage.css">

  <style>
      .main-content {
    margin-top: 50px;
    padding: 20px;
    width: 100%;
    margin-top: 250px;
    text-align: center;
    color: white;
    background-image: linear-gradient(rgba(138, 241, 255, 0.26));
    position: relative; /* changed from absolute */
  }

 
 .login {
   display: none;
   width: 100%;
   margin-top: 150px;
   position: relative; /* changed from absolute */
   text-align: center;
   color: white;
   background-image: linear-gradient(rgba(138, 241, 255, 0.26));
 }
  </style>
</head>
<body>
  <div class="banner">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
          <a class="navbar-brand d-flex align-items-center gap-2" href="#">
          <img src="img/barangayBalinad.png" class="logo"/>
            BARANGAY PORTAL
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
      
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="nav-text" id="home-btn">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="material-icons">person</span>
                <button class="nav-text" id="open-login-btn">Login</button>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main content section -->
    <div class="main-content" id="home">
      <h1>WELCOME</h1>
      <div class="img-container">
      <img src="img/barangayBalinad.png" class="logo"/>
      </div>
      <p>BARANGAY BALINAD DARAGA, ALBAY</p>
      <div class="button-container mt-4 d-flex justify-content-center gap-3">
        <button class="btn btn-danger px-4" id="open-login-btn2">LOGIN</button>
      </div>
    </div>

    <!-- Login form section -->
    <div class="login" id="login">
      <div class="container-login">
        <div class="img-container-login">
          <img src="img/barangayBalinad.png" alt="barangay image">
        </div>
        
        <form action="frontpageRegister.php" method="post" id="form">
          <h1 class="form-title">BARANGAY PORTAL</h1>
        <div class="input-control">
          <span class="material-icons">person</span>
          <input id="resident_ID" name="resident_ID" type="text" placeholder="RESIDENT ID">
            <div class="error"></div>
        </div>

        <div class="input-control position-relative">
          <span class="material-icons">lock</span>
          <input id="password" name="password" type="password" placeholder="PASSWORD" class="form-control">
          
          <!-- Eye Icon -->
          <i class="bi bi-eye-slash toggle-password" data-target="password"
            style="position: absolute; top: 50%; right: 1rem; transform: translateY(-50%); cursor: pointer;"></i>

          <div class="error"></div>
        </div>

        <div id="error-message" style="color: red; margin-top: 10px; display:none;"></div>
        <button type="submit" name="loginButton" id="loginButton">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="footer-in">
        <p class="mb-0">© 2025 Barangay Balinad Portal. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript -->
  <script>
    const loginForm = document.getElementById('login');
    const homeSection = document.getElementById('home');
    const loginBtns = [document.getElementById('open-login-btn'), document.getElementById('open-login-btn2')];
    const homeBtn = document.getElementById('home-btn');

    loginBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        loginForm.style.display = "block";
        homeSection.style.display = "none";
      });
    });

    homeBtn.addEventListener('click', function () {
      loginForm.style.display = "none";
      homeSection.style.display = "block";
    });

    document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    var form = this;
    var formData = new FormData(form);
    var errorDiv = document.getElementById("error-message");
    errorDiv.style.display = "none";
    errorDiv.textContent = "";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "frontpageRegister.php", true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); 

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    if (response.role === "admin") {
                        window.location.href = "adminDashboard.php";
                    } else if (response.role === "resident") {
                        window.location.href = "userDashboard.php";
                    } else {
                        errorDiv.textContent = "Unknown user role.";
                        errorDiv.style.display = "block";
                    }
                } else {
                    errorDiv.textContent = response.message || "Login failed.";
                    errorDiv.style.display = "block";

                    setTimeout(() => {
                        errorDiv.style.display = "none";
                        errorDiv.textContent = "";
                    }, 3000);
                }
            } catch (e) {
                errorDiv.textContent = "Unexpected error occurred.";
                errorDiv.style.display = "block";
            }
        } else {
            errorDiv.textContent = "Server error: " + xhr.status;
            errorDiv.style.display = "block";
        }
    };

    xhr.onerror = function() {
        errorDiv.textContent = "Request failed.";
        errorDiv.style.display = "block";
    };

    xhr.send(formData);
});

document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
      const input = document.getElementById(icon.getAttribute('data-target'));
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      } else {
        input.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      }
    });
  });


</script>
</body>
</html>
