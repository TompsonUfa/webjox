1) composer install
2) npm i
3) php artisan migrate
4) php artisan db:seed (будут созд. две учетки, логин/пароль:  admin@webjox.ru admin ; moder@webjox.ru moder)
5) php artisan storage:link
6) npm run dev или npm run build
7) Вход в админку http://localhost/login

Если вы развернули ваш проект на сервере, отличном от localhost, вам может понадобиться настроить config/sanctum.php,
чтобы Sanctum мог корректно обрабатывать запросы с другого домена.

Откройте файл config/sanctum.php в вашем проекте. В разделе stateful, найдите параметр stateful_domain,
и укажите в качестве его значения домен, с которого был запущен ваш проект.
Это позволит Sanctum обрабатывать кросс-доменные запросы корректно.
