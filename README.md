
# 🎓 **Exam Seating Management System**

### *Smart. Fast. Automated. Beautiful.*

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-8+-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img src="https://img.shields.io/badge/License-MIT-00A98F?style=for-the-badge">
</p>

<p align="center">
  <img src="https://img.shields.io/github/last-commit/your-username/exam-seating-management?style=flat-square">
  <img src="https://img.shields.io/github/languages/top/your-username/exam-seating-management?style=flat-square">
</p>

---

## 🌐 **Live Demo (Optional)**

➡️ *Add your deployed link here*

```
https://yourdomain.com
```

---

# 🎥 **Preview**

> *Replace with real GIF or screenshots later*

<p align="center">
  <img src="https://via.placeholder.com/800x420.png?text=Landing+Page+Preview" width="80%">
</p>

---

# 🚀 **Overview**

**Exam Seating Management** is a modern Laravel-based platform designed to automate and simplify exam room seat allocation using:

* Smart randomization
* Room capacity validation
* Neighbour conflict avoidance
* Exportable PDF seating sheets
* Real-time dashboard metrics
* Super clean UI with glassmorphism & animations

This is the **most polished** and **feature-rich** open-source exam seating solution you’ll find.

---

# ⭐ **Key Features**

## 🧠 Intelligent Allocation

| Feature              | Description                                         |
| -------------------- | --------------------------------------------------- |
| 🎲 Random Placement  | Every click generates a new randomized seating plan |
| 🧮 Capacity Handling | Ensures rooms don’t exceed max seats                |
| 🚫 Neighbor Blocking | Avoids 2 students sitting next to each other        |
| 🔀 Shuffle Mode      | Allows instant re-arranging                         |

---

## 🎨 Frontend & UI

✔ Glassmorphism login & register
✔ Animated landing page
✔ Stats counters with animations
✔ Responsive dashboard
✔ Modern Bootstrap + custom CSS
✔ Dark-friendly color palette

---

## 🧩 System Modules

| Module                | Description                        |
| --------------------- | ---------------------------------- |
| 👨‍🎓 Student Manager | Add, import, edit, delete students |
| 🏫 Room Manager       | Add rooms, capacities, supervisors |
| 🧑‍🏫 Staff Manager   | Add invigilators & exam staff      |
| 📄 Seating Plans      | Auto-generate, export PDF, shuffle |
| 📊 Dashboard          | Live counts & metrics              |

---

# 🏛 **Architecture**

```
Exam Seating Management
│
├── Frontend  
│   ├── Blade views  
│   ├── Custom CSS (Glass, Neon Glow, Animations)
│   └── Bootstrap Icons
│
├── Backend
│   ├── Laravel 10
│   ├── Controllers (Room, Student, Plan)
│   ├── Services (Randomizer, Allocation Engine)
│   └── Middleware (Role-based access)
│
├── Database
│   ├── Students
│   ├── Rooms
│   ├── Staff
│   └── Seating Plans
│
└── PDF Engine  
    ├── DomPDF  
    └── Custom print templates
```

---

# 🛠 **Installation Guide**

## 1️⃣ Clone Repo

```bash
git clone https://github.com/yourusername/exam-seating-management.git
cd exam-seating-management
```

## 2️⃣ Install PHP Dependencies

```bash
composer install
```

## 3️⃣ Install JS Dependencies

```bash
npm install
npm run build
```

## 4️⃣ Copy .env

```bash
cp .env.example .env
```

## 5️⃣ Generate Key

```bash
php artisan key:generate
```

## 6️⃣ Configure Database

```
DB_DATABASE=exam_seating
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

## 7️⃣ Run Migrations

```bash
php artisan migrate --seed
```

## 8️⃣ Start App

```bash
php artisan serve
```

---

# 🔧 **Environment Variables**

| Variable   | Description        |
| ---------- | ------------------ |
| `APP_NAME` | Application Name   |
| `APP_ENV`  | local / production |
| `DB_*`     | MySQL connection   |
| `MAIL_*`   | SMTP mail settings |

---

# 📚 **API Endpoints (Optional)**

> *Use only if you plan to expose APIs later*

| Method | Endpoint             | Description         |
| ------ | -------------------- | ------------------- |
| GET    | `/api/students`      | List students       |
| POST   | `/api/students`      | Add student         |
| GET    | `/api/rooms`         | List rooms          |
| POST   | `/api/generate-plan` | Create seating plan |

---

# 📊 Dashboard Stats

Live dashboard displays:

* Total students
* Total rooms
* Total staff
* Plans generated
* Last plan generated time
* Highest capacity room

---

# 🖨 PDF Output

✔ Room-wise seating sheet
✔ Student seat slip
✔ QR code (optional)
✔ Supervisor printout

---

# 🔎 **Troubleshooting**

| Issue                   | Solution                                   |
| ----------------------- | ------------------------------------------ |
| Seats always same order | Clear cache → `php artisan optimize:clear` |
| PDF not generating      | Install DOMPDF extension                   |
| 500 error               | Check permissions: `chmod -R 775 storage`  |
| ngrok error             | Run `ngrok kill` then `ngrok http 8000`    |

---

# 📁 Project Structure

```
app/
 ├── Http/
 │   ├── Controllers/
 │   ├── Middleware/
 │   └── Requests/
 ├── Models/
resources/
 ├── views/
database/
 ├── migrations/
 ├── seeders/
routes/
 ├── web.php
public/
```

---

# 🤝 Contribution Guide

1. Fork repo
2. Create a feature branch
3. Commit your changes
4. Open a Pull Request

---

# 📜 License

MIT License — free to use, modify, and commercialize.

---

# ❤️ Credits

Developed with passion using **Laravel**, **Bootstrap**, and **modern UI craft**.

