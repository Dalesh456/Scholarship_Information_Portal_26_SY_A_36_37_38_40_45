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

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM notices WHERE id = $id";
    mysqli_query($conn, $sql);
    header('Location: add_notice.php');
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d');

    // Insert notice
    $sql = "INSERT INTO notices (title, description, date) VALUES ('$title', '$description', '$date')";

    if (mysqli_query($conn, $sql)) {
        $message = 'Notice added successfully!';
    } else {
        $message = 'Error: ' . mysqli_error($conn);
    }
}

// Fetch all notices
$sql = "SELECT * FROM notices ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notices - Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
    <script>
        function confirmDelete(id, title) {
            if (confirm('Are you sure you want to delete "' + title + '"?')) {
                window.location.href = 'add_notice.php?delete=' + id;
            }
        }
    </script>
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
        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <h2 style="color: #2c3e50; margin-bottom: 20px;">Add New Notice</h2>

            <?php if (!empty($message)): ?>
                <div class="success-message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="add_notice.php">
                <div class="form-group">
                    <label>Notice Title:</label>
                    <input type="text" name="title" required>
                </div>

                <div class="form-group">
                    <label>Notice Description:</label>
                    <textarea name="description" required></textarea>
                </div>

                <button type="submit" class="btn">Add Notice</button>
            </form>
        </div>

        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 20px;">All Notices</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['title'] . '</td>';
                            echo '<td>' . date('d-m-Y', strtotime($row['date'])) . '</td>';
                            echo '<td>';
                            echo '<button onclick="confirmDelete(' . $row['id'] . ', \'' . addslashes($row['title']) . '\')" class="action-btn delete-btn">Delete</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4" style="text-align: center;">No notices found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
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
