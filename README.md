# 🎨 Nova

> This is a starter kit for the Nova theme, built on the Roots Bedrock project structure. It allows you to efficiently and cleanly set up a WordPress project using modern development practices.<br>
> It sets up WordPress, Roots Bedrock and the Nova theme, including deployment scripts, and creates an .env file.<br>
> When cloning an existing WordPress project to your local machine, you can use the Nova Kickstart scripts to quickly install WordPress and all of its dependencies without breaking the project. 

---

## 📖 Table of Contents

* [🛠️ Prerequisites](#-prerequisites)
* [🌟 Getting Started](#-getting-started)
* [🚀 Setting Up a New Project](#-setting-up-a-new-project)
* [📥 Setting up an Existing Project on Your Local Machine](#-setting-up-an-existing-project-on-your-local-machine)
* [🎯 Theme Setup](#-theme-setup)
* [👤 User Setup](#-user-setup)
* [🖼️ Pattern Development Guide](#-pattern-development-guide)
* [✍️ Content Editor Guide](#-content-editor-guide)
* [🚀 Deployment (TL;DR)](#-deployment-tldr)
* [🛠️ Troubleshooting](#-troubleshooting)

---

## 🛠️ Prerequisites

Ensure the following software is installed on your development machine:

* **PHP:** Version 8.2 up to 8.4
* **Composer:** [Dependency Manager for PHP](https://getcomposer.org/)
* **WP-CLI:** [Command-line interface for WordPress](https://wp-cli.org/#installing)

---

## 🌟 Getting Started

Follow the relevant instructions below, depending on whether you're starting a new project or cloning an existing one.

---

## 🚀 Setting Up a New Project

Use these steps to start a new project with Roots Bedrock and the Nova theme.<br>
It sets up a complete WordPress and Roots Bedrock project, installs the Nova theme and including deployment scripts, and creates an .env file.

Make sure to complete ALL steps before opening the new project in your browser

1. 📥 **Clone Repository** (SSH):

```bash
cd /path/to/your/projects/
git clone git@github.com:orkuncv/nova-kickstart.git <your-project-name>
```

*Replace `<your-project-name>` with your actual project name.*

2. 📂 **Navigate to the project directory:**

```bash
cd <your-project-name>
```

> Remember to rename the link to the nova git repository to avoid accidentally pushing commits to `nova-kickstart`.
```bash
cd <your-project-name>
git remote rename origin nova-kickstart
```

3. 🚦 **Kickstart the project:**

```bash
php bin/vivid kickstart
```

4. ⚙️ **Follow the kickstart prompts** to set up your project.
* **Laravel Herd issues:** `DB_HOST` defaults to `localhost`. If this causes issues, add `DB_HOST=127.0.0.1` to your `.env` file.


5. 🔑 **Obtain your Nova license key (This step is currently a `Work In Progress`. Use a `random string` as `license key` for now)**


6📌 **Install the Nova theme:**

```bash
php bin/vivid install --license-key=<license-key>
```

7🚦**Are you on Laravel Herd? Create the site in your Herd config**

```bash
cd <your-project-root>
herd link <your-project-name>
herd secure <your-project-name>
```

8 ➡️ **For Single Site: Proceed to [🎯 Theme Setup](#-theme-setup).** |
   **For Multisite: Proceed to [👤 Multisite Setup](./docs/MULTISITE.md).**

---

## 📥 Setting up an Existing Project on Your Local Machine
Use these steps to set up an existing project that was created with Nova kickstart on your local machine.<br>
The Nova Kickstart scripts quickly install WordPress and all of its dependencies without breaking the project.

1. 📥 **Clone Repository** (SSH):

```bash
cd /path/to/your/projects/
git clone <git-url> <your-project-name>
```
*Replace `<git-url>` with the actual Git URL and `<your-project-name>` with your project name.*

2. 📂 **Navigate to the project directory:**

```bash
cd <your-project-name>
```

3. 🚦 **Install WordPress/Bedrock and environment dependencies:**

```bash
php bin/vivid kickstart --existing
```

4. ⚙️ **Follow the kickstart prompts** to set up your project.
* **Laravel Herd issues:** Some users may experience issues when `DB_HOST` is set to `localhost`. To encounter this issue replace `localhost` with `127.0.0.1`.

5. 🔑 **Obtain your Nova license key (This step is currently a `Work In Progress`. Use a `random string` as `license key` for now)**


6. 📌 **Install the Nova parent theme:**

```bash
php bin/vivid install --license-key=<license-key>
```

7. ➡️ **For Single Site: Proceed to [🎯 Theme Setup](#-theme-setup).**
   **For Multisite: Proceed to [👤 Multisite Setup](./docs/MULTISITE.md).**

---

## 🎯 Theme Setup

Typically, these steps are performed once after the initial project setup (new or existing).

1. 💾 **OPTIONAL: Migrate the database (only right after kickstart and skip for multisite):**

You will get the database password in response.

Only do this if you do not already have the database running locally.

```bash
wp core install --url=<local-url> --title="<project-name>" --admin_user=<admin-username> --admin_email=<your-email> --skip-email
```

**Example**

```bash
wp core install --url=https://mywebsite.test --title="My Website" --admin_user="supportai" --admin_email=support@movve.nl --skip-email
```

2. 🎨 **Activate the Nova Parent Theme:**

```bash
wp theme activate nova
```

3. 🌱 **OPTIONAL: Create the Child Theme (skip when Setting up an Existing Project):**

```bash
wp nova create child-theme
```

4. ✅ **Activate the Child Theme:**

```bash
wp theme activate nova-child
```

5. 🧑‍💻 **OPTIONAL: Create a new Admin user (if needed):**

```bash
wp user create "<username>" <your-email> --role='administrator' --user_pass=<password>
```

6. 🔐 **Log into the WordPress Admin Dashboard and start building:**

* Go to your local URL (e.g., `https://project-name.test/login`).
* Log in with the new credentials or the password manager credentials.

7. ➡️ **Proceed to [👤 User Setup](#-user-setup).**

---

## 👤 User Setup

Typically, these steps are performed once after the initial project setup (new or existing).

1. 🛡️ Verify that the created user has the role `Administrator` and that the email address ends with `@movve.nl`.

2. 🔑 Log into the WordPress Admin Dashboard (e.g., `http://project-name.test/login`).

3. 📋 Go to **`Users`** > **`Profile`**.

4. ⬇️ Scroll down to the **`Nova Theme User Role`** section.

5. 🎯 Select the **`Developer`** role and click **`Update Profile`**.

---

## 🎨 Pattern Development Guide
For a comprehensive guide on creating and maintaining patterns in the Nova theme, refer to the **[Pattern Development Guide](./docs/PATTERN-DEVELOPMENT.md)**.
This guide covers everything from file structure to naming conventions, styling, and JavaScript integration.

---

## ✍️ Content Editor Guide
For a step-by-step manual for authors, marketers, and project managers working with the Nova WordPress site, refer to the **[Content Editor Guide](./docs/CONTENT-EDITOR-GUIDE.md)**.
This guide provides a user-friendly overview of the editor, patterns, style variations, global styles, reusable blocks, media assets, accessibility tips, SEO, and social previews.

---

## 🚀 Deployment (TL;DR)

Deployments run automatically via the GitLab CI pipeline that ships with this repo.

| Branch  | Environment | Trigger |
|---------|-------------|---------|
| `dev`   | Staging     | `git push origin dev` |
| `master`| Production  | `git push origin master` |

That’s all you need to remember. 🎉  
For environment variables, pipeline stages and troubleshooting, check **[DEPLOYMENT.md](./DEPLOYMENT.md)**.

---

## 🛠️ Troubleshooting

<details>
<summary>I am using `Laravel herd` and my project is not being linked correctly.</summary>

See [🎨 Nova Laravel Valet Drivers](./docs/DRIVERS.md) for instructions on creating a custom driver for your project.

</details>
<details>
<summary>I see the error "wp_update_themes(): An unexpected error occurred. Something may be wrong with WordPress.org or this server</summary>

This error is often related to SSL issues. Ensure you have a working SSL certificate on your dev URL.

</details>
<details>
<summary>I don't see the "Nova Theme User Role" section in my user profile</summary>

Ensure that your admin user email ends with `@movve.nl`.

</details>

---

*Last updated: May 22 2025 - Copyright © 2025 Movve. All rights reserved.*
