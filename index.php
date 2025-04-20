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
                <form id="login" class="input-group">
                    <input type="text" class="input-field" placeholder="Emri i perdoruesit" required>
                    <input type="password" class="input-field" placeholder="Fjalekalimi" required>
                    <input type="checkbox" class="check-box"><span>Kujto Fjalekalimin</span> 
                    <label class="button"><a href="#####">Keni harruar fjalkalimin?</a></label>
                    <button type="submit" class="submit-btn">Hyr</button>
                </form>
                <form id="register" class="input-group" action="validimiIndex.php" method="POST">
                    <input type="text" name="emri" class="input-field" placeholder="Emri" required>
                    <input type="text" name="mbiemri" class="input-field" placeholder="Mbiemri" required>
                    <input type="text" name="emri_perdoruesit" class="input-field" placeholder="Emri Perdoruesit" required>
                    <input type="email" name="email" class="input-field" placeholder="Email" required>
                    <input type="password" name="fjalekalimi" class="input-field" placeholder="Fjalekalimi" required>
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

            fetch("validimiIndex.php", 
                {
                method: "POST",
                body: formData
                }
            )
                .then(response => response.json())
                .then(data => {
                    if (data.sukses) {
                        alert("✅ " + data.mesazh + "\nMirë se erdhe, " + data.emri + " " + data.mbiemri + "!");
                        // Opsionale: window.location.href = "home.php";
                    } else {
                        alert("⚠️ Gabime gjatë regjistrimit:\n\n" + data.gabime.join("\n"));
                    }
                })
                .catch(error => {
                    alert("❌ Ka ndodhur një gabim në komunikim.");
                    console.error("Gabim:", error);
                });
            });
        </script>
    </body>
</html>
