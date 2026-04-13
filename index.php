<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Portal - Home</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<?php
// Include database connection
include 'db.php';

// Fetch stats
$scholarship_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM scholarships"))['count'];
$notices_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM notices"))['count'];
$category_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT category) as count FROM scholarships"))['count'];

// Close connection
mysqli_close($conn);
?>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>Scholarship Information Portal</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="scholarships.php">Scholarships</a></li>
                    <li><a href="notices.php">Notices</a></li>
                    <li><a href="admin/login.php">Admin Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
            <h1 style="text-align: center; color: #2c3e50;margin-bottom: 20px;">Welcome to Scholarship Portal</h1>
            <p style="text-align: center; font-size: 18px; margin-bottom: 20px;">
                Find and apply for the best scholarships to support your education.
            </p>
            <div style="text-align: center; margin-bottom: 75px;">
                <a href="scholarships.php" class="explore-btn">Explore Scholarships</a>
            </div>

            <!-- Quick Stats Section -->
            <div class="stats-section">
                <h3 style="text-align: center; color: #2c3e50; margin-bottom: 30px; font-size: 24px;">Quick Stats</h3>
                <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; max-width: 800px; margin: 0 auto;">
                    <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s;">
                        <div class="stat-icon" style="font-size: 48px; margin-bottom: 15px;">🎓</div>
                        <div class="stat-number" style="font-size: 36px; font-weight: bold; color: #3498db; margin-bottom: 10px;"><?php echo $scholarship_count; ?>+</div>
                        <div class="stat-label" style="font-size: 18px; color: #7f8c8d;">Scholarships Available</div>
                    </div>
                    <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s;">
                        <div class="stat-icon" style="font-size: 48px; margin-bottom: 15px;">📢</div>
                        <div class="stat-number" style="font-size: 36px; font-weight: bold; color: #e74c3c; margin-bottom: 10px;"><?php echo $notices_count; ?>+</div>
                        <div class="stat-label" style="font-size: 18px; color: #7f8c8d;">Important Notices</div>
                    </div>
                    <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s;">
                        <div class="stat-icon" style="font-size: 48px; margin-bottom: 15px;">👨‍🎓</div>
                        <div class="stat-number" style="font-size: 36px; font-weight: bold; color: #27ae60; margin-bottom: 10px;"><?php echo $category_count; ?>+</div>
                        <div class="stat-label" style="font-size: 18px; color: #7f8c8d;">Scholarship Categories</div>
                    </div>
                </div>
            </div>

            <div class="features-section">
                <h3 style="text-align: center; color: #2c3e50; margin-bottom: 30px; font-size: 24px;">Why Choose Us?</h3>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="icon">🔍</div>
                        <h4>Easy Search</h4>
                        <p>Filter scholarships by category, income, age, and state</p>
                    </div>
                    <div class="feature-card">
                        <div class="icon">📋</div>
                        <h4>Detailed Information</h4>
                        <p>Get complete eligibility and document requirements</p>
                    </div>
                    <div class="feature-card">
                        <div class="icon">🔔</div>
                        <h4>Deadline Alerts</h4>
                        <p>Never miss a scholarship deadline</p>
                    </div>
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
    document.querySelectorAll('.scholarship-card, .notice-card, .feature-card, .menu-card, .stat-card').forEach(card => {
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
