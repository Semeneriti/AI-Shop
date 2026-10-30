# ПАСПОРТ ПРОЕКТА: AI-Shop

## СТЕК
- Laravel 13.13.0, PHP 8.4.26
- БД: PostgreSQL 15 (Docker)
- Ключевые пакеты: predis/predis, spatie/laravel-data, 
  vladimir-yuldashev/laravel-queue-rabbitmq, 
  elasticsearch/elasticsearch, laravel/sanctum
- Очереди: RabbitMQ 4
- Кэш: Redis 7
- Поиск: Elasticsearch 8.15
- Тесты: PHPUnit 11.5
- Docker: nginx, php-fpm, database, pgadmin, rabbitmq, redis, elasticsearch

## АРХИТЕКТУРА
- Слои: Route → Controller → FormRequest → DTO → Service → Model → View
- DTO: есть, лежат в app/DTO/ (RegisterDto, ProductDto, 
  ProductFilterDto, UpdateProfileDto, CartDto, RoleDto)
- Services: есть, лежат в app/Services/ (RegistrationService, 
  ProductService, OrderService, AdminOrderService, 
  SessionCartService, UserService, RoleService, 
  SalesReportService, ElasticsearchService, UserNotificationService)
- Actions: app/Actions/Fortify/ (устаревшие, не используются)
- Формат API: JSON через response()->json() (нет Resources)
- Транзакции: DB::transaction() в OrderService, AdminOrderService
- События: Model::booted() для Elasticsearch, Job для email

## КОНВЕНЦИИ
- Стиль: PSR-12, strict_types: да (declare(strict_types=1) везде)
- Именование: таблицы snake_case, мн.число (products, cart_items, 
  order_payments, daily_sales_reports)
- Роуты: kebab-case (/change-password, /products/{product})
- Модели: PascalCase единственное число (Product, CartItem, OrderPayment)
- Методы: camelCase (getProducts, createOrder, markAsPaid)
- Локализация: русский (сообщения валидации, шаблоны Blade)
- Комментарии: PHPDoc на русском для сложных методов

## ЗАПРЕТЫ
- Не менять существующие миграции — только новые
- Не добавлять новые пакеты без согласования
- Не удалять/переименовывать: AuthController, ProductService, 
  OrderService, SessionCartService, ElasticsearchService
- Не подключать Breeze/Fortify (используется собственная аутентификация)
- Не менять .env (только дополнять новыми переменными)
- Не трогать docker-compose.yml без согласования
- Не менять архитектуру Controller → Service → DTO

## ФОРМАТ ОТВЕТА
- Сначала краткий план (2-3 пункта)
- Только изменённые методы, не весь файл
- Если не уверен в существовании метода — прямо сказать об этом
- При добавлении кода — указывать полный путь файла
- Не использовать устаревший синтаксис Laravel 10 (Kernel.php, 
  $fillable как свойство) — проект на Laravel 13
- Для проверки — команды docker compose exec -T php-fpm php artisan ...
