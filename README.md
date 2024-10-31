# OPENSOOQ


Here's a clean, Markdown-friendly version for your `README.md` file:

---

# Project Setup Instructions

Follow these steps to set up and run the project in your local development environment.

---

## Step 1: Environment Setup
Ensure you have a local PHP development environment, such as **XAMPP**, **Laragon**, or **LAMP**. **XAMPP** is recommended.

1. **Start Apache** and **Start MySQL** in XAMPP.

---

## Step 2: Download Project Files
Retrieve the project files from GitHub or Google Drive.

- **GitHub**: If using **XAMPP**, navigate to the `htdocs` folder. Open CMD or Git Bash and run:
  ```bash
  git clone https://github.com/Sami-AL-njadat/OPENSOOQ.git
  ```

- **Google Drive**: Download the `.rar` file. If using **XAMPP**, extract it to `C:\xampp\htdocs`. If using **Laragon**, extract it to the `www` folder.

---

## Step 3: Database Import
1. Open XAMPP and click **Admin** for MySQL to access phpMyAdmin.
2. Create a new database named `opensooq`.
3. Import the SQL file from the `database` folder within the **OPENSOOQ** directory.

---

## Step 4: Run and Test
1. Open a browser and navigate to:
   ```
   http://localhost/OPENSOOQ/task/home.php
   ```

2. **Login credentials**:
   - **Username**: `opensooq`
   - **Password**: `123123`

---

