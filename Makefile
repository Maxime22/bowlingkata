build:
	docker build -t imagebowling .

start:
	docker rm containerbowling
	docker run -it -d -v ${PWD}:/app --name containerbowling -p 8082:80 imagebowling

sh:
	docker exec -it containerbowling sh

test:
	docker exec containerbowling sh -c "php -d memory_limit=512M ./vendor/bin/phpunit --testdox"

migrate-configuration-phpunit:
	docker exec containerbowling sh -c "php -d memory_limit=512M ./vendor/bin/phpunit --migrate-configuration"