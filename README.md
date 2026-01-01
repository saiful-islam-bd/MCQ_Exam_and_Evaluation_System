# 📝 MCQ Exam & Evaluation System

Laravel 12 | Role-Based | Auto Evaluation

A production-ready MCQ Exam & Evaluation System built with Laravel 12, featuring Admin & Student roles, automatic exam evaluation, and bulk MCQ creation.

---

# 🚀 Features Overview

🔐 Role-based authentication (Admin & Student)

🧠 MCQ management (Single & Bulk)

📝 Student exam interface

⚙ Automatic marks calculation

📊 Instant result display

🧩 Clean & scalable architecture

---

# 🛠 Tech Stack

| Layer           | Technology                                |
| --------------- | ----------------------------------------- |
| Backend         | Laravel 12, PHP 8.2                       |
| Frontend        | Blade, HTML, CSS, Bootstrap 5, JavaScript |
| Database        | MySQL                                     |
| Authentication  | Laravel Breeze                            |
| Authorization   | Custom Middleware                         |
| Version Control | Git                                       |

---

# 📂 Project Setup

1️⃣ Clone the Repository

git clone <repository-url>

cd mcq-exam-system

---


2️⃣ Install Dependencies

composer install

npm install

npm run build

---

3️⃣ Environment Configuration

cp .env.example .env

php artisan key:generate

---

Update database credentials in .env:

DB_DATABASE=mcq_exam

DB_USERNAME=root

DB_PASSWORD=

---

4️⃣ Run Database Migrations

php artisan migrate


(Optional seed data)

php artisan db:seed

---

5️⃣ Run the Application

php artisan serve

---

Access the app:

http://localhost:8000

---

# 👥 User Roles & Capabilities
🔑 Admin

Create MCQs (Single & Bulk)

Edit / Delete MCQs

Assign marks per question

Manage exam content

🎓 Student

View MCQs

Select answers

Submit exam

View results instantly

---


# 🧠 MCQ Structure

Each MCQ contains:

Question text

4 options

1 correct answer

Fixed mark

---


# ⚙ Core Evaluation Logic

Each question has predefined marks

Correct answer → marks added

Incorrect answer → no marks

Evaluation occurs automatically on submission

---


# 🧩 Database Design (Core Tables)

users

mcq_questions

mcq_options

exam_attempts

exam_answers



Normalized schema

Proper relationships

Indexed foreign keys

---



# 🔐 Authentication & Authorization

Email & Password authentication

Role-based middleware:

admin

student

Middleware registered via bootstrap/app.php (Laravel 12 compatible)

---

# 📌 Assumptions

One correct answer per MCQ

All students see the same questions

No negative marking

No exam time limit (extensible)

---

# 🚀 Extra Improvements Implemented

Bulk MCQ creation with dynamic UI

Transaction-safe inserts

Bootstrap responsive UI

---

# 🔮 Future Enhancements


Timed exams

Multiple exam sets

Question categories & difficulty

Result history & analytics

CSV / Excel MCQ import

Negative marking support

---

# 🧑‍💻 Author

Saiful

Laravel Developer

---

# 📄 License

This project is open-source and available for learning and educational use.


