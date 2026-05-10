
.PHONY: help test db-migrate wait-db test-unit test-application test-integration test-db-migrate phpstan cf-fix cf-diff check

help:
		@echo " make db-migrate            run db migrations"
		@echo " make test-unit             run unit tests"
		@echo " make test-application      run application tests"
		@echo " make test-integration      run integration tests"
		@echo " make test-db-migrate       run test db migrations"
		@echo " make phpstan               run phpstan analyze src tests"
		@echo " make cf-fix                run cs-fixer fix"
		@echo " make cf-diff               run cs-fixer fix --dry-run --diff"
		@echo " make check                 run phpstan, cf-diff"
		@echo " make create-keys           create config/jwt_test keys"

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
		@output=$$(APP_ENV=test php bin/phpunit --testsuite integration 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "\033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		fi

test-db-migrate:
	APP_ENV=test php bin/console doctrine:migrations:migrate --no-interaction

phpstan:
		@output=$$(./vendor/bin/phpstan analyze src tests 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "PHPSTAN \033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		    echo "PHPSTAN \033[0;31mERROR\033[0m"; \
		fi

cf-fix:
	./vendor/bin/php-cs-fixer fix

cf-diff:
		@output=$$(./vendor/bin/php-cs-fixer fix --dry-run --diff 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "CS FIXER \033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		    echo "CS FIXER \033[0;31mERROR\033[0m"; \
		fi

check: phpstan cf-diff

create-keys:
		mkdir -p config/jwt_test
		openssl genrsa -out config/jwt_test/private.pem 2048
		openssl rsa -pubout -in config/jwt_test/private.pem -out config/jwt_test/public.pem 