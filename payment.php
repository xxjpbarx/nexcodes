<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEASTREETPH</title>
    
   <!--=============== BOX ICONS ===============-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
   
     <!--=============== CUSTOM CSS ===============-->

    <link rel="stylesheet" href="assets/css/homepage.css"/>

    <link rel="stylesheet" href="assets/css/payment.css" />

  </head>
  <body>

     <!--=============== NAVIGATION BAR ===============-->

<?php include 'navigation.php'; ?>
  
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


<div class="container">
    <form action="#">
        <div class="row">
            <div class="col">
                <h3 class="title">billing address</h3>
                <div class="inputBox">
                    <span>Full Name :</span>
                    <input type="text" placeholder="Joselito Markez">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" placeholder="example@gmail.com">
                </div>
                <div class="inputBox">
                    <span>Contact Number :</span>
                    <input type="number" placeholder="09xxxxxxxxx">
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" placeholder="Block - Lot - Street">
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" placeholder="San Jose Del Monte">
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>State :</span>
                        <input type="text" placeholder="Philippines">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="xxxx">
                    </div>
                </div>
            </div>
            <div class="col">
                <h3 class="title">payment</h3>
                <div class="inputBox">
                    <span>ONLY GCASH PAYMENT :</span>
                    <img src="images/card.png" alt="">
                </div>
                <input type="submit" value="Confirm Order" class="submit-btn">
                </div>
            </div>
        </div>
        
    </form>
</div>   

  <!--=============== FOOTER ===============-->
<!-- 2ndfooter.php -->
<section class="footer">
  <div class="footer-box">
    <h2>TEASTREETPH</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, facere.</p>
    <div class="social">
      <a href="https://www.facebook.com/"><i class='bx bxl-facebook'></i></a>
      <a href="https://twitter.com/"><i class='bx bxl-twitter'></i></a>
      <a href="https://www.instagram.com/"><i class='bx bxl-instagram'></i></a>
      <a href="https://www.tiktok.com/"><i class='bx bxl-tiktok'></i></a>
    </div>
  </div>

  <div class="footer-box">
    <h3>Support</h3>
    <ul>
      <li><a href="about.php">About</a></li>
      <li><a href="#">Terms Of Use</a></li>
    </ul>
  </div>

  <div class="footer-box">
    <h3>View Guides</h3>
    <ul>
      <li><a href="about.php">About Us</a></li>
      <li><a href="#">Careers</a></li>
      <li><a href="blog.php">Blog Posts</a></li>
      <li><a href="stores.php">Our Stores</a></li>
    </ul>
  </div>

  <div class="footer-box">
    <h3>Contact</h3>
    <div class="contact">
      <span><i class='bx bxs-phone'></i>+353 33 3333</span>
      <span><i class='bx bxs-envelope'></i>test@gmail.com</span>
    </div>
  </div>
</section>

  <!--=============== CUSTOM JS ===============-->


<script src="assets/js/homepage.js"></script>
</body>
</html>