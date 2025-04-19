<?php
session_start();
$emri = $_SESSION['first_name'] ?? '';
$mbiemri = $_SESSION['last_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<title>Faleminderit për Aplikimin</title>
</head>

<body>
<div id="header-container"></div>
<script>
fetch('nav.html')
.then(response => response.text())
.then(data => {
    document.getElementById('header-container').innerHTML = data;
});
</script>

<div id="success-message" style="display: block; margin: 50px auto; padding: 30px; max-width: 600px; background-color: white; border: 2px solid #2a9d8f; border-radius: 15px; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15); text-align: center; color: black; font-family: Arial, sans-serif; font-style: italic;">
    <div style="font-size: 50px; margin-bottom: 20px;">🎉</div>
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 15px; text-decoration: underline;">Faleminderit për aplikimin tuaj!</h1>

    <p style="font-size: 18px; line-height: 1.5; margin-bottom: 20px;">
        I nderuar/e <b><?= htmlspecialchars($emri) . ' ' . htmlspecialchars($mbiemri) ?></b>, aplikimi juaj është pranuar me sukses. Ne do ta shqyrtojmë me kujdes dhe do t'ju kontaktojmë sa më shpejt të jetë e mundur.
    </p>
    <p style="font-size: 16px; color: #555; margin-bottom: 20px;">
        Ju urojmë suksese në hapat e ardhshëm të karrierës suaj!
    </p>
    <a href="shpalljet.html" class="btn">Kthehu</a>
</div>

<style>
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    border-radius: 10px;
}
::-webkit-scrollbar-thumb {
    background:#264653;
    border-radius: 10px;
}
#success-message {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 30px;
    background-color: #2a9d8f;
    color: white;
    text-decoration: none;
    font-size: 16px;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.2s;
}
.btn:hover {
    background-color: #1d6d5f;
    transform: scale(1.1);
}
</style>

<div id="footer-container"></div>
<script>
fetch('footer.html')
.then(response => response.text())
.then(data => {
    document.getElementById('footer-container').innerHTML = data;
});
</script>
</body>
</html>

<style>
    ::-webkit-scrollbar{
        width: 10px;
    }
    ::-webkit-scrollbar-track{
        
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb{
        background:#264653;
        border-radius: 10px;
    }
    #success-message {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Hijë e lehtë për kutinë */
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background-color: #2a9d8f;
        color: white;
        text-decoration: none;
        font-size: 16px;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #1d6d5f; /* Ngjyrë më e errët kur afrohet miu */
        transform: scale(1.1); /* Zgjerimi i butonit */
    }
</style>
<div id="footer-container"></div>
    <script>
      // JavaScript per ngarkim i footer-it nga file-i i jashtëm
      fetch('footer.html')
          .then(response => response.text())
          .then(data => {
              // Vendos pjese e footer-it ne div-in me id="footer-container"
              document.getElementById('footer-container').innerHTML = data;
          })
          .catch(err => console.error('Gabim gjatë ngarkimit të footer-it:', err));
    </script>