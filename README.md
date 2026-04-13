# Scholarship Information & Management Portal

## Project Description
A simple scholarship portal website for college students built as a second-year engineering mini project. The portal allows students to view scholarships, filter them based on eligibility criteria, and redirect to official scholarship application websites. An admin panel enables authorized users to manage scholarships and college notices.

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP (Procedural)
- **Database:** MySQL
- **Server:** XAMPP (Apache + MySQL)

## Features

### Student Side
1. **Home Page** - Introduction to the portal with navigation
2. **Scholarship List** - View all available scholarships with filtering options
3. **Scholarship Details** - Complete information about each scholarship
4. **Notices** - View official college notices and announcements
5. **Filter/Search** - Filter scholarships by:
   - Category (SC/ST/OBC/General)
   - Studying Year
   - Gender
   - Minority Status

### Admin Side
1. **Admin Login** - Secure login for administrators
2. **Dashboard** - Central hub for all admin operations
3. **Add Scholarship** - Add new scholarships with complete details
4. **Manage Scholarships** - View and delete existing scholarships
5. **Add/Manage Notices** - Add and delete college notices

## Database Structure

### Table 1: admin
- id (Primary Key)
- username
- password

### Table 2: scholarships
- id (Primary Key)
- name
- description
- eligibility
- documents
- studying_year
- gender
- category
- caste
- minority
- start_date
- last_date
- apply_url

### Table 3: notices
- id (Primary Key)
- title
- description
- date

## Installation & Setup

### Prerequisites
- XAMPP installed on your system
- Web browser (Chrome, Firefox, Edge, etc.)

### Step-by-Step Installation

1. **Install XAMPP**
   - Download XAMPP from https://www.apachefriends.org/
   - Install and launch XAMPP Control Panel

2. **Start Services**
   - Start Apache server
   - Start MySQL server

3. **Setup Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Click on "Import" tab
   - Choose the `database.sql` file from the project folder
   - Click "Go" to import the database
   
   **OR manually create:**
   - Create a new database named `scholarship_portal`
   - Copy and paste the SQL from `database.sql` file
   - Execute the SQL queries

4. **Access the Portal**
   - Open your web browser
   - Navigate to: `http://localhost/ssp/`

## Default Admin Credentials
- **Username:** admin
- **Password:** admin123

## File Structure
```
/scholarship_portal
│
├── index.php                    # Home page
├── scholarships.php             # Scholarship listing with filters
├── scholarship_details.php      # Detailed scholarship information
├── notices.php                  # College notices page
│
├── admin/
│   ├── login.php               # Admin login
│   ├── dashboard.php           # Admin dashboard
│   ├── add_scholarship.php     # Add new scholarship
│   ├── manage_scholarships.php # View/Delete scholarships
│   ├── add_notice.php          # Add/Delete notices
│   └── logout.php              # Logout functionality
│
├── db.php                       # Database connection
├── style.css                    # Stylesheet
├── database.sql                 # Database schema and sample data
└── README.md                    # This file
```

## Usage Guide

### For Students
1. Visit the home page
2. Click on "Scholarships" to view all available scholarships
3. Use filters to find scholarships matching your eligibility
4. Click "View Details" to see complete information
5. Click "Apply Now" to visit the official scholarship website
6. Check "Notices" for important updates

### For Administrators
1. Click "Admin Login" from the navigation menu
2. Enter username and password
3. From the dashboard, you can:
   - Add new scholarships
   - View and delete existing scholarships
   - Add new notices
   - Delete old notices
4. Logout when finished

## Sample Data Included
The database comes pre-loaded with:
- 5 sample scholarships covering various categories
- 3 sample notices
- 1 admin account

## Important Notes
- This is a beginner-friendly project suitable for mini project evaluation
- No frameworks or APIs are used
- Simple procedural PHP code for easy understanding
- Basic CSS styling focused on functionality
- All code includes clear comments for learning purposes

## Security Note
This is an educational project. For production use, implement:
- Password hashing (bcrypt/password_hash)
- SQL injection prevention (prepared statements)
- Input validation and sanitization
- HTTPS encryption
- Session security measures

## Troubleshooting

**Database Connection Error:**
- Ensure MySQL is running in XAMPP
- Check database name is `scholarship_portal`
- Verify credentials in `db.php` (default: root with no password)

**Page Not Found:**
- Ensure Apache is running
- Check the project is in `C:\xampp\htdocs\ssp\`
- Access via `http://localhost/ssp/`

**Admin Login Not Working:**
- Verify database is imported correctly
- Check admin table has the default credentials
- Clear browser cache and try again

## Project Evaluation Points
✅ Simple and beginner-friendly code  
✅ Minimum number of files  
✅ No frameworks or APIs used  
✅ Clean file structure  
✅ Functional student and admin modules  
✅ Database-driven application  
✅ Filter/search functionality  
✅ Complete CRUD operations  
✅ Session management  
✅ Suitable for viva demonstration  

## Future Enhancements (Optional)
- Student registration and login
- Application tracking system
- Email notifications
- Document upload functionality
- Advanced search with multiple filters
- Responsive design for mobile devices

## Support
For any issues or questions regarding this project, please refer to the code comments or consult your project guide.

---
**Developed as a Mini Project for Second Year Engineering**  
**Academic Year: 2024**
