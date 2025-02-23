# 🎟️ Event Booking System

## 📌 Project Description
This is a simple Event Booking System where users can browse events, register for them, and cancel bookings. Admins can manage events (create, edit, delete) and view bookings.

## 🚀 Features

### ✅ User Features
- User Registration & Login (passwords are securely hashed)
- View available events
- Book an event (reducing available seats)
- Cancel booking (increasing available seats)
- Responsive UI with AJAX-based booking (no page refresh)

### ✅ Admin Features
- Secure Admin Login
- Add, Edit, and Delete Events
- View all bookings
- Manage event capacity

## 🛠 Tech Stack
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP, MySQL
- **Database**: MySQL
- **Other**: AJAX (for seamless event booking), Sessions (for authentication)

## 🔧 Setup Instructions

### 1️⃣ Clone the Repository
```sh
git clone <your-github-repo-url>
cd event_booking


2️⃣ Setup the Database
Open phpMyAdmin (http://localhost/phpmyadmin/).
Click on Import and select the event_booking.sql file.
Click Go to create the database and tables.
3️⃣ Configure Database Connection
Open config.php and update the database credentials if needed:
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";      // Change if necessary
$database = "event_booking";
4️⃣ Start the Local Server
Run XAMPP (or any local server) and start Apache & MySQL.
Open your browser and go to:
http://localhost/event_booking/
📂 Database Schema

Users Table (users)
id	name	email	password	role
1	Admin	admin@example.com	(hashed)	admin
2	User1	user@example.com	(hashed)	user
Events Table (events)
id	title	description	date	venue	available_seats
1	Tech Conference	A conference on AI & ML	2025-03-10	Hall A	50
Bookings Table (bookings)
id	user_id	event_id	booking_date
1	2	1	2025-02-25 12:00:00
👤 Sample Login Credentials

🔹 Admin Login
Email: admin@example.com
Password: admin123
🔹 User Login
Email: user@example.com
Password: user123
🛡 Security Features

Password Hashing using password_hash() for security
SQL Injection Prevention with prepared statements
Session Handling for authentication
