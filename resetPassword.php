<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndrysho Fjalëkalimin</title>
    <link rel="stylesheet" href="faqjakryesore.css">
</head>
<body>
    <img src="foto/logo.svg" alt="Logo" class="logo">
    <p class="show">Mirë se erdhe, <br> shpresojmë të gjeni atë që po kërkoni.</p>
    <a href="home.php" class="return-link">Vazhdo pa u kyçur</a>

    <div class="reset">
        <div class="form-box1">
            <h2 style="text-align:center;color:#264653">Ndrysho Fjalëkalimin</h2>
            <form id="resetForm" class="input-group1">
                <input type="text" name="emri_perdoruesit" class="input-field2" placeholder="Emri Përdoruesit" required>
                <input type="email" name="email" class="input-field2" placeholder="Email" required>
                <input type="text" name="old_password" id="old_password" class="input-field2" placeholder="Fjalëkalimi i vjetër" required>
                <input type="password" name="new_password" class="input-field2" placeholder="Fjalëkalimi i ri" required>
                <input type="password" name="confirm_password" class="input-field2" placeholder="Rivendos Fjalëkalimin" required>
                <button type="submit" class="submit-btn3">Ndrysho</button>
            </form>
        </div>
    </div>

   <script>
document.querySelector("#resetForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("updatePassword.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert((data.sukses ? "✅ " : "❌ ") + data.mesazh);
        if (data.sukses) {
            window.location.href = "index.php"; // pas suksesit kthehet te login/index
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