<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    footer {
        background-color: #264653 !important;
        color: #FFFFFF !important;
        padding: 40px 20px 5px !important;
    }

    .footer-container {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 20px !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
    }

    .footer-nav h3 {
        color: #E9C46A !important;
        margin-bottom: 15px !important;
    }
    .footer-nav p {
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    .footer-nav ul {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    .footer-nav ul li {
        margin: 10px 0 !important;
    }

    .footer-nav a {
        text-decoration: none !important;
        color: #FFFFFF !important;
        transition: color 0.3s ease !important;
    }

    .footer-nav ul li a:hover {
        color: #E9C46A !important;
    }

    .social-icons {
        display: flex !important;
        gap: 10px !important;
    }

    .social-icons a {
        display: inline-block !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: transform 0.3s ease !important;
    }

    .btn-dergo {
        background-color: #f3f2f1 !important;
        color: #264653 !important;
        border: none !important;
        padding: 10px 20px !important;
        border-radius: 5px !important;
        cursor: pointer !important;
        transition: background-color 0.3s ease !important;
    }

    .social-icons a:hover {
        transform: scale(1.1) !important;
    }

    .social-icons img {
        width: 20px !important;
        height: 20px !important;
    }

    .footer-bottom {
        text-align: center !important;
        margin-top: 20px !important;
        border-top: 1px solid #E9C46A !important;
        padding-top: 10px !important;
    }

    .footer-contact a {
        text-decoration: none !important;
        color: #E9C46A !important;
        transition: color 0.3s ease !important;
    }

    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: 1fr !important;
        }
    }

    .contact-form {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
        width: 60% !important;
        padding-right: 10px !important;
    }
</style>
</head>

<?php
define("KONTAKT_EMAIL", "findyourway@gmail.com");
$mesazh = "";

class Kontakt {
    private $email;
    private $mesazhi;

    public function __construct($email, $mesazhi) {
        $this->email = $email;
        $this->mesazhi = $mesazhi;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMesazhi() {
        return $this->mesazhi;
    }
}

function validoEmail($email) {
    return preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $email);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emaili = $_POST['email'] ?? '';
    $teksti = $_POST['mesazhi'] ?? '';

    if (validoEmail($emaili) && strlen($teksti) >= 5) {
        $kontakt = new Kontakt($emaili, $teksti);
        $mesazh = "Faleminderit, " . htmlspecialchars($kontakt->getEmail()) . " për mesazhin tuaj!";
    } else {
        $mesazh = "&#9432 Ju lutemi plotësoni emailin dhe mesazhin në mënyrë të saktë.";
    }
}
?>

<footer id="footer">
    <div class="footer-container">
        <form method="POST" action="#footer" class="contact-form" style="padding-left: 10px;">
            <fieldset class="form-group">
                <h3 style="color: #FFFFFF;">Na kontaktoni</h3>
            </fieldset>
            <fieldset class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Shëno emailin" required>
            </fieldset>
            <fieldset class="form-group">
                <textarea name="mesazhi" class="form-control" placeholder="Mesazhi juaj.." required></textarea>
            </fieldset>
            <fieldset class="form-group text-xs-right">
                <button type="submit" class="btn-dergo">Dërgo</button>
            </fieldset>
            <?php if (!empty($mesazh)) : ?>
                <p style="color:rgb(159, 159, 159); font-size: 10px;"><?php echo $mesazh; ?></p>
            <?php endif; ?>
        </form>

        <div class="footer-social">
            <h3 style="color: #FFFFFF;">Na ndiqni në rrjete sociale</h3>
            <div class="social-icons">
                <?php
                $rrjetet = [
                    "facebook" => "https://www.facebook.com/fiek.edu",
                    "twitter" => "https://x.com/findyourwayQ",
                    "github" => "https://github.com/florjete/UEB24_GR15/",
                    "linkedin" => "https://www.linkedin.com/school/university-of-prishtina-up/posts/?feedView=all"
                ];
                foreach ($rrjetet as $emri => $linku) {
                    echo "<a href='$linku' class='icon' target='_blank'><img src='foto/{$emri}.svg' alt='{$emri}'></a>";
                }
                ?>
            </div>
        </div>

        <address class="footer-contact">
            <h3 style="color: #FFFFFF;">Na kontaktoni</h3>
            <i style="color: #FFFFFF;">Email: </i><a href="mailto:<?= KONTAKT_EMAIL ?>"><?= KONTAKT_EMAIL ?></a><br>
            <i style="color: #FFFFFF;">Nr telefoni: </i><a href="tel:+38349123456">+383 49 123 456</a> <br>
            <i style="color: #FFFFFF;">Adresa: </i>
            <a href="https://maps.app.goo.gl/8Hw7bdG147Xg8SWv7" target="_blank">
                <abbr style="color: white;" title="Fakulteti i Inxhinierisë Elektrike dhe Kompjuterike">FIEK</abbr>, Bregu i Diellit, Prishtinë
            </a>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18...2s" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </address>
    </div>

    <div class="footer-bottom">
        <p style="color: #FFFFFF;">&copy; 2024 Find Your Way. Të drejtat e rezervuara.</p>
    </div>
</footer>
