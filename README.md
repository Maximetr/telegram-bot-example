## Настройка бота

### Первичный запуск
Для работы telegram api необходим ssl сертификат. Используя команду
`make init` генерируем self-signed сертификат для нашего приложения и .env файл. <br />

### Telegram Api
Перед запуском необходимо создать ключи доступа через API development tools следуя шагам из официальной
**[документации](https://core.telegram.org/api/obtaining_api_id#obtaining-api-id)**.
После получения значений api_id и api_hash их необходимо прописать в `.env` файле в параметрах
`TELEGRAM_API_ID` и `TELEGRAM_API_HASH` соответственно.

### Telegram bot token
Создаем нового бота по шагам из **[документации BotFather](https://core.telegram.org/bots#6-botfather)**.
Полученный token и username бота заполняем в `.env` файл в параметры `TELEGRAM_BOT_USERNAME` и `TELEGRAM_BOT_TOKEN` соответственно.

## Запуск приложения
Запускаем приложение командой `make up` и ждем выполнения. <br/>
Заходим через приложения телеграма в нашего `TELEGRAM_BOT_USERNAME`, нажимаем `/start` и отправляем сообщения.
