
# Requirements
### Docker



# Configuration 
```
cp env-sample .env
docker-compose up -d --build
```

## Then run following commands
```
docker-compose exec app composer install
```

#Create tables
```
docker-compose exec app php artisan migrate
```
## Add Dependencies
```
docker-compose exec app php artisan build:dependencies
```   

## run jobs
```
docker-compose exec app php artisan queue:work
```
# App Url
### This page shows some info about the device
http://localhost:8000





