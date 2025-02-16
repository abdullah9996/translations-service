# Translation Management Service

## About Translation Management Service

The **Translation Management Service** is a high-performance and scalable Laravel-based application designed to manage and export translations efficiently. The system supports **100k+ records**, ensuring **fast response times (<200ms)** while adhering to industry best practices such as **PSR-12 compliance, SOLID principles, and OpenAPI documentation**.

### Key Features
- ✅ **Efficient Translation Management** – Store, retrieve, and update translations seamlessly.
- ✅ **Caching for Fast Exports** – Uses Redis or other caching mechanisms to improve performance.
- ✅ **Token-Based Authentication** – Secure API access using JWT authentication.
- ✅ **Scalability** – Designed to handle large-scale translation data.
- ✅ **Docker Support** – Easy setup and deployment with Docker.
- ✅ **High Test Coverage** – Ensures system reliability with **>95% test coverage**.

## Tech Stack
- **Backend:** Laravel 11
- **Database:** MySQL
- **Caching:** Redis
- **Authentication:** OAuth (Laravel Passport)
- **Containerization:** Docker
- **Documentation:** OpenAPI

---

## Setup Instructions

### Step 1: Clone the Repository

```bash
git clone git@github.com:abdullah9996/translations-service.git
cd translations-service
```

### Step 2: Install Dependencies

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### Step 3: Setup Environment Variables

```bash
cp .env.example .env
```

### Step 4: Start the Application

```bash
./vendor/bin/sail up -d
```

### Step 5: Generate Application Key

```bash
./vendor/bin/sail artisan key:generate
```

### Step 6: Run Database Migrations

```bash
./vendor/bin/sail artisan migrate
```

### Step 7: Seed Translations

```bash
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan app:seed-translations
```

### Step 8: Setup Passport Authentication

```bash
./vendor/bin/sail artisan passport:keys
./vendor/bin/sail artisan passport:client --personal
```

### Step 9: Test Authentication

```bash
curl -X POST http://localhost/api/login \  
  -H "Content-Type: application/json" \  
  -d '{"email": "test@example.com", "password": "password"}'
```

---

## Common Sail Commands

| Command | Description |
|---------|-------------|
| `sail artisan` | Run Artisan commands |
| `sail composer` | Run Composer commands |
| `sail npm` | Run NPM commands |
| `sail mysql` | Access MySQL database |
| `sail redis` | Access Redis CLI |
| `sail shell` | Enter container shell |

---

## Project Structure

```
├── docker-compose.yml    # Docker configuration
├── Dockerfile            # PHP container setup
├── app/Models/           # Database models
│   └── Translation.php
├── app/Http/Controllers/ # API controllers
│   └── TranslationController.php
├── config/               # Configuration files
├── database/             # Migrations and seeders
├── routes/               # API routes
│   └── api.php
└── tests/                # Feature tests
```

---

## API Endpoints

### 1. Get All Translations
- **URL:** `/translations`
- **Method:** `GET`
- **Description:** Retrieve all translations.
- **Query Parameters:**
  - `locale` (optional): Filter by locale (e.g., `en`, `es`).
  - `tag` (optional): Filter by tag (e.g., `web`, `mobile`).

### 2. Get a Single Translation
- **URL:** `/translations/{id}`
- **Method:** `GET`
- **Description:** Retrieve a single translation by ID.

### 3. Create a Translation
- **URL:** `/translations`
- **Method:** `POST`
- **Description:** Create a new translation.
- **Request Body:**

```json
{
  "key": "logout_message",
  "content": "You have been logged out.",
  "locale": "en",
  "tag": "web"
}
```

### 4. Update a Translation
- **URL:** `/translations/{id}`
- **Method:** `PUT`
- **Description:** Update an existing translation.

### 5. Export Translations
- **URL:** `/translations/export`
- **Method:** `GET`
- **Description:** Export all translations as a JSON file.

---

## License
This project is open-source and available under the [MIT License](LICENSE).

---

## Contributing
Pull requests are welcome! Please follow PSR-12 coding standards and ensure tests pass before submitting.

---

## Contact
For any inquiries, please reach out to [Muhammad Abdullah](mailto:abdullah.qasim6927@gmail.com).

