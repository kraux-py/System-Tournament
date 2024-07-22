document.addEventListener("DOMContentLoaded", function() {
    fetch('conteo/get_conteo.php')
        .then(response => response.json())
        .then(data => {
            if (data.activo) {
                const countdownContainer = document.getElementById('countdown-container');
                const countdownElement = document.getElementById('countdown');
                const adminOptions = document.getElementById('admin-options');

                let countDownDate = new Date(data.fecha_hora).getTime();

                let x = setInterval(function() {
                    let now = new Date().getTime();
                    let distance = countDownDate - now;

                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = days + "d " + hours + "h " +
                        minutes + "m " + seconds + "s ";

                    if (distance < 0) {
                        clearInterval(x);
                        window.location.href = "index.html";
                    }
                }, 1000);

                if (data.isAdmin) {
                    adminOptions.style.display = 'block';
                }
            } else {
                document.getElementById('countdown-container').style.display = 'none';
            }
        });
});
