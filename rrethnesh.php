<!DOCTYPE html>
<html lang="sq">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="language" content="sq" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <title>Rreth nesh</title>
    <link rel="stylesheet" href="rrethnesh.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <!-- importo file te html per nav ne div -->
    <div id="header-container"></div>
    <script src="navHandler.js"></script>
    <script>
      fetch("nav.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("header-container").innerHTML = data;
          setupNavigation(); // Funksioni nga navHandler.js
          const loginIcon = document.getElementById("loginIcon");
          const loginModal = document.getElementById("loginModal");
          const closeBtn = document.getElementById("closeBtn");
          const initialPosition = { top: 50, left: 50 }; // Pozita fillestare e modalit

          //hap modalin
          if (loginIcon) {
            loginIcon.addEventListener("click", () => {
              loginModal.style.display = "block";
              loginModal.style.top = `${initialPosition.top}px`;
              loginModal.style.left = `${initialPosition.left}px`;
            });
          }
          //mbyll modalin
          if (closeBtn) {
            closeBtn.addEventListener("click", () => {
              loginModal.style.display = "none";
            });
          }
          // Kthimi i modalit në pozitën fillestare
          loginModal.addEventListener("dblclick", () => {
            loginModal.style.top = `${initialPosition.top}px`;
            loginModal.style.left = `${initialPosition.left}px`;
          });
          //mbyllja kur klikohet jasht modalit
          window.addEventListener("click", (e) => {
            if (e.target === loginModal) {
              loginModal.style.display = "none";
            }
          });
          // Drag and drop
          let offsetX = 0,
            offsetY = 0;

          loginModal.addEventListener("dragstart", (e) => {
            const rect = loginModal.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
          });

          document.addEventListener("dragover", (e) => {
            e.preventDefault();
          });

          document.addEventListener("drop", (e) => {
            e.preventDefault();
            const x = e.clientX - offsetX;
            const y = e.clientY - offsetY;
            loginModal.style.top = `${y}px`;
            loginModal.style.left = `${x}px`;
          });
        })
        .catch((err) =>
          console.error("Gabim gjatë ngarkimit të header-it:", err)
        );
    </script>
    <h1 id="rrethnesh">Rreth nesh</h1>
    <div style="text-align: center; margin-top: 40px">
      <img
        src="foto/FotoLogo.webp"
        alt="Logo"
        id="fotoRrethNesh"
        style="width: 310px; height: auto; float: right; right: 80px"
      />
    </div>
    <p
      style="
        text-align: justify;
        padding: 0 10px;
        max-width: 800px;
        margin-left: 30px;
        margin-right: auto;
        margin-bottom: 30px;
      "
    >
      Tek Find Your Way, ne besojmë se rruga drejt suksesit fillon me mundësitë
      e duhura. <br />
      Ne jemi një platformë inovative që lidh individët e talentuar me
      punëdhënës të besuar, duke krijuar ura midis ëndrrave dhe realitetit
      profesional. Misioni ynë është të fuqizojmë individët për të gjetur rrugën
      e tyre drejt karrierës së dëshiruar, duke ofruar një eksperiencë të lehtë,
      të shpejtë dhe të personalizuar.
      <br />Ne bashkëpunojmë me kompani nga industri të ndryshme, për të
      siguruar mundësi të ndryshme pune që i përshtaten aftësive dhe ambicieve
      të secilit përdorues. Duke përdorur teknologjinë më të fundit, ne
      ndihmojmë përdoruesit tanë të zbulojnë dhe të aplikojnë për pozitat që
      përputhen më së miri me qëllimet e tyre profesionale. Na besoni për të
      qenë udhërrëfyesi juaj në rrugën drejt suksesit. <br />

      Bashkohuni me Find Your Way dhe filloni udhëtimin tuaj drejt një të
      ardhmeje më të ndritur. Jemi këtu për të bërë ndryshimin në jetën tuaj
      profesionale, duke ju mbështetur në çdo hap të rrugës. Nëse jeni duke
      kërkuar punën e parë, një hap të madh në karrierë ose një ndryshim drejt
      një fushe të re, Find Your Way është partneri juaj i besuar.
      <br /><b>Filloni sot dhe gjeni rrugën tuaj drejt suksesit!</b>
      <br />
      <br />
    </p>

    <div class="canvas" style="padding-top: 50px">
      <h3 class="h3">Rruga jonë drejt suksesit.</h3>
      <canvas
        id="timelineCanvas"
        width="1100"
        height="300"
        style="margin-top: 40px"
      ></canvas>
    </div>
    <script>
      const canvas = document.getElementById("timelineCanvas");
      const ctx = canvas.getContext("2d");

      const events = [
        { year: 2018, title: "Fillimi i Kompanisë" },
        { year: 2020, title: "Zhvillimi i Shërbimeve të Reja" },
        { year: 2021, title: "Marrëveshje me Partnerë të Njohur" },
        { year: 2024, title: "Lider në\nPunësimin e\n të rinjëve" }, // Shembull me "\n"
      ];

      let currentEvent = 0;

      function drawTimeline() {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Pastrimi i canvas-it

        // Vizatimi i vijës së kohës
        ctx.beginPath();
        ctx.moveTo(50, 150);
        ctx.lineTo(canvas.width - 50, 150);
        ctx.strokeStyle = "#264653";
        ctx.lineWidth = 2;
        ctx.stroke();

        // Vizatimi i pikave dhe viteve
        for (let i = 0; i <= currentEvent; i++) {
          const xPosition =
            50 + i * ((canvas.width - 100) / (events.length - 1));
          const yPosition = 150;

          // Vizato rrethin për ngjarjen
          ctx.beginPath();
          ctx.arc(xPosition, yPosition, 8, 0, Math.PI * 2);
          ctx.fillStyle = "#ff9800";
          ctx.fill();

          // Shfaq vitin mbi ngjarjen
          ctx.fillStyle = "#333";
          ctx.font = "14px Arial";
          ctx.fillText(events[i].year, xPosition - 15, yPosition - 20);
        }

        // Shfaq titullin e ngjarjes së fundit (me thyerje teksti)
        if (currentEvent >= 0 && currentEvent < events.length) {
          const xTextPos =
            50 +
            currentEvent * ((canvas.width - 100) / (events.length - 1)) -
            50;
          const yTextPos = 180;

          const title = events[currentEvent].title.split("\n"); // Ndaje tekstin në linja
          ctx.fillStyle = "#333";
          ctx.font = "16px Arial";

          title.forEach((line, index) => {
            ctx.fillText(line, xTextPos, yTextPos + index * 20); // Çdo linjë më poshtë me 20px
          });
        }
      }

      function animateTimeline() {
        if (currentEvent < events.length) {
          drawTimeline();
          currentEvent++;
          setTimeout(animateTimeline, 1500); // Animimi çdo 1.5 sekondë për ngjarje
        }
      }

      animateTimeline(); // Fillimi i animimit
    </script>
                <div class="reviews-section">
    <h1 ><mark style="color: #ff9800; ">Çfarë thonë klientët tanë?</mark></h1>
    <div class="reviews-container">
    <?php
    class Reviewer {
        public $foto;
        public $name;
        public $review_text;
        public $rating;
    
        function __construct($foto, $name,$rating, $review_text) {
            $this->foto = $foto;
            $this->name = $name;
            $this-> rating = $rating;
            $this->review_text = $review_text;

        }

        function shfaq() {
          echo '
            <div class="review-card">
              <div class="review-header">
                <img src="' . $this->foto . '" alt="Customer" />
                <div class="name">' . $this->name . '</div>
              </div>
              <div class="review-rating">' . $this->rating . '</div>
              <div class="review-text">' . $this->review_text . '</div>
            </div>';
        }
    }

    $reviews = [
        new Reviewer("foto/profile1.jpg", "John D.","★★★★★","Kjo është platforma më e mirë që kam përdorur ndonjëherë për të
            gjetur projekte freelance. Shumë profesionale dhe e lehtë për t’u
            përdorur! "),
        new Reviewer("foto/profile2.jpg", "Jane S.","★★★★☆"," Kjo faqe më ndihmoi të gjej punën e ëndrrave në vetëm dy javë!
            Ndërfaqja është e lehtë për t’u përdorur dhe filtrat më ndihmuan të
            gjej pikërisht ofertat që më përshtateshin."),
        new Reviewer("foto/profile3.jpg","Alex J.","★★★★★","Gjetja e një pune të re ishte stresuese derisa përdora këtë
            platformë. E thjeshtë për t’u naviguar dhe plot me oferta të
            përditësuara pune në sektorin tim."),
        new Reviewer("foto/profile4.jpg","Chris N.","★★★★☆","Kam aplikuar për disa pozita nëpërmjet kësaj platforme dhe brenda
            një muaji mora disa oferta! Mund të përmirësojnë më tej mënyrën e
            krijimit të profilit, por në përgjithësi jam shumë e kënaqur."),
        new Reviewer("foto/profile5.jpg","Mark L.","★★★★★","Platforma është shumë e dobishme për rekrutuesit. Gjetëm disa
            kandidatë të shkëlqyer për pozitat që kishim të hapura. Sistemi i
            komunikimit të brendshëm është një veçori që na ka kursyer shumë
            kohë."),
        new Reviewer("foto/profile6.jpg","Sophie H.","★★★★☆","Një mjet shumë i dobishëm për profesionistët financiarë. Filtrat e
            kërkimit janë shumë të detajuar dhe të saktë. Do të ishte mirë nëse
            do të shtonin më shumë artikuj për karrierën.")
    ];

    foreach ($reviews as $review) {
        $review->shfaq();
    }
?>
</div>
</div>

    

    <section id="statistics">
      <h2 style="color: #ff9800">Statistikat tona</h2>
      <div id="stats-container"></div>
      <button id="show-more-stats">Shfaq më shumë</button>
    </section>

    <script>
      const stats = [
        { number: 500, label: "Përdorues të regjistruar" },
        { number: 95, label: "Përqindja e kënaqësisë së përdoruesve" },
        { number: 200, label: "Kompanitë që bashkëpunojnë me ne" },
      ];

      const statsHTML = stats.reduce((html, stat) => {
        return (
          html +
          `
                <div class="stat">
                    <p class="stat-number">${stat.number}</p>
                    <p class="stat-label">${stat.label}</p>
                </div>
            `
        );
      }, "");

      document.getElementById("stats-container").innerHTML = statsHTML;
    </script>
    <article class="content">
      <h1 class="h1">Rreth Nesh</h1>
      <p class="p" id="history">
        Ne filluam në vitin 2018 dhe kemi punuar me projekte në teknologji dhe
        design.
      </p>
      <p class="p" id="details"></p>
      <p class="p" id="info"></p>
      <button onclick="modifyHistory()">Shiko Historinë e Përditësuar</button>
    </article>

    <script>
      function CompanyHistory(yearFounded, achievements, slogan) {
        this.yearFounded = yearFounded;
        this.achievements = achievements;
        this.slogan = slogan;
      }

      // Krijimi i një instance të objektit për historinë e kompanisë
      const companyHistory = new CompanyHistory(
        2018,
        "projekti i parë në teknologji dhe design",
        "Inovacion, Kreativitet, Succes"
      );
      // Funksioni që përdor 'replace' dhe 'match'
      function modifyHistory() {
        let historyText = `Ne filluam në vitin ${companyHistory.yearFounded} dhe kemi punuar me ${companyHistory.achievements}.`;

        // Përdorimi i match() për të kontrolluar nëse fjala "projekti" është në tekst
        const isProjectMentioned = historyText.match("projekti");
        if (isProjectMentioned) {
          historyText = historyText.replace(
            "projekti",
            "përvojën e parë të suksesshme"
          );
        }

        // Shtimi i informacionit tjetër
        historyText += ` Slogani ynë është: "${companyHistory.slogan}".`;

        // Vendosja e tekstit të përditësuar në HTML
        document.getElementById("details").innerText = historyText;
      }
    </script>
    <!-- footer imported -->
    <div id="footer-container"></div>
    <script>
      // JavaScript per ngarkim te footer-it nga file-i i jashtem
      fetch("footer.html")
        .then((response) => response.text())
        .then((data) => {
          // Vendos pjese e footer-it ne div-in me id="footer-container"
          document.getElementById("footer-container").innerHTML = data;
        })
        .catch((err) =>
          console.error("Gabim gjat&#235 ngarkimit te footer-it:", err)
        );
    </script>

    <script>
      $(document).ready(function () {
        // Inicializimi i statistikave me animacion për t'u shfaqur gradualisht
        $(".stat-number").each(function () {
          $(this)
            .prop("Counter", 0)
            .animate(
              {
                Counter: $(this).text(),
              },
              {
                duration: 2000,
                easing: "swing",
                step: function (now) {
                  $(this).text(Math.ceil(now));
                },
              }
            );
        });
        setTimeout(function () {
          // Funksioni i animacionit
        }, 10000); // Vonon animacionin për 3 sekonda

        // Shfaqja e më shumë statistikave me një animacion slide
        $("#show-more-stats").click(function () {
          $(this).hide(); // Fshih butonin pasi është klikuar
          $(
            "<p class='extra-stat'>Ne kemi ndihmuar mbi 5000 individë të gjejnë mundësi pune!</p>"
          )
            .hide()
            .appendTo("#statistics")
            .fadeIn(1000);
          $(
            "<p class='extra-stat'>Platforma jonë ka më shumë se 30 partnerë globalë!</p>"
          )
            .hide()
            .appendTo("#statistics")
            .fadeIn(1000);
        });
      });
    </script>
  </body>
</html>
