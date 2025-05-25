<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndrysho Fjalëkalimin</title>
    <link rel="stylesheet" href="faqjakryesore.css">
</head>
<body>
    <div id="reset-message" style="
        display: none;
        position: fixed;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #264653;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-size: 16px;
        z-index: 9999;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    "></div>

    <img src="foto/logo.svg" alt="Logo" class="logo">
    <p class="show">Mirë se erdhe, <br> shpresojmë të gjeni atë që po kërkoni.</p>
    <a href="home.php" class="return-link">Vazhdo pa u kyçur</a>

    <div class="login">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="ndrysho()">Ndrysho</button>
                <button type="button" class="toggle-btn" onclick="rikthe()">Rikthe</button>
            </div>

            <!-- Forma Ndrysho Fjalekalimin (si login) -->
            <form id="ndrysho" class="input-group">
                <input type="text" name="emri_perdoruesit" class="input-field1" placeholder="Emri i Përdoruesit" required>
                <input type="email" name="email" class="input-field1" placeholder="Email" required>
                <input type="text" name="old_password" class="input-field1" placeholder="Fjalëkalimi i vjetër/kodi verifikimit" required>
                <input type="password" name="new_password" class="input-field1" placeholder="Fjalëkalimi i ri" required>
                <input type="password" name="confirm_password" class="input-field1" placeholder="Rivendos Fjalëkalimin" required>
                <button type="submit" class="submit-btn1">Ndrysho</button>
            </form>

            <!-- Forma Rikthe Fjalekalimin (si regjistrim) -->
            <form id="rikthe" class="input-group">
                <input type="text" name="emri_perdoruesit" class="input-field" placeholder="Emri i Përdoruesit" required>
                <input type="email" name="email" class="input-field" placeholder="Email" required>
                <button type="submit" class="submit-btn1">Dërgo Kodin</button>
            </form>

        </div>
    </div>

    <script>
        document.querySelector("#ndrysho").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("updatePassword.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const box = document.getElementById("reset-message");
                box.textContent = data.mesazh;
                box.style.display = "block";
                setTimeout(() => box.style.display = "none", 3000);
                if (data.sukses) window.location.href = "index.php";
            })
            .catch(error => alert("Gabim: " + error.message));
        });

        document.querySelector("#rikthe").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch("dergoKod.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const box = document.getElementById("reset-message");
                box.textContent = data.message;
                box.style.display = "block";
                setTimeout(() => box.style.display = "none", 3000);
            })
            .catch(error => alert("Gabim: " + error.message));
        });

    // Poziciono format në mënyrë që vetëm 'ndrysho' të jetë e dukshme në fillim
    window.addEventListener("DOMContentLoaded", () => {
        document.getElementById("ndrysho").style.left = "50px";
        document.getElementById("rikthe").style.left = "450px";
        document.getElementById("btn").style.left = "0px";
    });

    function ndrysho() {
        document.getElementById("ndrysho").style.left = "50px";
        document.getElementById("rikthe").style.left = "450px";
        document.getElementById("btn").style.left = "0px";
    }

    function rikthe() {
        document.getElementById("ndrysho").style.left = "-400px";
        document.getElementById("rikthe").style.left = "50px";
        document.getElementById("btn").style.left = "110px";
    }
    </script>
</body>
</html>
