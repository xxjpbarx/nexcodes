<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,viewport-fit=cover">
    <title>TEASTREETPH</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   
   <style>
/* Modal for Location */
.modal-content.location-content {
    width: 90%;
    max-width: 980px;
    height: auto;
    background-color: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

.modal .close {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
}

.modal .close:hover,
.modal .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: auto; /* 15% from the top and centered horizontally */
  padding: 20px;
  border: 1px solid #888;
  width: 90%; /* Could be more or less, depending on screen size */
  border-radius: 8px; /* Optional: for rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: for shadow effect */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.inputBox input {
    pointer-events: auto; /* Ensure it's clickable */
    opacity: 1;          /* Ensure it's visible */
}

.inputBox span {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #444;
}

.inputBox input {
    width: 100%;
    padding: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: 'Open Sans', sans-serif;
}

/* Style the anchor link with a unique class */
.unique-link {
  text-decoration: none; /* Remove the default underline */
  color: crimson; /* Set the text color to crimson */
  display: inline-flex; /* To allow alignment with the icon */
  align-items: center; /* Align the icon and text vertically */
  font-size: 18px; /* Set the font size for the text */
  margin: 0 16px; /* Add margin to the left and right of the link */
  border: 1px solid crimson; /* Add a crimson border around the link */
  padding: 8px 16px; /* Add padding inside the link */
  border-radius: 20px; /* Round the corners of the border */
  cursor: pointer; /* Make the link clickable with a pointer cursor */
  transition: all 0.3s ease; /* Smooth transition for hover effects */
}

/* Style the icon */
.unique-link #circle {
  font-size: 24px; /* Set the size of the icon */
  margin-right: 8px; /* Add space between the icon and text */
  transition: transform 0.3s ease; /* Add smooth transition for hover effect */
}

/* Add hover effect to change icon size and link style */
.unique-link:hover {
  background-color: crimson; /* Change background color of the link */
  color: white; /* Change text color to white on hover */
  border-color: white; /* Change border color to white on hover */
}

/* Hover effect for the icon */
.unique-link:hover #circle {
  transform: scale(1.2); /* Slightly increase the size of the icon on hover */
}


    </style>

