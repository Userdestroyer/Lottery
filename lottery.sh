
if [ -z "$#" ]
then
      echo "NO ARGUMENTS"
else
    if [ $1 = "up" ]; then
        sudo docker-compose up -d --build
    elif [ $1 = "down" ]; then
        sudo docker-compose down
    elif [ $1 = "status" ]; then
        sudo docker container ls
    else
        sudo docker-compose run --rm $1 $2 $3 $4
    fi
fi
sudo chmod -R 777 ./
