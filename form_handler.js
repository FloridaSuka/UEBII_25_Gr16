document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".universalForm").forEach(form => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch("dergoEmailAplikim.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        form.reset();
      })
      .catch(err => {
        console.error("Gabim gjatë dërgimit:", err);
      });
    });
  });
});
