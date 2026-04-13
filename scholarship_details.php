<?php
// Include database connection
include 'db.php';

// Get scholarship ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch scholarship details
$sql = "SELECT * FROM scholarships WHERE id = $id";
$result = mysqli_query($conn, $sql);
$scholarship = mysqli_fetch_assoc($result);

// If scholarship not found, redirect
if (!$scholarship) {
    header('Location: scholarships.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $scholarship['name']; ?> - Scholarship Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
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
        <a href="scholarships.php" class="back-btn">← Back to Scholarships</a>

        <div class="scholarship-details">
            <h2><?php echo $scholarship['name']; ?></h2>

            <div class="detail-row">
                <strong>Description:</strong>
                <?php echo $scholarship['description']; ?>
            </div>

            <div class="detail-row">
                <strong>Eligibility Criteria:</strong>
                <?php echo $scholarship['eligibility']; ?>
            </div>

            <div class="detail-row">
                <strong>Required Documents:</strong>
                <?php echo $scholarship['documents']; ?>
            </div>

            <div class="detail-row">
                <strong>Studying Year Allowed:</strong>
                <?php echo $scholarship['studying_year']; ?>
            </div>

            <div class="detail-row">
                <strong>Gender Allowed:</strong>
                <?php echo $scholarship['gender']; ?>
            </div>

            <div class="detail-row">
                <strong>Category:</strong>
                <?php echo $scholarship['category']; ?>
            </div>

            <div class="detail-row">
                <strong>Caste:</strong>
                <?php echo $scholarship['caste']; ?>
            </div>

            <div class="detail-row">
                <strong>Minority:</strong>
                <?php echo $scholarship['minority']; ?>
            </div>

            <div class="detail-row">
                <strong>Scholarship Start Date:</strong>
                <?php echo date('d-m-Y', strtotime($scholarship['start_date'])); ?>
            </div>

            <div class="detail-row">
                <strong>Scholarship Last Date:</strong>
                <?php echo date('d-m-Y', strtotime($scholarship['last_date'])); ?>
            </div>

            <div class="detail-row">
                <strong>Who Can Apply:</strong>
                Students who meet the above eligibility criteria and belong to the specified category can apply for this scholarship.
            </div>

            <a href="<?php echo $scholarship['apply_url']; ?>" target="_blank" class="apply-button">
                Apply Now (Official Website)
            </a>
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

<?php
// Close connection
mysqli_close($conn);
?>
