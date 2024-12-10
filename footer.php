<footer style="background-color: #fff; color: #000000; padding: 20px; text-align: center; position: fixed; bottom: 0; width: 100%;">
    <style>
        .login-name {
            color: darkblue !important;        /* Force dark blue text */
            font-weight: bold !important;      /* Force bold text */
            text-decoration: underline !important; /* Force underline */
        }
    </style>

<div>
    Logged in as: 
    <span class="login-name">
        <?php
            if (isset($_SESSION['login_name'])) {
                echo htmlspecialchars($_SESSION['login_name']); // Display the actual logged-in name
            } else {
                echo 'Guest';
            }
        ?>
    </span>

    <p><span id="liveDateTime"></span></p>
</div>

</footer>

<script>
// Function to update the date and time every second
function updateDateTime() {
    var now = new Date();
    var date = now.toLocaleDateString('en-US', {
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    });
    var time = now.toLocaleTimeString('en-US', {
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit'
    });
    document.getElementById('liveDateTime').innerHTML = date + ', ' + time;
}
// Update the time every second (1000ms)
setInterval(updateDateTime, 1000);
// Initialize the date and time when the page loads
updateDateTime();
</script>
