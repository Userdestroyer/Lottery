docker volume rm $(docker volume ls -qf dangling=true)
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
    elif [ $1 = "test" ]; then
        docker exec php vendor/bin/phpunit $2 $3 $4
    else
        docker-compose run --rm $1 $2 $3 $4
    fi
fi
#sudo chmod 777 -R ./

#sudo find . -type f -exec chmod 644 {} \;
#sudo find . -type d -exec chmod 755 {} \;
#sudo chmod -R 777 ./storage
#sudo chmod -R 777 ./bootstrap/cache/
#sudo chmod 777 ./lottery.sh {} \;