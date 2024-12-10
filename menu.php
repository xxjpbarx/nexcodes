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
    <link rel="stylesheet" href="assets/css/menu.css"/>
</head>
<style>
    .menu-images-container {
        display: flex; /* Flexbox layout to place images inline */
        justify-content: center; /* Center the images horizontally */
        gap: 20px; /* Add space between the images */
        flex-wrap: wrap; /* Allow items to wrap onto the next line on smaller screens */
        margin: 0 auto; /* Center the container itself */
    }

    .menu-image img {
        width: 100%; /* Set width to 100% for responsiveness */
        max-width: 450px; /* Limit the maximum width to 450px */
        height: auto; /* Maintain aspect ratio */
        object-fit: cover;
        border-radius: 20px;
    }

    @media (max-width: 600px) { /* Adjust for smaller screens */
        .menu-images-container {
            flex-direction: column; /* Stack images vertically */
            align-items: center; /* Center images when stacked */
        }

        .menu-image img {
            width: 90%; /* Make images a bit narrower on mobile */
            max-width: none; /* Remove max-width restriction */
        }
    }

    .bg-primary {
        background-color: var(--color-primary);
        color: var(--color-bg);
    }
    .bg-secondary {
        background-color: #CCF6C8;
        color: #000;
    }
    .bg-extra {
        background-color: var(--color-extra);
        color: var(--color-text);
    }
    .bg-dark {
        background-color: var(--color-dark);
        color: var(--color-text);
    }
    .footer {
        color: #000;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, auto));
        gap: 1.5rem;
        background: #F6D6AD;
    }

    .footer-box {
        display: flex;
        text-decoration: none;
        list-style: none;
        flex-direction: column;
        margin: 50px;
    }

    .footer-box h2 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .footer-box p {
        font-size: 0.938rem;
        margin-bottom: 10px;
    }

    .social {
        align-items: center;
        column-gap: 0.5rem;
    }

    .social a .bx {
        color: var(--color-text);
        font-size: 24px;
        padding: 10px;
        background: #F6D6AD;
        border-radius: 0.2rem;
    }

    .social a .bx:hover {
        background: var(--color-bg);
        color: var(--color-text);
    }

    .footer-box h3 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .footer-box li a {
        color: var(--color-text);
        text-decoration: none;
    }

    .footer-box li a:hover {
        color: var(--color-bg);
    }

    .contact {
        list-style: none;
        display: flex;
        flex-direction: column;
        row-gap: 0.5rem;
    }

    .contact span {
        display: flex;
        align-items: center;
    }

    .contact i {
        font-size: 20px;
        margin-right: 1rem;
    }
</style>
<body>

    <!--=============== NAVIGATION BAR ===============-->
  
    <?php include 'navigation.php' ?>

    <!--=============== HAMBURGER MENU ===============-->
    <button type="button" class="hamburger" id="menu-btn">
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
    </button>

    <!--=============== MOBILE MENU ===============-->
    <div class="mobile-menu hidden" id="menu">
        <ul>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="listoforder.php">Order Now</a></li>
            <li><a href="about.php">Contact</a></li>
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

    <!--=============== MENU ===============-->
    <div class="menu-images-container">
        <div class="menu-image">
            <img src="images/Coffeelist.jpg" alt="Coffee List">
        </div>
        <div class="menu-image">
            <img src="images/Milktealist.jpg" alt="Milk Tea List">
        </div>
    </div>

    <!--=============== FOOTER ===============-->
    <script src="assets/js/homepage.js"></script>
</body>
</html>
