<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Find Your Way - Kyçja dhe Regjistrimi</title>
    <link rel="stylesheet" href="faqjakryesore.css">
</head>
<body>
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
                <input type="checkbox" class="check-box"><span>Kujto Fjalëkalimin</span> 
                <label class="button1"><a href="#">Keni harruar fjalëkalimin?</a></label>
                <button type="submit" class="submit-btn1">Hyr</button>
            </form>

            <!-- Forma për regjistrim -->
            <form id="register" class="input-group">
                <input type="text" name="emri" class="input-field1" placeholder="Emri" required>
                <input type="text" name="mbiemri" class="input-field1" placeholder="Mbiemri" required>
                <input type="text" name="emri_perdoruesit" class="input-field1" placeholder="Emri Përdoruesit" required>
                <input type="email" name="email" class="input-field1" placeholder="Email" required>
                <input type="text" name="datelindja" class="input-field1" placeholder="Datëlindja (YYYY-MM-DD)" required>
                <input type="password" name="password" class="input-field1" placeholder="Fjalëkalimi" required>
                <select name="roli" class="input-field1" required>
                    <option value="" disabled selected>Zgjedh rolin</option>
                    <option value="user">Përdorues</option>
                    <option value="admin">Administrator</option>
                </select>
                <input type="checkbox" class="check-box"><span>Jam dakord me termat dhe kushtet</span>
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
            .then(response => response.json())
            .then(data => {
                if (data.sukses) {
                    alert("✅ " + data.mesazh + "\nMirë se erdhe, " + data.emri + " " + data.mbiemri + "!");
                    // window.location.href = "home.php";
                } else {
                    alert("⚠️ Gabime gjatë regjistrimit:\n\n" + data.gabime.join("\n"));
                }
            })
            .catch(error => {
                alert("❌ Ka ndodhur një gabim në komunikim.");
                console.error("Gabim:", error);
            });
        });

        // Login
        document.querySelector("#login").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.sukses) {
                    window.location.href = data.redirect;
                } else {
                    console.log("Përgjigja nga serveri:", data);
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
    </script>
</body>
</html>
