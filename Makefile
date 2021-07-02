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

