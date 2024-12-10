<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEASTREETPH</title>
    
    <!--=============== BOXICONS ===============-->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     <!--=============== CUSTOM STYLES ===============-->
  
    <link rel="stylesheet" href="assets/css/homepage.css" />

    <link rel="stylesheet" href="assets/css/stores.css" />
   

  </head>
  <body>

    <!--=============== NAVIGATION BAR ===============-->

  <?php include 'navigation.php' ?>

         <!--=============== HAMBURGER MENU ===============-->

        <button type="button" class="hamburger" id="menu-btn">
          <span class="hamburger-top"></span>
          <span class="hamburger-middle"></span>
          <span class="hamburger-bottom"></span>
        </button>
      </div>
    </nav>

     <!--=============== MOBILE MENU ===============-->

     <div class="mobile-menu hidden" id="menu">
  <ul>
    <li><a href="menu.php">Menu</a></li>
    <li><a href="listoforder.php">Order Now</a></li>
    <li><a href="about.php">About</a></li>
  </ul>
  <div class="mobile-menu-bottom">
    <button class="btn btn-dark-outline">Sign in</button>
    <button class="btn btn-dark">Join now</button>
    <div>
      <a href="stores.php">
        <img src="images/marker.svg" alt="" />
        <span>Find a store</span>
      </a>
    </div>
  </div>
</div>


<section>
    <div class="store-container" style="max-width: 980px; height: 470px; overflow: hidden;">
        <div class="content-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; text-align: center;">
            <h3>Towerville brgy sto.cristo Infront of Towerville Elementary School</h3>
            <p>Opened Monday - Sunday: 11am - 9pm</p>
        </div>
        <div class="map" style="width: 100%; height: 100%;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.818874130231!2d121.0825282756222!3d14.83542018262453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397a5f9b2349d8d%3A0x47fd39cc7d7002d6!2sTowerville%20Elementary%20School!5e0!3m2!1sen!2sph!4v1730916749180!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                width="980" 
                height="470" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>




    <!--=============== FOOTER ===============-->
<?php include 'front/footer.php'; ?>


    <script src="assets/js/homepage.js"></script>
</body>
</html>