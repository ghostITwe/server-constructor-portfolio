
# Server-constructor-portfolio

Репозиторий серверной части дипломного проекта – сервиса конструктора портфолио для IT-специалистов.


## Локальный запуск

Склонировать репозиторий

```bash
  git clone https://github.com/ghostITwe/server-constructor-portfolio.git
```

Перейти в директорию проекта

```bash
  cd server-constructor-portfolio
```

Установить необходимые зависимости

```bash
  composer i
```

Выполнить команду sail up

```bash
  ./vendor/bin/sail up
```

После запуска sail up, сгенерировать `APP_KEY` для дальнейшей работы

```bash
  sail artisan key:generate
```


## Переменные среды

Чтобы корректно запустился проект, необходимо изменить `.env.example` на `.env`, после чего ввести нужные значения

`DB_USERNAME`

`DB_PASSWORD`



## Проверка API-endpoints

### Регистрация

```http
  POST your_host/api/registration
```

| Параметр | Тип     | Описание                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Обязательное**, **Уникальное**, **Почта**|
| `password` | `string` | **Обязательное**, **Минимально 6 символов** |
| `password_confirmation` | `string` | **Обязательное** |

#### Успешный ответ

```response
  {
    'status': true,
    'token': 1|i0VTSlnBDDOvnxCpkKBXvtAOP39MMZGsZdfmah3m -- example
  }
```

### Авторизация

```http
  POST your_host/api/auth
```

| Параметр | Тип     | Описание                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Обязательное**, **Почта**|
| `password` | `string` | **Обязательное**, **Минимально 6 символов** |

#### Успешный ответ

```response
  {
    'status': true,
    'token': 1|i0VTSlnBDDOvnxCpkKBXvtAOP39MMZGsZdfmah3m -- example
  }
```


