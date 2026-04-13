<?php
// Include database connection
include 'db.php';

// Fetch all notices
$sql = "SELECT * FROM notices ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices - Scholarship Portal</title>
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
        <h2 style="color: #2c3e50; margin-bottom: 20px;">College Notices</h2>

        <div class="notice-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="notice-card" data-notice-id="' . $row['id'] . '">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<div class="notice-date">Posted on: ' . date('d-m-Y', strtotime($row['date'])) . '</div>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No notices available at the moment.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Scholarship Portal. All Rights Reserved.</p>
    </footer>

    <script>
        // Notification system for new notices
        document.addEventListener('DOMContentLoaded', function() {
            // Get seen notices from localStorage
            let seenNotices = JSON.parse(localStorage.getItem('seenNotices')) || [];
            let newNotices = [];

            // Get all notice cards
            const noticeCards = document.querySelectorAll('.notice-card');

            noticeCards.forEach(card => {
                const noticeId = card.getAttribute('data-notice-id');
                const noticeTitle = card.querySelector('h3').textContent;

                // Check if this notice is new
                if (!seenNotices.includes(noticeId)) {
                    newNotices.push({
                        id: noticeId,
                        title: noticeTitle
                    });
                }
            });

            // Show alerts for new notices
            if (newNotices.length > 0) {
                // Show a summary alert first
                if (newNotices.length === 1) {
                    alert(`🔔 New Notice: ${newNotices[0].title}`);
                } else {
                    alert(`🔔 ${newNotices.length} new notices available!`);

                    // Show individual alerts with a small delay
                    newNotices.forEach((notice, index) => {
                        setTimeout(() => {
                            alert(`📢 ${notice.title}`);
                        }, (index + 1) * 500); // 500ms delay between each alert
                    });
                }

                // Mark all current notices as seen
                const allNoticeIds = Array.from(noticeCards).map(card => card.getAttribute('data-notice-id'));
                localStorage.setItem('seenNotices', JSON.stringify(allNoticeIds));
            }
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
