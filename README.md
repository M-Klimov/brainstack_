Stack: NGINX, PHP 8.2, PostgreSQL, Kafka, Zookeeper

Run app: ./start-dev.sh

Endpoints:

POST http://localhost/collect

Request example:

curl --location --request POST 'http://localhost/collect' \
--header 'Content-Type: application/json' \
--data-raw '{"ip": "127.0.0.1", "userAgent": "Chrome"}'


Run tests:

1) Get inside PHP container
2) Run bin/phpunit