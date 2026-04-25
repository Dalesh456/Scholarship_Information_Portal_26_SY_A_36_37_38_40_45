<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include '../db.php';

// Initialize message
$message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $eligibility = $_POST['eligibility'];
    $documents = $_POST['documents'];
    $studying_year = $_POST['studying_year'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $caste = $_POST['caste'];
    $minority = $_POST['minority'];
    $start_date = $_POST['start_date'];
    $last_date = $_POST['last_date'];
    $apply_url = $_POST['apply_url'];

    // Insert scholarship
    $sql = "INSERT INTO scholarships (name, description, eligibility, documents, studying_year, gender, category, caste, minority, start_date, last_date, apply_url) 
            VALUES ('$name', '$description', '$eligibility', '$documents', '$studying_year', '$gender', '$category', '$caste', '$minority', '$start_date', '$last_date', '$apply_url')";

    if (mysqli_query($conn, $sql)) {
        $message = 'Scholarship added successfully!';
    } else {
        $message = 'Error: ' . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Scholarship - Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Header -->
  <?php include 'admin_header.php'; ?>

    <!-- Main Content -->
    <div class="container">
        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 20px;">Add New Scholarship</h2>

            <?php if (!empty($message)): ?>
                <div class="success-message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="add_scholarship.php">
                <div class="form-group">
                    <label>Scholarship Name:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label>Eligibility Criteria:</label>
                    <textarea name="eligibility" required></textarea>
                </div>

                <div class="form-group">
                    <label>Required Documents:</label>
                    <textarea name="documents" required></textarea>
                </div>

                <div class="form-group">
                    <label>Studying Year:</label>
                    <input type="text" name="studying_year" placeholder="e.g., First Year,Second Year,Third Year" required>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <select name="gender" required>
                        <option value="All">All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Category:</label>
                    <input type="text" name="category" placeholder="e.g., SC/ST/OBC or General" required>
                </div>

                <div class="form-group">
                    <label>Caste:</label>
                    <input type="text" name="caste" placeholder="e.g., SC,ST,OBC or All" required>
                </div>

                <div class="form-group">
                    <label>Minority:</label>
                    <select name="minority" required>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" required>
                </div>

                <div class="form-group">
                    <label>Last Date:</label>
                    <input type="date" name="last_date" required>
                </div>

                <div class="form-group">
                    <label>Official Scholarship URL:</label>
                    <input type="url" name="apply_url" placeholder="https://example.com" required>
                </div>

                <button type="submit" class="btn">Add Scholarship</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
  <?php include '../footer.php'; ?>

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
