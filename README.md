
# Dynamic CMS with Nested Pages (Laravel-11 or Vue-3)

This project is a dynamic Content Management System (CMS) built using **Laravel 11** for the backend. It supports an unlimited nested page structure, allowing you to create, manage, and display pages with dynamic routing and visual tree hierarchy.

## Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
  - [Backend Setup (Laravel)](#backend-setup-laravel)
- [Running the Project](#running-the-project)
- [Usage](#usage)
  - [Dynamic Routing](#dynamic-routing)
  - [Tree View](#tree-view)
- [Database Structure](#database-structure)
- [Development Process](#development-process)
  - [Unit Testing](#unit-testing)
  - [Tree Relationship](#tree-relationship)
- [Assumptions](#assumptions)
- [License](#license)

---

## Overview

This project features a CMS that allows pages to be nested indefinitely, enabling complex hierarchies of content. It leverages **Laravel**'s self-referencing Eloquent relationships for managing the hierarchical structure and handles dynamic routing for each page based on its position in the tree.

## Features

- **Dynamic Nested Page Structure**: Pages can be nested to any depth.
- **Dynamic Routing**: Pages can be accessed via dynamic URLs based on their hierarchical position.
- **CRUD for Pages**: Create, update, delete, and view pages.
- **Tree Visualization**: A collapsible tree view on the frontend reflects the nested page structure.
- **Self-Referencing Relationships**: Managed with Eloquent ORM in Laravel.

## Installation

### Backend Setup (Laravel)

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/CMS-APP-24.git
   cd CMS-APP-24
   ```

2. **Install dependencies**:
   Ensure Composer is installed, then run:
   ```bash
   composer install
   ```

3. **Configure environment**:
   Copy the `.env.example` to `.env` and generate the application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Update your `.env` file with the correct database connection settings.

4. **Run migrations**:
   Set up the database by running migrations:
   ```bash
   php artisan migrate
   ```

5. **Serve the backend**:
   Start the Laravel development server:
   ```bash
   php artisan serve
   ```

   The API will be available at `http://localhost:8000`.

---

## Running the Project

Once the backend is set up and running, follow these steps to run the project:

1. **Start the Laravel API (Backend)**:
   Open your terminal and navigate to the root folder of the project (where the `artisan` file is located). Run the following command to start the Laravel development server:
   ```bash
   php artisan serve
   ```
   This will start the backend API at `http://localhost:8000`.

2. **Access the Application**:
   The API will handle requests to fetch page data and resolve dynamic routes based on the hierarchical structure. For frontend visualization, you can either implement your own or integrate it as needed. However, the core backend API and routing logic are ready to be used.

---

## Usage

### Dynamic Routing

The CMS supports dynamic URLs to display nested pages. For example:

- **URL**: `/page1` → Displays content for `Page1`
- **URL**: `/page1/page2` → Displays content for `Page2` (child of `Page1`)
- **URL**: `/page1/page2/page1` → Displays `Page1` under `Page2`
- **URL**: `/page1/page2/page3/page4` → Displays `Page4` under `Page3`

Routing is handled dynamically based on the page hierarchy stored in the database.

### Tree View

Although the frontend is not part of this backend setup, the backend provides a robust API for querying the hierarchical page data. You can build your own frontend tree view or integrate with any frontend system to display the nested page structure. This can be a collapsible tree or any visualization method based on the structure retrieved from the backend.

---

## Database Structure

### Pages Table

The **Pages** table is designed with a self-referencing relationship to support unlimited nesting. It includes the following columns:

| Column     | Type      | Description                                              |
|------------|-----------|----------------------------------------------------------|
| id         | INT       | Primary key                                              |
| parent_id  | INT       | Parent page ID (nullable for root-level pages)           |
| slug       | VARCHAR   | Slug used for dynamic routing (non-unique)                |
| title      | VARCHAR   | Title of the page                                        |
| content    | TEXT      | Content of the page                                      |

**Self-referencing relationship**: Each page can have a parent page (`parent_id`), and the `slug` is used to resolve dynamic routes.

---

## Development Process

### Unit Testing

Unit tests have been written for critical backend logic, including:

- **Page CRUD operations**: Ensures that pages can be created, updated, and deleted correctly.
- **Route resolution**: Tests that the dynamic routing logic works for resolving nested pages.
- **Tree relationships**: Verifies that pages maintain proper parent-child relationships during CRUD operations.

### Tree Relationship

The **Pages** model uses Eloquent ORM's self-referencing relationships to manage the hierarchical data:

```php
public function parent()
{
    return $this->belongsTo(Page::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(Page::class, 'parent_id');
}
```

This structure allows easy navigation and manipulation of nested pages.

---

## Assumptions

- **Non-unique Slugs**: Pages can have the same slug, but they are distinguished by their position in the hierarchy.
- **Dynamic Routes**: Routes are not hardcoded and are generated dynamically based on the page hierarchy.
- **Database**: The database used is **MySQL**.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

### Conclusion

This dynamic CMS supports nested pages with unlimited depth, dynamic routing, and a flexible CRUD system. It is built using **Laravel** for the backend, focusing on scalability and maintainability.
