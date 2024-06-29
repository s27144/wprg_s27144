document.addEventListener("DOMContentLoaded", function() {
    // Pobranie elementów modalnych i przycisku zamknięcia
    var modal = document.getElementById('myModal');
    var img01 = document.getElementById("img01");
    var caption = document.getElementById("caption");
    var span = document.getElementsByClassName("close")[0];

    // Definicja funkcji, która otworzy modal
    window.onClick = function(element) {
        modal.style.display = "block";
        img01.src = element.getAttribute('src'); // Pobiera pełne źródło obrazka
        caption.innerHTML = element.alt; // Używa alt jako podpis
    }

    // Obsługa kliknięcia na przycisk zamknięcia
    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
});