</head>
<body>

    <!-- desktop view -->
    <div class="container" id="container">
        <div id="menu">
            <div class="title">
                <img src="images/Logo.png" alt="TeastreetPH Logo">
            </div>
            <div class="menu-item">
                <a href="#"></a>
                <a href="#">About</a>
                <a href="#" onclick="showLocationModal()">Location</a>

                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
        </div>

        <div id="food-container">
            <div id="header">
                <div class="add-box">
                    <i class="your-address" id="add-address"> TEASTREETPH</i>
                </div>
                <div class="util">
                    <!-- <i class="fa fa-search"> Search</i>
                    <i class="fa fa-tags"> Offers</i> -->
                    <i class="fa fa-cart-plus" id="cart-plus"> 0 Items</i>
                </div>
            </div>
            <div id="food-items" class="d-food-items">
                <div id="milktea" class="d-milktea">
                    <p id="category-name">MilkTea</p>    
                </div>

                <div id="fruitea" class="d-fruitea">
                    <p id="category-name">Fruitea</p>    
                </div>

                <div id="coffee" class="d-coffee">
                    <p id="category-name">Coffee</p>
                </div>

                <div id="noncoffee" class="d-noncoffee">
                    <p id="category-name">Non Coffee</p> 
                </div>

                <div id="adson" class="d-adson">
                    <p id="category-name">Ads On</p> 
                </div>

                <!-- <div id="test" class="d-test">
                    <p id="category-name">TEST</p>
                </div> -->
            </div>

            <div id="cart-page" class="cart-toggle">
                <p id="cart-title">Cart Items</p>
                <p id="m-total-amount">Total Amout : 100</p>
                <table>
                    <thead>
                        <td>Item</td>
                        <td>Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </thead>
                    <tbody id="table-body">
                        
                    </tbody>
                </table>
                <div class="btn-box">
                    <button class="cart-btn" onclick="showModal()">Checkout</button>
                </div>
                
                <div class="modal" id="checkoutModal">
                    <div class="modal-content">
                        <span class="close" onclick="hideModal()">&times;</span>
                        <form action="#">
                            <div class="row">
                                <div class="col">
                                    <h3 class="title">Billing Address</h3>
                                    <div class="inputBox">
                                        <span>Full Name :</span>
                                        <input type="text" placeholder="">
                                    </div>
                                    <div class="inputBox">
                                        <span>Email :</span>
                                        <input type="email" placeholder="">
                                    </div>
                                    <div class="inputBox">
                                        <span>Contact Number :</span>
                                        <input type="number" placeholder="">
                                    </div>
                                    <div class="inputBox">
                                        <span>Address :</span>
                                        <input type="text" placeholder="">
                                    </div>
                                    <div class="inputBox">
                                        <span>City :</span>
                                        <input type="text" placeholder="">
                                    </div>
                                    <div class="flex">
                                        <div class="inputBox">
                                            <span>State :</span>
                                            <input type="text" placeholder="">
                                        </div>
                                        <div class="inputBox">
                                            <span>Zip Code :</span>
                                            <input type="text" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="title">Payment</h3>
                                    <div class="inputBox">
                                        <span>ONLY GCASH PAYMENT :</span>
                                        <img src="images/card.png" alt="">
                                    </div>
                                    <input type="submit" value="Confirm Order" class="submit-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

        <div id="cart">
            <div class="taste-header">
                <a href="login.php" class="unique-link">
                    <i class="fa fa-user-circle" id="circle"> Account</i>
                  </a>
            </div>
            <div id="category-list">
                <p class="item-menu">Categories</p>
                <div class="border"></div>                
            </div>
            <div id="checkout" class="cart-toggle">
                <p id="total-item">Total Item : 5</p>
                <p id="delievery">Delievery Fee ₱ 30</p>
                <p id="total-price"></p>

                <button class="cart-btn" onclick="showModal()">Checkout</button>
            </div>
        </div>
    </div>


    <!-- mobile view -->
    <div id="mobile-view" class="mobile-view">
        <div class="mobile-top">
            <div class="logo-box">
                <img src="images/Logo.png" alt="" id="logo">
               <h1>TEASTREETPH</h1>
            </div>
            <div class="top-menu">
                <a href="login.php">
                    <i class="fa fa-user-circle"></i>
                  </a>
                <i class="fa fa-tag"></i>
                <i class="fa fa-heart-o"></i>
                <i class="fa fa-cart-plus" id="m-cart-plus"> 0</i>
            </div>
        </div>
        
        <div class="item-container">
            <div class="category-header" id="category-header">  
            </div>

            <div id="food-items" class="food-items">
                <div id="milktea" class="m-milktea">
                    <p id="category-name">MilkTea</p>    
                </div>
                <div id="fruitea" class="m-fruitea">
                    <p id="category-name">Fruitea</p>    
                </div>
                <div id="coffee" class="m-coffee">
                    <p id="category-name">Coffee</p>
                </div>
                <div id="noncoffee" class="m-noncoffee">
                    <p id="category-name">Non Coffee</p> 
                </div>
                <div id="adson" class="m-adson">
                    <p id="category-name">Ads On</p> 
                </div>
                <div id="test" class="m-test">
                    <p id="category-name">TEST</p>
                </div>
            </div>            
        </div>

        <div class="mobile-footer">
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </div>
    </div>
    <script src="index.js" type="module"></script>
    <script>

        function showLocationModal() {
    document.getElementById("locationModal").style.display = "block";
}

function hideLocationModal() {
    document.getElementById("locationModal").style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById("locationModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};


        function showModal() {
    document.getElementById("checkoutModal").style.display = "block";
}

function hideModal() {
    document.getElementById("checkoutModal").style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById("checkoutModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

    </script>
</body>
</html>
