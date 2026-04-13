-- Scholarship Portal Database
-- Drop and recreate the entire database to avoid any conflicts
DROP DATABASE IF EXISTS scholarship_portal;
CREATE DATABASE scholarship_portal;
USE scholarship_portal;

-- Table 1: Admin
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Table 2: Scholarships
CREATE TABLE scholarships (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    eligibility TEXT NOT NULL,
    documents TEXT NOT NULL,
    studying_year VARCHAR(50) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    category VARCHAR(50) NOT NULL,
    caste VARCHAR(50) NOT NULL,
    minority VARCHAR(10) NOT NULL,
    start_date DATE NOT NULL,
    last_date DATE NOT NULL,
    apply_url VARCHAR(500) NOT NULL
);

-- Table 3: Notices
CREATE TABLE notices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL
);

-- Insert Default Admin
INSERT INTO admin (username, password) VALUES ('admin', 'admin@123');

-- Insert Sample Scholarships
INSERT INTO scholarships (name, description, eligibility, documents, studying_year, gender, category, caste, minority, start_date, last_date, apply_url) VALUES
('National Scholarship Portal', 'Central Government scholarship for students from SC/ST/OBC categories', 'Students must belong to SC/ST/OBC category with family income less than 2.5 lakh per annum', 'Income Certificate, Caste Certificate, Aadhar Card, Bank Passbook', 'First Year,Second Year,Third Year,Fourth Year', 'All', 'SC/ST/OBC', 'SC,ST,OBC', 'No', '2026-01-01', '2026-12-15', 'https://scholarships.gov.in'),
('Post Matric Scholarship for Minorities', 'Scholarship for minority community students pursuing higher education', 'Students from minority communities with family income below 2 lakh', 'Income Certificate, Community Certificate, Aadhar Card, Previous Year Marksheet', 'First Year,Second Year,Third Year,Fourth Year', 'All', 'General', 'All', 'Yes', '2026-03-01', '2026-11-30', 'https://scholarships.gov.in'),
('EBC Scholarship Scheme', 'Scholarship for Economically Backward Class students', 'Students from EBC category with valid EBC certificate', 'EBC Certificate, Income Certificate, Aadhar Card, Bank Details', 'Second Year,Third Year,Fourth Year', 'All', 'OBC', 'OBC', 'No', '2026-04-01', '2026-10-31', 'https://mahadbt.maharashtra.gov.in'),
('Girls Education Scholarship', 'Special scholarship to promote education among girl students', 'Female students with minimum 60% marks in previous examination', 'Marksheet, Aadhar Card, Bank Passbook, Bonafide Certificate', 'First Year,Second Year,Third Year', 'Female', 'General', 'All', 'No', '2026-01-15', '2026-09-30', 'https://scholarships.gov.in'),
('Merit Scholarship for SC Students', 'Merit-based scholarship for SC category students', 'SC students with minimum 75% marks and family income below 2.5 lakh', 'Caste Certificate, Income Certificate, Marksheet, Aadhar Card', 'All Years', 'All', 'SC', 'SC', 'No', '2026-04-01', '2026-12-15', 'https://scholarships.gov.in'),
('State Government Open Merit Scholarship - Maha DBT', 'The scheme aims to support economically weaker students', ' Annual income less than or equal to Rs. 2,50,000.for Scheduled caste or Navbouddha\r\n', 'Income Certificate,Cast Certificate,Mark sheet for last appeared examination,SSC or HSC Marksheet,Hostel Certificate', 'First year', 'All', 'SC', 'SC', 'No', '2026-02-03', '2026-05-15', 'https://mahadbt.maharashtra.gov.in/SchemeData/SchemeData?str=E9DDFA703C38E51AC3C0DE50B5557546');

-- Insert Sample Notices
INSERT INTO notices (title, description, date) VALUES
('Scholarship Application Deadline Extended', 'The last date for National Scholarship Portal applications has been extended to 31st December 2024. Students are advised to apply before the deadline.', '2024-01-15'),

('Document Verification Schedule', 'Document verification for scholarship applicants will be conducted from 20th to 25th January 2024 in the college office. Students must bring original documents.', '2024-01-10'),

('New Scholarship Scheme Announced', 'Government has announced a new scholarship scheme for engineering students. Eligible students can apply through the official portal. More details will be shared soon.', '2024-01-05');
