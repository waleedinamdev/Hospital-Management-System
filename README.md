# 🏥 Hospital Management System

A full-stack **Hospital Management System** built with **PHP** and **MySQL**, designed to streamline appointment booking, medical record keeping, and hospital administration through a clean, role-based web interface.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

---

## 📖 About the Project

**Vitalis** is a university group project that reimagines how a hospital handles its day-to-day operations online. Instead of juggling paper trails and disconnected spreadsheets, the system brings **patients, doctors, and administrators** into one place — where appointments can be booked, medical records tracked, and hospital data managed securely.

The project was built from the ground up in procedural PHP and MySQL, with a strong focus on clean session-based authentication and a hospital-branded, responsive front end.

---

## ✨ Features

- 🔐 **Secure Authentication** — Session-based login system with guarded admin routes via a shared auth middleware, so protected pages can't be accessed without proper login.
- 📅 **Appointment Booking** — Patients can browse available doctors and book appointments, with bookings correctly linked to their logged-in account.
- 🗂️ **Medical Records Management** — Admins get full create/read/update/delete control over patient medical records; patients get a secure, read-only view of their own history.
- 🧑‍⚕️ **Role-Based Access** — Separate flows and permissions for patients and administrators.
- 🎨 **Responsive UI** — Built with Bootstrap 5 for a clean, mobile-friendly experience across the landing page, dashboards, and module screens.
- 🧩 **Relational Data Model** — Structured MySQL schema linking user accounts to patient clinical records for accurate, consistent data.

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP (procedural) |
| **Database** | MySQL |
| **Frontend** | HTML5, CSS3, Bootstrap 5 |
| **Server Environment** | XAMPP (Apache + MySQL) |

---

## 🚀 Getting Started

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or any Apache + MySQL + PHP stack)
- A web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/waleedinamdev/Hospital-Management-System.git
   ```

2. **Move the project into your server directory**
   Place the project folder inside `htdocs` (for XAMPP users):
   ```
   C:/xampp/htdocs/Hospital-Management-System
   ```

3. **Start Apache and MySQL**
   Open the XAMPP Control Panel and start both the **Apache** and **MySQL** modules.

4. **Import the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database
   - Import the provided `.sql` file from the project directory

5. **Configure the database connection**
   Update the database credentials in the project's config file (e.g. `db.php` / `config.php`) to match your local setup.

6. **Run the project**
   Visit the project in your browser:
   ```
   http://localhost/Hospital-Management-System
   ```

---

## 👥 Team

This project was built by a 4-person university team:

- **Waleed** — Group Lead & Frontend Development
- **Abdurehman**
- **Rizwan**
- **Shafi Butt**

---

## 📌 Project Status

This is an actively maintained **university course project**. Core modules — authentication, appointment booking, and medical records — are functional, with ongoing refinements to security and UI.

---

## 📄 License

This project is open for educational use. Feel free to fork it, learn from it, and build on top of it.

---

<p align="center">Built with 💙 as part of a BS Information Technology coursework project.</p>
