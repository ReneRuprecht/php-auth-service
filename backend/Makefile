
.PHONY: help test db-migrate wait-db test-unit test-application test-integration test-db-migrate

help:
		@echo " Commands:"
		@echo " db-migrate            run db migrations"
		@echo " test-unit             run unit tests"
		@echo " test-application      run application tests"
		@echo " test-integration      run integration tests"
		@echo " test-db-migrate       run test db migrations"

db-migrate:
	php bin/console doctrine:migrations:migrate --no-interaction

test-unit: 
		@output=$$(APP_ENV=test php bin/phpunit --testsuite unit 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "\033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		fi

test-application: test-db-migrate
		@output=$$(APP_ENV=test php bin/phpunit --testsuite application 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "\033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		fi

test-integration: test-db-migrate
		@output=$$(APP_ENV=test php bin/phpunit --testsuite application 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "\033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		fi

test-db-migrate:
	APP_ENV=test php bin/console doctrine:migrations:migrate --no-interaction
