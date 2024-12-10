<?php
// Start the session to use session variables
session_start();

// Mock session variable for testing (replace with actual login system logic)
$_SESSION['login_type'] = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : 3; // Default to Customer for demo

?>

<style>
    .collapse a {
        text-indent: 10px;
    }
    
nav#sidebar {
    height: calc(100% - 10em); /* Adjust height to account for spacing */
    position: fixed;
    z-index: 99;
    left: 0;
    width: 225px;
    font-size: 13px;
    top: 10em;
    transition: transform 0.3s ease;
    overflow-y: auto; /* Add vertical scrollbar */
    overflow-x: hidden; /* Prevent horizontal scrolling */
    padding-right: 10px; /* Space for scrollbar */
}

nav#sidebar.hidden {
    transform: translateX(-100%);
}

/* Optional: Style scrollbar for better aesthetics */
nav#sidebar::-webkit-scrollbar {
    width: 8px;
}

nav#sidebar::-webkit-scrollbar-thumb {
    background: #adb5bd;
    border-radius: 4px;
}

nav#sidebar::-webkit-scrollbar-thumb:hover {
    background: #6c757d;
}
    
    a.nav-item {
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
        margin-bottom: 18px;
        background-color: #ffffffc4;
        color: #adb5bd;
        font-weight: 400;
    }

    .dropdown-toggle {
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
        margin-bottom: 18px;
        background-color: #ffffffc4;
        color: #adb5bd;
        font-weight: 400;
    }

    .dropdown-toggle:hover {
        background-color: #ffffffc4;
        color: #adb5bd;
    }

    .hamburger {
        position: fixed;
        z-index: 100;
        top: 2.5em;
        left: 10px;
        cursor: pointer;
        background: none;
        border: none;
        font-size: 30px;
    }
</style>

<?php if ($_SESSION['login_type'] != 3): // Only show navigation if user type is NOT Type 3 (Customer) ?>
    <button class="hamburger" id="toggleSidebar">
        &#9776; <!-- Hamburger Icon -->
    </button>

    <nav id="sidebar" class='mx-lt-5 bg-white'>
        <div class="sidebar-list">
            <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt mr-3"></i></span> Dashboard</a>
            <a href="index.php?page=sales" class="nav-item nav-email_author"><span class='icon-field'><i class="fa fa-briefcase mr-3"></i></span> Sales</a>
            <a href="billing/index.php" class="nav-item nav-takeorders"><span class='icon-field'><i class="fa fa-list-ol mr-3"></i></span> Take Orders</a>

            <!-- Accessible only to SuperAdmin (0) and Admin (1) -->
            <?php if ($_SESSION['login_type'] == 0 || $_SESSION['login_type'] == 1): ?>
                <a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i class="fa fa-clipboard-list mr-3"></i></span> Orders</a>
                <a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list-alt mr-3"></i></span> Manage Categories</a>
                <a href="index.php?page=products" class="nav-item nav-products"><span class='icon-field'><i class="fa fa-th-list mr-3"></i></span> Manage Products</a>
            <?php endif; ?>

            <!-- Dropdown for Sales Report -->
            <a href="index.php?page=sales_report" class="nav-item dropdown nav-sales_report"><span class='icon-field'><i class="fa fa-list-alt mr-3"></i></span> Sales Report</a>

            <!-- Accessible only to SuperAdmin (0) and Admin (1) -->
            <?php if ($_SESSION['login_type'] == 0 || $_SESSION['login_type'] == 1): ?>
                <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users mr-3"></i></span> Users</a>
                <a href="index.php?page=online" class="nav-item nav-support"><span class='icon-field'><i class="fa fa-users mr-3"></i></span> Online Order</a>
            <?php endif; ?>
        </div>
    </nav>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
        
        $('.nav_collapse').click(function() {
            console.log($(this).attr('href'));
            $($(this).attr('href')).collapse();
        });
        
        $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
    </script>
<?php else: ?>
    <!-- Optionally add a message if you want Type 3 users to see something -->
    <p style="text-align: center; margin-top: 50px; color: #adb5bd;">Access to this section is restricted.</p>
<?php endif; ?>
