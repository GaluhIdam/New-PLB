<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        // Default Database Connection
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for PLB Production (plb_db_prod)
        'plb_db_prod' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_PROD'),
            'host' => env('DB_HOST_PROD', '192.168.40.80'),
            'port' => env('DB_PORT_PROD', '3306'),
            'database' => env('DB_DATABASE_PROD', 'plb_db_prod'),
            'username' => env('DB_USERNAME_PROD', 'usr-jti'),
            'password' => env('DB_PASSWORD_PROD', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_PROD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for IPLB (iplb_db_prod)
        'iplb_db_prod' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_IPLB'),
            'host' => env('DB_HOST_IPLB', '192.168.40.80'),
            'port' => env('DB_PORT_IPLB', '3306'),
            'database' => env('DB_DATABASE_IPLB', 'iplb_db_prod'),
            'username' => env('DB_USERNAME_IPLB', 'usr-jti'),
            'password' => env('DB_PASSWORD_IPLB', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_IPLB', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive)
        'plb_db_archive' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE'),
            'host' => env('DB_HOST_ARCHIVE', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE', 'plb_db_archive'),
            'username' => env('DB_USERNAME_ARCHIVE', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive1)
        'plb_db_archive1' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE1'),
            'host' => env('DB_HOST_ARCHIVE1', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE1', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE1', 'plb_db_archive1'),
            'username' => env('DB_USERNAME_ARCHIVE1', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE1', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE1', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive2)
        'plb_db_archive2' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE2'),
            'host' => env('DB_HOST_ARCHIVE2', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE2', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE2', 'plb_db_archive2'),
            'username' => env('DB_USERNAME_ARCHIVE2', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE2', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE2', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive3)
        'plb_db_archive3' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE3'),
            'host' => env('DB_HOST_ARCHIVE3', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE3', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE3', 'plb_db_archive3'),
            'username' => env('DB_USERNAME_ARCHIVE3', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE3', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE3', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive4)
        'plb_db_archive4' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE4'),
            'host' => env('DB_HOST_ARCHIVE4', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE4', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE4', 'plb_db_archive4'),
            'username' => env('DB_USERNAME_ARCHIVE4', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE4', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE4', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive5)
        'plb_db_archive5' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE5'),
            'host' => env('DB_HOST_ARCHIVE5', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE5', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE5', 'plb_db_archive5'),
            'username' => env('DB_USERNAME_ARCHIVE5', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE5', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE5', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        // Database Connection for Archive (plb_db_archive6)
        'plb_db_archive6' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE6'),
            'host' => env('DB_HOST_ARCHIVE6', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE6', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE6', 'plb_db_archive6'),
            'username' => env('DB_USERNAME_ARCHIVE6', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE6', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE6', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive7)
        'plb_db_archive7' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE7'),
            'host' => env('DB_HOST_ARCHIVE7', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE7', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE7', 'plb_db_archive7'),
            'username' => env('DB_USERNAME_ARCHIVE7', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE7', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE7', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive8)
        'plb_db_archive8' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE8'),
            'host' => env('DB_HOST_ARCHIVE8', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE8', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE8', 'plb_db_archive8'),
            'username' => env('DB_USERNAME_ARCHIVE8', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE8', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE8', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive9)
        'plb_db_archive9' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE9'),
            'host' => env('DB_HOST_ARCHIVE9', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE9', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE9', 'plb_db_archive9'),
            'username' => env('DB_USERNAME_ARCHIVE9', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE9', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE9', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive10)
        'plb_db_archive10' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE10'),
            'host' => env('DB_HOST_ARCHIVE10', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE10', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE10', 'plb_db_archive10'),
            'username' => env('DB_USERNAME_ARCHIVE10', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE10', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE10', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        // Database Connection for Archive (plb_db_archive11)
        'plb_db_archive11' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE11'),
            'host' => env('DB_HOST_ARCHIVE11', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE11', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE11', 'plb_db_archive11'),
            'username' => env('DB_USERNAME_ARCHIVE11', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE11', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE11', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive12)
        'plb_db_archive12' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE12'),
            'host' => env('DB_HOST_ARCHIVE12', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE12', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE12', 'plb_db_archive12'),
            'username' => env('DB_USERNAME_ARCHIVE12', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE12', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE12', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive13)
        'plb_db_archive13' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE13'),
            'host' => env('DB_HOST_ARCHIVE13', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE13', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE13', 'plb_db_archive13'),
            'username' => env('DB_USERNAME_ARCHIVE13', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE13', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE13', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive14)
        'plb_db_archive14' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE14'),
            'host' => env('DB_HOST_ARCHIVE14', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE14', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE14', 'plb_db_archive14'),
            'username' => env('DB_USERNAME_ARCHIVE14', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE14', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE14', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive15)
        'plb_db_archive15' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE15'),
            'host' => env('DB_HOST_ARCHIVE15', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE15', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE15', 'plb_db_archive15'),
            'username' => env('DB_USERNAME_ARCHIVE15', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE15', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE15', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive16)
        'plb_db_archive16' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE16'),
            'host' => env('DB_HOST_ARCHIVE16', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE16', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE16', 'plb_db_archive16'),
            'username' => env('DB_USERNAME_ARCHIVE16', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE16', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE16', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive17)
        'plb_db_archive17' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE17'),
            'host' => env('DB_HOST_ARCHIVE17', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE17', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE17', 'plb_db_archive17'),
            'username' => env('DB_USERNAME_ARCHIVE17', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE17', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE17', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive18)
        'plb_db_archive18' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE18'),
            'host' => env('DB_HOST_ARCHIVE18', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE18', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE18', 'plb_db_archive18'),
            'username' => env('DB_USERNAME_ARCHIVE18', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE18', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE18', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive19)
        'plb_db_archive19' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE19'),
            'host' => env('DB_HOST_ARCHIVE19', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE19', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE19', 'plb_db_archive19'),
            'username' => env('DB_USERNAME_ARCHIVE19', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE19', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE19', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        // Database Connection for Archive (plb_db_archive20)
        'plb_db_archive20' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE20'),
            'host' => env('DB_HOST_ARCHIVE20', '192.168.40.80'),
            'port' => env('DB_PORT_ARCHIVE20', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE20', 'plb_db_archive20'),
            'username' => env('DB_USERNAME_ARCHIVE20', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE20', 'aeroasia'),
            'unix_socket' => env('DB_SOCKET_ARCHIVE20', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];