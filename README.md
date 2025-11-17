
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

---

# 🎥 **Preview**


<img width="1300" height="636" alt="image" src="https://github.com/user-attachments/assets/f67a6e47-cc32-406b-a177-03d7ee15609e" />
<img width="1334" height="562" alt="image" src="https://github.com/user-attachments/assets/45ce27af-1c3e-48da-a1db-7cec326fe0d6" />

<p><em><strong> Login Page</strong> </em></p>
<img width="1282" height="619" alt="image" src="https://github.com/user-attachments/assets/7008a476-ea1b-4b95-b906-6898e05e1e05" />
<p><em><strong> Admin Dashboard</strong> </em></p>

<img width="1322" height="635" alt="image" src="https://github.com/user-attachments/assets/5cb93bcd-8a6f-4ac5-8764-594e976a0632" />


<img width="1240" height="479" alt="image" src="https://github.com/user-attachments/assets/3c0fe4c5-5125-43ab-8267-accf098a4219" />


<p><em><strong> Faculty/Staff Dashboard</strong> </em></p>

<img width="1236" height="556" alt="image" src="https://github.com/user-attachments/assets/5ea6d7f8-67dd-4391-bdcc-64c05aaf9432" />
<p><em><strong> Student Dashboard</strong> </em></p>
<img width="1271" height="575" alt="image" src="https://github.com/user-attachments/assets/a228dab9-d993-49fa-89a1-210369717882" />
<p><em><strong> Student search bar view</strong> </em></p>

<img width="1280" height="465" alt="image" src="https://github.com/user-attachments/assets/852c2fff-d211-443e-b4f2-1692425050ce" />
<p><em><strong> Backend on Mysql Xamp view</strong> </em></p>


<img width="1338" height="397" alt="image" src="https://github.com/user-attachments/assets/597f25b6-0617-4146-ad82-8f2090d6fd09" />













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



# ❤️ Credits

Developed with passion using **Laravel**, **Bootstrap**, and **modern UI craft**.

<p><em><strong> Deverloped by Asjad and Umar</em></p>
