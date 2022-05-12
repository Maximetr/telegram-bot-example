init: make-ssl-certs
	cp .env.example ./.env

up: compose-up migration seed webhook-up

compose-up:
	docker-compose --env-file ./.env up --build -d
	sleep 5

down:
	docker-compose down --remove-orphans -v

down-full:
	docker-compose down --remove-orphans -v --rmi all

make-ssl-certs:
	openssl req -x509 -nodes -days 365 -subj \
	"/C=CA/ST=QC/O=Company, Inc./CN=telegram-bot-nginx" \
	-addext "subjectAltName=DNS:telegram-bot-nginx" \
	-newkey rsa:2048 \
	-keyout ./docker/nginx/ssl-cert/nginx-selfsigned.key \
	-out ./docker/nginx/ssl-cert/nginx-selfsigned.pem;

migration:
	docker exec -it telegram-bot-php php artisan migrate

seed:
	docker exec -it telegram-bot-php php artisan db:seed

webhook-up:
	docker exec -it telegram-bot-php php artisan webhook:up
