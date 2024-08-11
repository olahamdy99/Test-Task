### Shipment Management

This project is a Laravel application for managing shipments and journals. It includes features for user registration, CRUD operations on shipments and journals.

## Deployment

How to run this project:

```bash
composer install
```
    
```bash
cp .env.example .env
```
    
```bash
php artisan key:generate
```

 ## Environment Variables
 
 To run this project, you will need to add the following environment variables to your .env file

	DB_PORT=3306
	
	DB_DATABASE=shipment-managment
	
	DB_USERNAME=root
	
	DB_PASSWORD=password

 ## Migration Database
```bash
  php artisan migrate:fresh --seed
```
 ## running server
```bash
    php artisan serve
```
```bash
    npm install && npm run dev
```
 ## Usage
- Register: Visit(http://127.0.0.1:8000/register) to register a new user.
- Manage shipments: Navigate to(http://127.0.0.1:8000/shipments) for CRUD operations on shipments.
- Manage journals: Navigate to (http://127.0.0.1:8000/journals) for CRUD operations on journals.
 

