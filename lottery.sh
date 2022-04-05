
sudo chmod -R 777 ./src/storage
if [ $1 = "up" ]; then
  sudo docker-compose up -d --build
fi

if [ $1 = "down" ]; then
  sudo docker-compose down
fi

if [ $1 = "status" ]; then
  sudo docker container ls
fi

if [ $1 = "artisan" ]; then
    sudo docker-compose run --rm artisan $2 $3 $4
fi