# Тестовое задание для компании ЕВРОПРЕСТИЖ

У меня при выполнение появилось несколько условностей:

- Дамп базы не прикладываю, потому что все сидерами заполняется
- **Тест всего 1... Написание тестов зависит от стандартов компании. Но в моем понимании coverage 100 - это странно, и
  нужно тестировать сложный функционал/бизнес-логику, а в этом приложении по большей части базовые операции**
- ТЗ в некоторых местах неоднозначное. Я старался реализации делать как можно ближе к описанию из текста

# Установка

```sh
git clone https://github.com/ZinoviL/test-task-europrestige.git
cd test-task-europrestige
cp .env.example .env
cp src/.env.example src/.env
docker-compose run app composer install
docker-compose up -d
docker-compose exec app chown -R www-data: storage
docker-compose exec app php artisan migrate:fresh --seed
```

# Затраченное время

- 1ч docker и базовая установка
- 5ч выполнение задачи
- 1ч написание README

# Использование

Запуск тестов:

```sh
docker-compose exec app php artisan test
```

Получение токена:

```sh
curl \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -X POST \
    127.0.0.1:8080/api/login \
    -d '{"email": "admin@admin.admin", "password": "admin"}'
```

## Все методы

Список категорий:

```sh
curl \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    127.0.0.1:8080/api/categories
```

Товары в категории:

```sh
curl \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    127.0.0.1:8080/api/categories/<ID>/products
```

Создание категории:

```sh
curl \
    -X POST \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/categories \
    -d '{"name": "name", "parameters": [1,2]}'
```

Редактирование категории:

```sh
curl \
    -X PUT \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/categories/<ID> \
    -d '{"name": "name", "parameters": [1,2]}'
```

Удаление категории:

```sh
curl \
    -X DELETE \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/categories/<ID>
```

Создание параметра:

```sh
curl \
    -X POST \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    127.0.0.1:8080/api/parameters \
    -d '{"name": "name"}'
```

Редактирование параметра:

```sh
curl \
    -X PUT \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    127.0.0.1:8080/api/parameters/<ID> \
    -d '{"name": "name"}'
```

Удаление параметра:

```sh
curl \
    -X DELETE \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    127.0.0.1:8080/api/parameters/<ID>
```

Создание товара:

```sh
curl \
    -X POST \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/products \
    -d '{"name": "name", "categories": [1,2], "parameter_values": [{"parameter_id": 1, "value": "red"}]}'
```

Редактирование товара:

```sh
curl \
    -X PUT \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/products/<ID> \
    -d '{"name": "name", "categories": [1,2], "parameter_values": [{"parameter_id": 1, "value": "red"}]}'
```

Удаление категории:

```sh
curl \
    -X DELETE \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>" \
    127.0.0.1:8080/api/products/<ID>
```