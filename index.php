<!DOCTYPE html>
<html>
    <head>
       <link rel="stylesheet" href="faqjakryesore.css">
    </head>
    <body>
        <img src="foto/logo.svg" alt="Logo" class="logo">
       <p class="show">Mirë se erdhe, <br>
        shpresojmë të gjeni atë që po kërkoni.</p>
        <a href="home.php" class="return-link">Vazhdo pa u kyçur</a>
        <div class="login">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()" >Hyr</button>
                    <button type="button" class="toggle-btn" onclick="register()">Regjistrohu</button>
                </div>
                <form id="login" class="input-group" action="login.php" method="POST">
                    <input type="text" name="emri_perdoruesit" class="input-field" placeholder="Emri i perdoruesit" required>
                    <input type="password" name="password" class="input-field" placeholder="Fjalekalimi" required>
                    <input type="checkbox" class="check-box"><span>Kujto Fjalekalimin</span> 
                    <label class="button1"><a href="#####">Keni harruar fjalkalimin?</a></label>
                    <button type="submit" class="submit-btn1">Hyr</button>
                </form>
                <form id="register" class="input-group" action="validimiIndex.php" method="POST">
                    <input type="text" name="emri" class="input-field1" placeholder="Emri" required>
                    <input type="text" name="mbiemri" class="input-field1" placeholder="Mbiemri" required>
                    <input type="text" name="emri_perdoruesit" class="input-field1" placeholder="Emri Perdoruesit" required>
                    <input type="email" name="email" class="input-field1" placeholder="Email" required>
                    <input type="text" name="datelindja" class="input-field1" placeholder="Datelindja" required>
                    <input type="password" name="password" class="input-field1" placeholder="Fjalekalimi" required>
                      <select name="Roli" class="input-field1" required>
                        <option value="" disabled selected>Zgjedh rolin</option>
                        <option value="user">Përdorues</option>
                        <option value="admin">Administrator</option>
                    </select>
                    <input type="checkbox" class="check-box"><span>Jam dakord me termat dhe kushtet</span>
                    <button type="submit" class="submit-btn">Regjistrohu</button>
                </form>
            
                
            </div>
        </div>
        <script src="login.js"></script>
      <script>
    document.querySelector("#register").addEventListener("submit", function(e) {
        e.preventDefault(); // Parandalon rifreskimin

        const formData = new FormData(this);

        fetch("validimiIndex.php", {
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

    document.querySelector("#login").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("login.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("HTTP error " + response.status);
            return response.json();
        })
        .then(data => {
            if (data.sukses) {
                window.location.href = data.redirect;
            } else {
                alert("❌ " + data.mesazh);
            }
        })
        .catch(error => {
            alert("❌ Gabim gjatë komunikimit: " + error.message);
            console.error("Gabim:", error);
        });
    });
</script>


    </body>
</html>