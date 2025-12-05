# Talenavi Backend Technical Test – Todo API (Laravel 11)

Project ini adalah implementasi technical test Backend Developer.  
Aplikasi dibangun menggunakan **Laravel 11**

## 🚀 Tech Stack

-   Laravel 11
-   PHP 8.2+
-   MySQL / MariaDB
-   Laravel Excel (maatwebsite/excel)
-   Postman / Thunder Client

---

## 📦 Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/username/talenavi-todo-api.git
cd talanavi-todo-api

composer install

DB_DATABASE=talanavi
DB_USERNAME=root
DB_PASSWORD=

```

### 2. Create Todo

**POST /api/todos**

Request Body

```
{
  "title": "Implement backend test",
  "assignee": "Raihan",
  "due_date": "2025-12-06",
  "time_tracked": 0,
  "status": "pending",
  "priority": "high"
}

```

Response

```
{
  "message": "Todo created successfully",
  "status_code": 201,
  "data": {
    "id": 1,
    "title": "Implement backend test",
    "assignee": "Raihan",
    "due_date": "2025-12-06",
    "time_tracked": 0,
    "status": "pending",
    "priority": "high",
    "created_at": "2025-12-01 10:00:00"
  }
}
```

### 2. Create Todo

**POST /api/todos**

Request Body

```
{
  "title": "Implement backend test",
  "assignee": "Raihan",
  "due_date": "2025-12-06",
  "time_tracked": 0,
  "status": "pending",
  "priority": "high"
}

```

Response

```
{
  "message": "Todo created successfully",
  "status_code": 201,
  "data": {
    "id": 1,
    "title": "Implement backend test",
    "assignee": "Raihan",
    "due_date": "2025-12-06",
    "time_tracked": 0,
    "status": "pending",
    "priority": "high",
    "created_at": "2025-12-01 10:00:00"
  }
}
```

### 2. Export Excel

**GET /api/todos/export**

### 3. Get type

**GET /api/chart?type=priority**

```
{
    "message": "Priority get successfully",
    "status_code": 200,
    "status_summary": {
        "low": 0,
        "medium": 0,
        "high": 3
    }
}
```

**GET /api/chart?type=status**

```
{
    "message": "Status get successfully",
    "status_code": 200,
    "status_summary": {
        "pending": 3,
        "open": 0,
        "in_progress": 0,
        "completed": 0
    }
}
```

**GET /api/chart?type=assignee**

```
{
    "message": "assignee get successfully",
    "status_code": 200,
    "status_summary": {
        "Raihan": {
            "total_todos": 2,
            "total_pending_todos": 2,
            "total_timetracked_completed_todos": 0
        }
    }
}
```
