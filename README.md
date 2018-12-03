Job-manager
======================

Структура проекта
-------------------

```
bootstrap                   содержит заполнение DI Container
common
    dispatchers/            содержит обработчик событий
    dto/                    содержит Data Transfer Object классы
    entities/               содержит классы объектов используемых в приложении
    exceptions/             содержит исключения генерируемые приложением
    migrations              содержит миграции базы данных
    repositories/           содержит репозитории по работе с БД
    services/               содержит сервисы, используемые контроллерами
config/                     содержит настройки приложения
console/                    содержит контроллеры консольных комманд
environments/               содержит файлы для начальной инициализации приложения
modules
    api/                    модуль содержит end-point'ы HTTP API
tests/                      набор юнит и интеграционных тестов
web/                        содержит публичные файлы приложения
```

Консольные команды
-------------------

Первоначальная инициализация приложения
```
php yii environment/init [environment] [overwrite]
    environment             не обязательное поле с значением "dev" по умолчанию
    overwrite               не обязательное поле с значением "y" по умолчанию

Генерирование случайных вакансий в количестве от 10 до 100
php yii vacancy/generate
```

Инструкция по разворачиванию
-------------------

```
1. Выполнить команду php yii environment/init
2. Заполнить файл config/serv.env данными о БД
3. Выполнить команду php yii migrate
```

Доступные API
-------------------

```
/api/vacancy/index          получить список всех вакансий в формате JSON
```