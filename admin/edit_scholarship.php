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

// Initialize variables
$message = '';
$scholarship = null;

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM scholarships WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $scholarship = mysqli_fetch_assoc($result);
    } else {
        echo "Scholarship not found.";
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: manage_scholarships.php');
    exit();
}

// Handle form update submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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

    // Update query
    $sql = "UPDATE scholarships SET 
            name = '$name', 
            description = '$description', 
            eligibility = '$eligibility', 
            documents = '$documents', 
            studying_year = '$studying_year', 
            gender = '$gender', 
            category = '$category', 
            caste = '$caste', 
            minority = '$minority', 
            start_date = '$start_date', 
            last_date = '$last_date', 
            apply_url = '$apply_url' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $message = 'Scholarship updated successfully!';
        // Refresh data
        $sql = "SELECT * FROM scholarships WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $scholarship = mysqli_fetch_assoc($result);
    } else {
        $message = 'Error updating record: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Scholarship - Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>Scholarship Portal - Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <a href="manage_scholarships.php" class="back-btn">← Back to Manage Scholarships</a>

        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 20px;">Edit Scholarship</h2>

            <?php if (!empty($message)): ?>
                <div class="<?php echo strpos($message, 'Error') !== false ? 'error-message' : 'success-message'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="edit_scholarship.php">
                <input type="hidden" name="id" value="<?php echo $scholarship['id']; ?>">
                
                <div class="form-group">
                    <label>Scholarship Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($scholarship['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" required><?php echo htmlspecialchars($scholarship['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Eligibility Criteria:</label>
                    <textarea name="eligibility" required><?php echo htmlspecialchars($scholarship['eligibility']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Required Documents:</label>
                    <textarea name="documents" required><?php echo htmlspecialchars($scholarship['documents']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Studying Year:</label>
                    <input type="text" name="studying_year" value="<?php echo htmlspecialchars($scholarship['studying_year']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <select name="gender" required>
                        <option value="All" <?php if($scholarship['gender'] == 'All') echo 'selected'; ?>>All</option>
                        <option value="Male" <?php if($scholarship['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if($scholarship['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Category:</label>
                    <input type="text" name="category" value="<?php echo htmlspecialchars($scholarship['category']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Caste:</label>
                    <input type="text" name="caste" value="<?php echo htmlspecialchars($scholarship['caste']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Minority:</label>
                    <select name="minority" required>
                        <option value="No" <?php if($scholarship['minority'] == 'No') echo 'selected'; ?>>No</option>
                        <option value="Yes" <?php if($scholarship['minority'] == 'Yes') echo 'selected'; ?>>Yes</option>
                        <option value="All" <?php if($scholarship['minority'] == 'All') echo 'selected'; ?>>All</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" value="<?php echo $scholarship['start_date']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Last Date:</label>
                    <input type="date" name="last_date" value="<?php echo $scholarship['last_date']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Official Scholarship URL:</label>
                    <input type="url" name="apply_url" value="<?php echo htmlspecialchars($scholarship['apply_url']); ?>" required>
                </div>

                <button type="submit" class="btn">Update Scholarship</button>
            </form>
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
