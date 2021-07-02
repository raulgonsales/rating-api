up:
	docker-compose up -d
	@echo ""
	@echo "Api is running on http://localhost:81"
	@echo "Adminer is running on http://localhost:83"
	@echo "In Adminer: mysql:host=db;dbname=rating_api;user/pass"
	@echo ""

stop:
	docker-compose stop

check: test stan

test:
	docker-compose up -d cli
	docker-compose exec cli php vendor/bin/tester -c /code/tests/ci_php.ini tests
	docker-compose exec cli composer unit
	docker-compose exec cli php -n -c tests/ci_php.ini -d memory_limit=768M vendor/bin/phpstan analyse -l max -c phpstan.neon app/
	docker-compose exec cli php vendor/bin/phpcs -n -d memory_limit=512M --standard=tests/PhpCodeSniffer.xml app/ tests/

stan:
	docker-compose up -d cli
	docker-compose exec cli composer sniff-fix

migrate:
	docker-compose up -d cli db
	docker-compose exec cli vendor/bin/phinx migrate -e development
