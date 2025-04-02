document.getElementById("myInput").onclick = function(event) {
  event.stopPropagation();
};
document.getElementById("myInput2").onclick = function(event) {
  event.stopPropagation();
};
function resetFilters() {
  location.reload(); // Rifreskon faqen
}
function filterFunction2() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
  function filterFunction2() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput2");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown2");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }
 
 window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    function toggleDropdown(event, dropdownId) {
 
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          dropdowns[i].classList.remove("show");
      }

      event.stopPropagation();


      document.getElementById(dropdownId).classList.toggle("show");
  }
  document.addEventListener("DOMContentLoaded", function () {
    const kartat = document.querySelectorAll(".puna");
  
    kartat.forEach((karta) => {
        karta.addEventListener("mouseenter", () => {
            karta.style.transform = "scale(1.02)";
            karta.style.transition = "all 0.3s ease-in-out";
            karta.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
        });
  
        karta.addEventListener("mouseleave", () => {
            karta.style.transform = "scale(1)";
            karta.style.boxShadow = "0 2px 5px rgba(0, 0, 0, 0.1)";
        });
    });
  });

  function filterByCity(element) {
    let zgjedhur = element.innerText.trim(); // Merr qytetin nga dropdown
    console.log("qyteti i zgjedhur:", zgjedhur);
  
    let container = document.querySelector('#card-container'); // Container-i që mban kartat
    let qyteti = Array.from(container.getElementsByClassName('card')); // Merr të gjitha kartat me klasën 'card'
  
    let kaRezultat = false; // Variabël për të kontrolluar nëse ka rezultate
  
    qyteti.forEach(card => {
      let qytetiElement = card.querySelector('.lokacioni'); // Merr elementin e lokacionit
      let qyteti = qytetiElement ? qytetiElement.innerText.trim() : ""; // Kontrollon përmbajtjen
  
      if (zgjedhur === "Të gjitha" || zgjedhur === qyteti) {
        card.style.display = "block"; // Shfaq kartën
        card.style.margin = "10px";
        container.appendChild(card); // Vendos kartën në fund për renditje të re
        kaRezultat = true; // Gjen rezultat
      } else {
        card.style.display = "none"; // Fsheh kartën që nuk përputhet
      }
    });
  
    // Kontrollo nëse nuk ka rezultate dhe shfaq një mesazh informues
    let noResultsMessage = document.getElementById('no-results');
    if (!kaRezultat) {
      if (!noResultsMessage) {
        noResultsMessage = document.createElement('p');
        noResultsMessage.id = 'no-results';
        noResultsMessage.style.color = 'grey';
        noResultsMessage.innerText = "Nuk u gjetën rezultate për këtë kategori.";
        container.appendChild(noResultsMessage);
      }
    } else {
      if (noResultsMessage) noResultsMessage.remove(); // Fshij mesazhin nëse ka rezultate
    }
  
  }

function filterByCategory(element) {
  let zgjedhur = element.innerText.trim(); // Merr qytetin nga dropdown
  console.log("kategoria e zgjedhur:", zgjedhur);

  let container = document.querySelector('#card-container'); // Container-i që mban kartat
  let kartat = Array.from(container.getElementsByClassName('card')); // Merr të gjitha kartat me klasën 'card'

  let kaRezultat = false; // Variabël për të kontrolluar nëse ka rezultate

  kartat.forEach(card => {
    let kategoriaElement = card.querySelector('.kategoria'); // Merr elementin e kategorisë
    let kategoria = kategoriaElement ? kategoriaElement.innerText.trim() : ""; // Kontrollon përmbajtjen

    // Përdor match() për të kontrolluar përputhjen midis zgjedhur dhe kategoria
    if (zgjedhur === "Të gjitha" || zgjedhur.match(new RegExp(kategoria, 'i'))) {
        card.style.display = "block"; // Shfaq kartën
        container.appendChild(card); // Vendos kartën në fund për renditje të re
        kaRezultat = true; // Gjen rezultat
    } else {
        card.style.display = "none"; // Fsheh kartën që nuk përputhet
    }
});

  // Kontrollo nëse nuk ka rezultate dhe shfaq një mesazh informues
  let noResultsMessage = document.getElementById('no-results');
  if (!kaRezultat) {
    if (!noResultsMessage) {
      noResultsMessage = document.createElement('p');
      noResultsMessage.id = 'no-results';
      noResultsMessage.style.color = 'grey';
      noResultsMessage.innerText = "Nuk u gjetën rezultate për këtë kategori.";
      container.appendChild(noResultsMessage);
    }
  } else {
    if (noResultsMessage) noResultsMessage.remove(); // Fshij mesazhin nëse ka rezultate
  }

}