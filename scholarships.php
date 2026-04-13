<?php
// Include database connection
include 'db.php';

// Initialize filter variables
$filter_search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_category = isset($_GET['category']) ? $_GET['category'] : '';
$filter_year = isset($_GET['year']) ? $_GET['year'] : '';
$filter_gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$filter_minority = isset($_GET['minority']) ? $_GET['minority'] : '';

// Build SQL query with filters
$sql = "SELECT * FROM scholarships WHERE 1=1";

if (!empty($filter_search)) {
    $sql .= " AND name LIKE '%$filter_search%'";
}

if (!empty($filter_category)) {
    $sql .= " AND category LIKE '%$filter_category%'";
}

if (!empty($filter_year)) {
    $sql .= " AND studying_year LIKE '%$filter_year%'";
}

if (!empty($filter_gender)) {
    if ($filter_gender != 'All') {
        $sql .= " AND (gender = '$filter_gender' OR gender = 'All')";
    }
}

if (!empty($filter_minority)) {
    $sql .= " AND minority = '$filter_minority'";
}

// Execute query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarships - Scholarship Portal</title>
    <link rel="stylesheet" href="style.css?v=4">
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
        <!-- Filter Section -->
        <div class="filter-section">
            <h3>Filter Scholarships</h3>
            <form method="GET" action="scholarships.php" class="filter-form">
                <!-- Search Row -->
                <div class="search-row">
                    <input type="text" name="search" placeholder="Search scholarships by name..." value="<?php echo htmlspecialchars($filter_search); ?>">
                    <button type="submit" class="search-button">Search</button>
                </div>

                <!-- Filters Grid -->
                <div class="filters-grid">
                    <div>
                        <label>Category:</label>
                        <select name="category">
                            <option value="">All Categories</option>
                            <option value="SC" <?php if($filter_category == 'SC') echo 'selected'; ?>>SC</option>
                            <option value="ST" <?php if($filter_category == 'ST') echo 'selected'; ?>>ST</option>
                            <option value="OBC" <?php if($filter_category == 'OBC') echo 'selected'; ?>>OBC</option>
                            <option value="General" <?php if($filter_category == 'General') echo 'selected'; ?>>General</option>
                        </select>
                    </div>

                    <div>
                        <label>Studying Year:</label>
                        <select name="year">
                            <option value="">All Years</option>
                            <option value="First Year" <?php if($filter_year == 'First Year') echo 'selected'; ?>>First Year</option>
                            <option value="Second Year" <?php if($filter_year == 'Second Year') echo 'selected'; ?>>Second Year</option>
                            <option value="Third Year" <?php if($filter_year == 'Third Year') echo 'selected'; ?>>Third Year</option>
                            <option value="Fourth Year" <?php if($filter_year == 'Fourth Year') echo 'selected'; ?>>Fourth Year</option>
                        </select>
                    </div>

                    <div>
                        <label>Gender:</label>
                        <select name="gender">
                            <option value="">All</option>
                            <option value="Male" <?php if($filter_gender == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if($filter_gender == 'Female') echo 'selected'; ?>>Female</option>
                            <option value="All" <?php if($filter_gender == 'All') echo 'selected'; ?>>All</option>
                        </select>
                    </div>

                    <div>
                        <label>Minority:</label>
                        <select name="minority">
                            <option value="">All</option>
                            <option value="Yes" <?php if($filter_minority == 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if($filter_minority == 'No') echo 'selected'; ?>>No</option>
                        </select>
                    </div>

                    <div class="apply-btn-container">
                        <button type="submit" class="apply-button">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Scholarship List -->
        <div class="scholarship-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="scholarship-card">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<span class="category">' . $row['category'] . '</span>';
                    echo '<p><strong>Eligibility:</strong> ' . substr($row['eligibility'], 0, 100) . '...</p>';
                    echo '<p class="last-date"><strong>Last Date:</strong> ' . date('d-m-Y', strtotime($row['last_date'])) . '</p>';
                    echo '<a href="scholarship_details.php?id=' . $row['id'] . '">View Details</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No scholarships found matching your criteria.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Scholarship Portal. All Rights Reserved.</p>
    </footer>

    <script>
        // Live search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const scholarshipCards = document.querySelectorAll('.scholarship-card');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                scholarshipCards.forEach(card => {
                    const scholarshipName = card.querySelector('h3').textContent.toLowerCase();
                    const isVisible = scholarshipName.includes(searchTerm);
                    card.style.display = isVisible ? 'block' : 'none';
                });
            });
        });
    </script>

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
