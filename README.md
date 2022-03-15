# Installation
- Install Docker
- Copy env `cp env.example .env`
- Build and start containers `docker-compose build && docker-compose up -d`
- Install dependencies `docker-compose exec php composer i`
- Generate app key `docker-compose exec php php artisan key:generate`
- Start migrations `docker-compose exec php php artisan migrate --seed`
