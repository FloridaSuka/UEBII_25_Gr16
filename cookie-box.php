<?php
if (isset($_COOKIE['cookiePranuar']) && $_COOKIE['cookiePranuar'] == "po") {
    if (!isset($_COOKIE['vizitor'])) {
        $vizitor = ["Mik i platformës", date("Y-m-d H:i:s")];
        setcookie("vizitor", json_encode($vizitor), time() + (86400 * 30), "/");
    }
    $v = isset($_COOKIE['vizitor']) ? json_decode($_COOKIE['vizitor'], true) : null;
}
?>
<!-- Cookie Consent Box -->
 <html>
<div id="cookieConsentBox" style="display: none; position: fixed; bottom: 20px; right: 20px; width: 320px; background-color: white; color: #264653; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.3); z-index: 9999; padding: 20px; font-family: 'Segoe UI', sans-serif;">
    <div style="display: flex; align-items: center; gap: 10px;">
        <img src="foto/cookie.svg" alt="cookie" style="width: 24px; height: 24px;">
        <h5 style="margin: 0; font-weight: bold; font-size: 20px">Përdorimi i Cookies</h5>
    </div>
    <p style="margin: 10px 0 16px; font-size: 14.4px; line-height: 1.5;">
        Kjo platformë përdor cookies për të përmirësuar përvojën tuaj. Duke klikuar "Prano", ju pranoni përdorimin e tyre.
    </p>
    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 15px;">
        <button onclick="refuzoCookies()" style="font-size: 16px; background: transparent; border: 1px solid #264653; color: #264653; border-radius: 5px; padding: 6px 12px; font-weight: 600;">Refuzo</button>
        <button onclick="pranoCookies()" style="font-size: 16px; background-color: #264653; border: none; color: white; border-radius: 5px; padding: 6px 12px; font-weight: 600;">Prano</button>
    </div>
</div>
</html>
<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    function pranoCookies() {
        document.cookie = "cookiePranuar=po; path=/; max-age=" + 60 * 60 * 24 * 30;
        document.getElementById('cookieConsentBox').style.display = 'none';
        location.reload();
    }   

    function refuzoCookies() {
        document.cookie = "cookiePranuar=jo; path=/; max-age=" + 60*60*24*30;
        document.getElementById('cookieConsentBox').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
    const consenti = getCookie("cookiePranuar");
    if (!consenti) {
        document.getElementById('cookieConsentBox').style.display = 'block';
    }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
