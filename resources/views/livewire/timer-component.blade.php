<div>
<div>
    <h1>Timer: <span id="timerDisplay">0</span> seconds</h1>
    <button id="finishButton">Selesai</button>
</div>

<script>
    let timer = 0;
    let interval;

    // Mulai timer
    function startTimer() {
        interval = setInterval(() => {
            timer++;
            document.getElementById('timerDisplay').innerText = timer;
        }, 1000);
    }

    // Panggil fungsi untuk memulai timer
    startTimer();

    // Tangkap event klik pada tombol "Selesai"
    document.getElementById('finishButton').addEventListener('click', function() {
        clearInterval(interval); // Hentikan timer
        @this.saveTimer(timer); // Kirim nilai timer ke Livewire
    });
</script>

</div>
