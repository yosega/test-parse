# Парсер поисковых тегов Wildberries (тестовое задание)

---

## Установка

1. установка зависимостей
```
composer install
```
2. Запуск миграции
Для миграций используется phinx. Для запуска миграции используйте команду
```
vendor/bin/phinx migrate -e development 
```
Перед запуском миграции необходимо сконфигурировать подключение к базе данных в файле **./phinx.php**

## Конфигурация

Укажите ваши данные для подключения к базе данных в файле:
```
./config.php
```

## Запуск

После установки зависимостей и успешного запуска миграции приложение будет доступно по URL-адресу **./index.php**.
Чтобы спарсить поисковые теги со страницы товара Wildberries достаточно указать ссылку в соответствующее поле и нажать "**Парсить поисковые теги**":
![image](https://user-images.githubusercontent.com/86099348/146043939-d60d3049-3149-4af8-b6e6-e731a37b686b.png)

После успешного парсинга теги будут добавлены в базу данных, а так же выведены на экран с виде списка:
![image](https://user-images.githubusercontent.com/86099348/146044148-e1db4572-449b-4735-9cd6-c37f80add60b.png)


