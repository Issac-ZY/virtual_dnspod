
test:
	./vendor/bin/phpunit

db_init:
	php artisan migrate:refresh --seed
