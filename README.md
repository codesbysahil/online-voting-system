# 🗳️ Online Voting System - PHP Mini Project

This is a simple and secure **Online Voting System** built with **PHP**, **MySQL**, **HTML**, and **Bootstrap** for a college mini project. It allows users (voters) to register, login, and vote for candidates. Admins can manage candidates, voters, and view/export results.

---

## 📌 Features

- 🧑‍💼 **Admin Panel**
  - Login as admin
  - Add/view candidates
  - View/delete voters
  - View/export voting results (CSV)

- 👥 **Voter Panel**
  - Register and login securely
  - Vote for one candidate
  - View live results in table and chart form

- 🔒 Session Management
- 💡 Clean UI using Bootstrap 5

---

## 📁 Folder Structure

online-voting-system/
│
├── index.php                  # Landing page (login/register)
├── register.php               # Voter registration page
├── login.php                  # Voter login page
├── dashboard.php              # Voter dashboard (vote, view status)
├── vote.php                   # Voting page (choose candidate)
├── result.php                 # Show election results
├── admin/
│   ├── login.php              # Admin login
│   ├── dashboard.php          # Admin dashboard
│   ├── add_candidate.php      # Add new candidates
│   ├── view_votes.php         # View voting details
│   ├── manage_voters.php      # View/Delete voters
│   └── logout.php             # Admin logout
├── includes/
│   ├── db.php                 # Database connection file
│   ├── auth.php               # Session validation (voter)
│   ├── admin_auth.php         # Session validation (admin)
├── assets/
│   ├── css/
│   │   └── style.css          # Custom styles
│   └── images/
│       └── (logo, candidates etc.)
├── logout.php                 # Voter logout
└── database.sql               # SQL file to create database & tables


---

## ⚙️ Setup Instructions

1. ✅ **Install XAMPP** or similar PHP server.
2. ✅ Place the folder `online-voting-system/` inside `htdocs/`.
3. ✅ Start **Apache** and **MySQL** from XAMPP Control Panel.
4. ✅ Go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin) and import the SQL file.

---

## 🧩 Database Setup

Create a database named:
Then create these tables:

```sql
-- Admin table
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Insert default admin
INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

-- Voters table
CREATE TABLE voters (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);

-- Candidates table
CREATE TABLE candidates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  party VARCHAR(100)
);

-- Votes table
CREATE TABLE votes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  voter_id INT,
  candidate_id INT,
  FOREIGN KEY (voter_id) REFERENCES voters(id),
  FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);


🔐 Login Credentials
🧑‍💼 Admin

Username: admin
Password: admin123

Change password directly in phpMyAdmin if needed.


👤 Voter Usage

Register as a voter using register.php
Login via login.php
Vote once for a candidate
View results on the dashboard
Voter emails must be unique.


🧾 Exporting Votes

Admin can click "Export Votes" in the admin panel to download a CSV file with:
Voter email
Candidate name
File: admin/export_votes.php

💬 Project By
🎓 College Mini Project
💡 Feel free to customize and expand features!

