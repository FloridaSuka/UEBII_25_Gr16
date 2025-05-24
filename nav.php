<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation and Login</title>
    <style>
    nav {
        position: relative;
        z-index: 10;
        background-color: #264653;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 180px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        padding: 10px;
        z-index: 1000;
        border-radius: 5px;
    }
    <?php if ($isLoggedIn): ?>
    .dropdown:hover .dropdown-content {
        display: block;
    }
    <?php endif; ?>
    .logo-container {
        display: flex;
        align-items: center;
    }
    .logo-container img {
        width: 80px;
        margin-right: 10px;
        animation: flip 6s infinite linear;
        transform-style: preserve-3d;
    }
    .logo-container h3 {
        margin: 0;
        color: white;
        font-size: 30px;
        font-weight: bold;
    }
    @keyframes flip {
        0% { transform: rotateY(0deg); }
        100% { transform: rotateY(360deg); }
    }
    .nav-links {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
    }
    .nav-links li {
        margin: 0 15px;
    }
    .nav-links a {
        pointer-events: auto;
        text-decoration: none;
        color: #FFFAFE;
        font-size: 20px;
    }
    .nav-links a:hover {
        color: #E9C46A;
    }
    .nav-links img {
        width: 20px;
        margin-right: 10px;
        margin-left: 20px;
    }
    .hamburger {
        position: relative;
        color: #FFFAFE;
        z-index: 1000;
        display: none;
        font-size: 24px;
        cursor: pointer;
    }
    @media (max-width: 768px) {
        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            background-color: #264653;
            position: absolute;
            top: 60px;
            left: 0;
            text-align: center;
        }
        .nav-links.show {
            display: flex;
            margin-top: 40px;
        }
        .nav-links li {
            margin: 10px 0;
        }
        .hamburger {
            display: block;
        }
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 5px;
        width: 300px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .modal-content h2 {
        margin-top: 0;
    }
    .close-btn {
        background: rgba(197, 193, 193, 0.326);
        color: black;
        border: none;
        padding: 5px 8px;
        position: absolute;
        top: 10px;
        right: 10px;
        width: 40px;
        border-radius: 5px;
        cursor: pointer;
        float: right;
    }
    .close-btn:hover {
        background: #264653b5;
        color: white;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #264653b5;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .submit-btn:hover {
        background-color: #264653;
    }
    .nav-p {
        margin-top: 20px;
    }
    #loginModal {
        z-index: 1000;
    }
    .user-icon {
        z-index: 1001;
    }
    @font-face {
        font-family: 'myfont1regular';
        src: url('fonts/myfont1-regular-webfont.woff2') format('woff2'),
             url('fonts/myfont1-regular-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    </style>
</head>
<header>
<nav>
    <div class="logo-container">
        <a href="home.php">
            <img src="foto/logo.svg" alt="Logo">
        </a>
        <h3 style="font-family: 'myfont1regular' , sans-serif;">Find Your Way</h3>
    </div>
    <ul class="nav-links">
        <li><a href="home.php">Ballina</a></li>
        <li><a href="rrethnesh.php">Rreth nesh</a></li>
        <li><a href="shpalljet.php">Shpallje</a></li>
        <li><a href="keshilla.php">Këshilla</a></li>
        <div class="user-icon">
            <div class="dropdown">
            <button class="login-btn" id="loginIcon"
                    <?php if (!$isLoggedIn): ?>
                        onclick="showLoginPopup()"
                    <?php endif; ?>
                    style="background: none; border: none; cursor: pointer;">
                <img src="foto/user-icon.svg" alt="user icon" style="width: 30px;"><br>
                <span style="color: white; font-weight: bold;">
                <?php echo ($isLoggedIn && isset($_SESSION['emri_perdoruesit'])) ? $_SESSION['emri_perdoruesit'] : 'Kyçu'; ?>
                </span>
            </button>
            <?php if ($isLoggedIn): ?>
            <div class="dropdown-content" id="userDropdown">
                <p><strong><?php echo $_SESSION['emri'] . ' ' . $_SESSION['mbiemri']; ?></strong></p>
                <a href="logout.php">
                <img src="foto/log-out.png" alt="Dil" style="width: 35px;">
                </a>
            </div>
            <?php endif; ?>
            </div>
        </div>
    </ul>
    <div class="hamburger">&#9776;</div>
</nav>
<script>
function showLoginPopup() {
  const loginModal = document.getElementById("loginModal");
  if (loginModal) {
    loginModal.style.display = "flex";
  }
}

window.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector('.hamburger');
  const navLinks = document.querySelector('.nav-links');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });
  }

  const closeBtn = document.getElementById("closeBtn");
  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      document.getElementById("loginModal").style.display = "none";
    });
  }

  window.addEventListener("click", (e) => {
    const modal = document.getElementById("loginModal");
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });

  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function(e) {
      e.preventDefault();
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      fetch("login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `emri_perdoruesit=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
      })
      .then(response => response.json())
        .then(data => {
        console.log("Përgjigja nga serveri:", data); // 🔍 Debug: kontrollo formatin e JSON
        if (data.sukses) {
            alert("✅ Kyçja u realizua me sukses!");
            window.location.href = data.redirect;
        } else {
            alert(data.mesazh);
        }
        })

      .catch(error => {
        alert("❌ Gabim gjatë komunikimit: " + error.message);
        console.error("Gabim:", error);
      });
    });
  }
});
</script>
</header>
<div class="modal" id="loginModal" style="display:none">
  <div class="modal-content">
    <button class="close-btn" id="closeBtn">X</button>
    <h2>Kyçuni</h2>
    <form id="loginForm" method="post">
      <div class="form-group">
        <label for="username">Emri i perdoruesit:</label>
        <input type="text" id="username" name="emri_perdoruesit" required>
      </div>
      <div class="form-group">
        <label for="password">Fjalëkalimi:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="submit-btn">Kycu</button>
    </form>
    <p>Nuk keni llogari?</p>
    <a href="index.php" class="submit-btn">Regjistrohu</a>
  </div>
</div>
</html>
