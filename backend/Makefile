
.PHONY: help test

help:
		@echo " Commands:"
		@echo " test      run tests"

test:
		@output=$$(APP_ENV=test php bin/phpunit 2>&1); \
		code=$$?; \
		if [ $$code -eq 0 ]; then \
			echo "\033[0;32mOK\033[0m"; \
		else \
			echo "$$output"; \
		fi