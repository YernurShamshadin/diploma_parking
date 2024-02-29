
composer-install:
	- docker exec -ti diploma_parking_php-fpm_1 composer install

optimize:
	- docker exec -ti diploma_parking_php-fpm_1 php artisan optimize

clean:
	- docker exec -ti diploma_parking_php-fpm_1 php artisan optimize:clear

clean-dependencies:
	- rm -rf vendor

swagger:
	- docker exec -ti diploma_parking_php-fpm_1 php artisan l5-swagger:generate

key-generate:
	- docker exec -ti diploma_parking_php-fpm_1 php artisan key:generate