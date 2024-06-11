function formatWaktu(ms) {
  var jam = Math.floor(ms / (1000 * 60 * 60));
  var menit = Math.floor((ms % (1000 * 60 * 60)) / (1000 * 60));
  var detik = Math.floor((ms % (1000 * 60)) / 1000);
  return jam + " jam " + menit + " menit " + detik + " detik";
}

function updateTime() {
  var cards = document.querySelectorAll(".card");
  cards.forEach((card) => {
    var waktuSewa = new Date(card.dataset.waktusewa);
    var waktuSekarang = new Date();
    var selisihWaktu = waktuSekarang - waktuSewa;
    card.querySelector(".waktuBerjalan").textContent =
      formatWaktu(selisihWaktu);
  });
}

fetch("get_rental_data.php")
  .then((response) => response.json())
  .then((data) => {
    var rentalDataDiv = document.getElementById("rentalData");
    data.forEach((item) => {
      var card = document.createElement("div");
      card.classList.add(
        "card",
        "bg-white",
        "shadow-lg",
        "rounded-lg",
        "p-4",
        "mb-4"
      );

      card.dataset.waktusewa = item.waktu_sewa;

      var container = document.createElement("div");
      container.classList.add("container");

      var rentalIdHeader = document.createElement("h4");
      rentalIdHeader.classList.add("text-lg", "font-bold", "mb-2");
      rentalIdHeader.innerHTML = "<b>Rental ID: </b>" + item.rental_id;
      container.appendChild(rentalIdHeader);

      var motorIdPara = document.createElement("p");
      motorIdPara.classList.add("text-gray-700", "mb-1");
      motorIdPara.innerHTML = "<b>Motor ID: </b>" + item.motor_id;
      container.appendChild(motorIdPara);

      var waktuSewaPara = document.createElement("p");
      waktuSewaPara.classList.add("text-gray-700", "mb-1");
      waktuSewaPara.innerHTML = "<b>Waktu Sewa: </b>" + item.waktu_sewa;
      container.appendChild(waktuSewaPara);

      var waktuBerjalanPara = document.createElement("p");
      waktuBerjalanPara.classList.add("text-gray-700", "mb-2");
      waktuBerjalanPara.innerHTML =
        '<b>Waktu Berjalan: </b><span class="waktuBerjalan"></span>';
      container.appendChild(waktuBerjalanPara);

      var btnBayar = document.createElement("button");
      btnBayar.classList.add(
        "btn-bayar",
        "px-4",
        "py-2",
        "bg-blue-500",
        "text-white",
        "rounded",
        "hover:bg-blue-700"
      );
      btnBayar.textContent = "Bayar";
      btnBayar.addEventListener("click", function () {
        var confirmation = confirm(
          "Apakah Anda yakin ingin melakukan pembayaran?"
        );
        if (confirmation) {
          window.location.href = "process_bayar.php?rentalID=" + item.rental_id;
        } else {
          console.log("Pembayaran dibatalkan.");
        }
      });
      container.appendChild(btnBayar);

      card.appendChild(container);
      rentalDataDiv.appendChild(card);
    });

    setInterval(updateTime, 1000);
  })
  .catch((error) => console.error("Error:", error));
