
sudo chmod -R 777 ./storage
if [ $1 = "up" ]; then
  docker-compose up -d --build
fi

if [ $1 = "down" ]; then
  docker-compose down
fi

if [ $1 = "status" ]; then
  docker container ls
fi

if [ $1 = "artisan" ]; then
    docker-compose run --rm artisan $2 $3 $4
fi

if [ $1 = "composer" ]; then
    docker-compose run --rm composer $2 $3 $4
fi
