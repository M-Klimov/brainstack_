start_app_command='docker-compose up -d --build'
printf "Running: $start_app_command"
printf '\n'
$start_app_command

printf '\n'

docker_container_php_id=$(docker inspect --format="{{.Id}}" brainstack__app_php)

composer_command="docker exec $docker_container_php_id composer install -n"
printf "Running: $composer_command"
printf '\n'
$composer_command
printf '\n'

migration_command="docker exec -d $docker_container_php_id php /var/www/html/bin/console --no-interaction doc:mig:mig"
printf "Running: $migration_command"
printf '\n'
$migration_command
printf '\n'

sleep 5
# In PROD env this command should be a systemd service
consumer_command="docker exec -it $docker_container_php_id php /var/www/html/bin/console messenger:consume async -vv"

printf "Running: $consumer_command"
$consumer_command

printf '\n'

