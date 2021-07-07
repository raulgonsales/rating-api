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

generate-api-doc:
	docker-compose up -d cli
	docker-compose exec cli php ./vendor/bin/openapi . -o docs/openapi.yaml -e vendor -e tests -e var -e docker -e bin -e docs -e migrations -e config
