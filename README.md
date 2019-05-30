# php-hexagonal-arquiteture
Repositório do curso sobre Arquitetura Hexagonal em PHP ministrado pelo Lucas de Oliveira (deoliveiralucas).

*Executar os testes:*

Teste básico: `docker-compose run --rm php-fpm vendor/bin/phpunit`
Teste com pequena documentação: `docker-compose run --rm php-fpm vendor/bin/phpunit --testdox`
Teste com geração de dashboard em html: `docker-compose run --rm php-fpm vendor/bin/phpunit --coverage-html ./test/_reports/test/`