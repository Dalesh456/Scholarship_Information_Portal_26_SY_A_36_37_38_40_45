<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Scholarship Portal</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>Scholarship Portal - Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">View Website</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="dashboard-header">
            <h2>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="dashboard-menu">
            <div class="menu-card">
                <h3>Manage Scholarships</h3>
                <p>(Add, update, or delete scholarships)</p>
                <br>
                <a href="add_scholarship.php">Add New Scholarship</a>
                <br><br>
                <a href="manage_scholarships.php">View All Scholarships</a>
            </div>

            <div class="menu-card">
                <h3>Manage Notices</h3>
                <p>(Add or delete college notices)</p>
                <br>
                <a href="add_notice.php">Add & Delete Notice</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Scholarship Portal. All Rights Reserved.</p>
    </footer>

    <div id="loading-spinner" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:9999;">
        <div style="border:4px solid #f3f3f3; border-top:4px solid #3498db; border-radius:50%; width:40px; height:40px; animation:spin 1s linear infinite;"></div>
    </div>

    <style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .btn-clicked {
        transform: scale(0.95);
        transition: transform 0.1s;
    }
    .card-hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: all 0.3s;
    }
    </style>

    <script>
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Button animations
    document.querySelectorAll('button, .btn, .action-btn, .explore-btn, .apply-button, .logout-btn, .back-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.add('btn-clicked');
            setTimeout(() => this.classList.remove('btn-clicked'), 300);
        });
    });

    // Hover effects for cards
    document.querySelectorAll('.scholarship-card, .notice-card, .feature-card, .menu-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('card-hover');
        });
        card.addEventListener('mouseleave', function() {
            this.classList.remove('card-hover');
        });
    });

    // Loading spinner for forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const spinner = document.getElementById('loading-spinner');
            if (spinner) {
                spinner.style.display = 'flex';
            }
        });
    });
    </script>
</body>
</html>
