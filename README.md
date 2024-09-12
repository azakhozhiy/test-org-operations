# Test Exercise

Requirements:
1. pgsql
2. php 8.3

## Installation

### Clone project
```
git clone git@github.com:azakhozhiy/test-org-operations.git
```

### Copy .env.example
```
cat .env.example >> .env
```

### Set your database config to .env
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=
```

### Run migrations

```
php artisan migrate:fresh --seed
```

## API endpoints

### Organisations
- /api/v1/organisations?page=2 GET - Get list of organisations
  - Filters
    - per_page, min: 25, max: 5000
- /api/v1/organisations/stats?page=2 GET - Get list of org stats
  - Filters: 
    - per_page, min: 25, max: 100
    - min_total_purchases
    - max_total_purchases
    - min_total_sales
    - max_total_sales
    - org_ids
  - Sorting:
    - order_by, possible values: ['total_purchases', 'total_sales']
    - order_direction, possible values: ['asc', 'desc']

### Operations
- /api/v1/operations?page=3 GET - Get all operations
  - Filters
    - per_page, min: 25, max: 5000
