<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Find Your Way - Kyçja dhe Regjistrimi</title>
    <link rel="stylesheet" href="faqjakryesore.css">
</head>
<body>
    <div id="login-message" style="
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
                <button type="button" class="toggle-btn" onclick="login()">Hyr</button>
                <button type="button" class="toggle-btn" onclick="register()">Regjistrohu</button>
            </div>

            <!-- Forma për login -->
            <form id="login" class="input-group">
                <input type="text" name="emri_perdoruesit" class="input-field" placeholder="Emri i përdoruesit" required>
                <input type="password" name="password" class="input-field" placeholder="Fjalëkalimi" required>
                <label class="button1"><a href="resetPassword.php">Ndrysho Fjalëkalimin</a></label>
                <button type="submit" class="submit-btn1">Hyr</button>
            </form>

            <!-- Forma për regjistrim -->
            <form id="register" class="input-group">
                <input type="text" name="emri" class="input-field1" placeholder="Emri" required>
                <input type="text" name="mbiemri" class="input-field1" placeholder="Mbiemri" required>
                <input type="text" name="emri_perdoruesit" class="input-field1" placeholder="Emri Përdoruesit" required>
                <input type="email" name="email" class="input-field1" placeholder="Email" required>
                <input type="date" name="datelindja" class="input-field1" placeholder="Datëlindja (YYYY-MM-DD)" required>
                <input type="password" name="password" class="input-field1" placeholder="Fjalëkalimi" required>
                <select name="roli" class="input-field1" required>
                    <option value="" disabled selected>Zgjedh rolin</option>
                    <option value="user" style="color: black;">Punëtor</option>
                    <option value="admin" style="color: black;">Pundhënës</option>
                </select>
                <button type="submit" class="submit-btn">Regjistrohu</button>
            </form>

        </div>
    </div>

    <script>
        // Regjistrimi
        document.querySelector("#register").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("register.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.sukses) {
                    // Shfaq mesazh suksesi dhe ridrejto pas 2 sekondash
                    alert("✅ " + data.mesazh);
                    setTimeout(() => window.location.href = "index.php", 2000);
                } else {
                    alert("❌ " + (data.gabime?.join("\n") || "Gabim i panjohur gjatë regjistrimit."));
                }
            })
            .catch(error => {
                alert("❌ Gabim gjatë komunikimit: " + error.message);
                console.error("Gabim:", error);
            });
        });
    // Login
document.querySelector("#login").addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    // ✅ Kontrollo nëse URL përmban ?redirect
    const params = new URLSearchParams(window.location.search);
    if (params.has("redirect")) {
        formData.append("redirect", params.get("redirect"));
    }

    fetch("login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.sukses) {
            window.location.href = data.redirect;
        } else {
            const mesazh = data?.mesazh || (data?.gabime?.join("\n") ?? "Gabim i panjohur.");
            alert("❌ " + mesazh);
        }
    })
    .catch(error => {
        alert("❌ Gabim gjatë komunikimit: " + error.message);
        console.error("Gabim:", error);
    });
});


        // Animacioni për ndërrimin e formave
        function login() {
            document.getElementById("login").style.left = "50px";
            document.getElementById("register").style.left = "450px";
            document.getElementById("btn").style.left = "0px";
        }

        function register() {
            document.getElementById("login").style.left = "-400px";
            document.getElementById("register").style.left = "50px";
            document.getElementById("btn").style.left = "110px";
        }

        //Shfaq alert nëse vjen mesazh përmes URL-së
       window.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    if (params.has("mesazh")) {
        const decodedMsg = decodeURIComponent(params.get("mesazh"));
        const msgBox = document.getElementById("login-message");
        msgBox.textContent = decodedMsg;
        msgBox.style.display = "block";

        // Zhduke pas 3 sekondash
        setTimeout(() => {
            msgBox.style.display = "none";
        }, 3000);
    }
});

    </script>
</body>
</html>
