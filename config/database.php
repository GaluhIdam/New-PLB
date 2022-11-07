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
            'host' => env('DB_HOST', '10.143.147.245'),
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

        // Database Connection for db_plbGmf (Outbound)
        'db_plbGmf' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_PLBGMF_HOST', '10.143.147.245'),
            'port' => env('DB_PLBGMF_PORT', '3306'),
            'database' => env('DB_PLBGMF_DATABASE', 'db_plbGmf'),
            'username' => env('DB_PLBGMF_USERNAME', 'usr-jti'),
            'password' => env('DB_PLBGMF_PASSWORD', 'P@ssw0rd'),
            'unix_socket' => env('DB_PLBGMF_SOCKET', ''),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_PLB_HOST', '10.143.147.245'),
            'port' => env('DB_PLB_PORT', '3306'),
            'database' => env('DB_PLB_DATABASE', 'plb_db_prod'),
            'username' => env('DB_PLB_USERNAME', 'usr-jti'),
            'password' => env('DB_PLB_PASSWORD', 'P@ssw0rd'),
            'unix_socket' => env('DB_PROD_SOCKET', ''),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_IPLB_HOST', '10.143.147.245'),
            'port' => env('DB_IPLB_PORT', '3306'),
            'database' => env('DB_IPLB_DATABASE', 'iplb_db_prod'),
            'username' => env('DB_IPLB_USERNAME', 'usr-jti'),
            'password' => env('DB_IPLB_PASSWORD', 'P@ssw0rd'),
            'unix_socket' => env('DB_IPLB_SOCKET', ''),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE_PORT', '3306'),
            'database' => env('DB_ARCHIVE_DATABASE', 'plb_db_archive'),
            'username' => env('DB_ARCHIVE_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE_PASSWORD', 'P@ssw0rd'),
            'unix_socket' => env('DB_ARCHIVE_SOCKET', ''),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE1_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE1_PORT', '3306'),
            'database' => env('DB_ARCHIVE1_DATABASE', 'plb_db_archive1'),
            'username' => env('DB_ARCHIVE1_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE1_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive2)
        'plb_db_archive2' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE2_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE2_PORT', '3306'),
            'database' => env('DB_ARCHIVE2_DATABASE', 'plb_db_archive2'),
            'username' => env('DB_ARCHIVE2_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE2_PASSWORD', 'P@ssw0rd'),
            'unix_socket' => env('DB_ARCHIVE2_SOCKET', ''),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE3_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE3_PORT', '3306'),
            'database' => env('DB_ARCHIVE3_DATABASE', 'plb_db_archive3'),
            'username' => env('DB_ARCHIVE3_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE3_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive4)
        'plb_db_archive4' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE4_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE4_PORT', '3306'),
            'database' => env('DB_ARCHIVE4_DATABASE', 'plb_db_archive4'),
            'username' => env('DB_ARCHIVE4_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE4_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive5)
        'plb_db_archive5' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE5_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE5_PORT', '3306'),
            'database' => env('DB_ARCHIVE5_DATABASE', 'plb_db_archive5'),
            'username' => env('DB_ARCHIVE5_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE5_PASSWORD', 'P@ssw0rd'),
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

        // Database Connection for Archive (plb_db_archive6)
        'plb_db_archive6' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE6_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE6_PORT', '3306'),
            'database' => env('DB_ARCHIVE6_DATABASE', 'plb_db_archive6'),
            'username' => env('DB_ARCHIVE6_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE6_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive7)
        'plb_db_archive7' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE7_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE7_PORT', '3306'),
            'database' => env('DB_ARCHIVE7_DATABASE', 'plb_db_archive7'),
            'username' => env('DB_ARCHIVE7_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE7_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive8)
        'plb_db_archive8' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_ARCHIVE8'),
            'host' => env('DB_HOST_ARCHIVE8', '10.143.147.245'),
            'port' => env('DB_PORT_ARCHIVE8', '3306'),
            'database' => env('DB_DATABASE_ARCHIVE8', 'plb_db_archive8'),
            'username' => env('DB_USERNAME_ARCHIVE8', 'usr-jti'),
            'password' => env('DB_PASSWORD_ARCHIVE8', 'P@ssw0rd'),
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
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE9_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE9_PORT', '3306'),
            'database' => env('DB_ARCHIVE9_DATABASE', 'plb_db_archive9'),
            'username' => env('DB_ARCHIVE9_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE9_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive10)
        'plb_db_archive10' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE10_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE10_PORT', '3306'),
            'database' => env('DB_ARCHIVE10_DATABASE', 'plb_db_archive10'),
            'username' => env('DB_ARCHIVE10_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE10_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive11)
        'plb_db_archive11' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE11_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE11_PORT', '3306'),
            'database' => env('DB_ARCHIVE11_DATABASE', 'plb_db_archive11'),
            'username' => env('DB_ARCHIVE11_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE11_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive12)
        'plb_db_archive12' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE12_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE12_PORT', '3306'),
            'database' => env('DB_ARCHIVE12_DATABASE', 'plb_db_archive12'),
            'username' => env('DB_ARCHIVE12_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE12_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive13)
        'plb_db_archive13' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE13_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE13_PORT', '3306'),
            'database' => env('DB_ARCHIVE13_DATABASE', 'plb_db_archive13'),
            'username' => env('DB_ARCHIVE13_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE13_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive14)
        'plb_db_archive14' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE14_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE14_PORT', '3306'),
            'database' => env('DB_ARCHIVE14_DATABASE', 'plb_db_archive14'),
            'username' => env('DB_ARCHIVE14_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE14_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive15)
        'plb_db_archive15' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE15_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE15_PORT', '3306'),
            'database' => env('DB_ARCHIVE15_DATABASE', 'plb_db_archive15'),
            'username' => env('DB_ARCHIVE15_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE15_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive16)
        'plb_db_archive16' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE16_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE16_PORT', '3306'),
            'database' => env('DB_ARCHIVE16_DATABASE', 'plb_db_archive16'),
            'username' => env('DB_ARCHIVE16_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE16_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive17)
        'plb_db_archive17' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE17_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE17_PORT', '3306'),
            'database' => env('DB_ARCHIVE17_DATABASE', 'plb_db_archive17'),
            'username' => env('DB_ARCHIVE17_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE17_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive18)
        'plb_db_archive18' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE18_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE18_PORT', '3306'),
            'database' => env('DB_ARCHIVE18_DATABASE', 'plb_db_archive18'),
            'username' => env('DB_ARCHIVE18_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE18_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive19)
        'plb_db_archive19' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE19_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE19_PORT', '3306'),
            'database' => env('DB_ARCHIVE19_DATABASE', 'plb_db_archive19'),
            'username' => env('DB_ARCHIVE19_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE19_PASSWORD', 'P@ssw0rd'),
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
        // Database Connection for Archive (plb_db_archive20)
        'plb_db_archive20' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_ARCHIVE20_HOST', '10.143.147.245'),
            'port' => env('DB_ARCHIVE20_PORT', '3306'),
            'database' => env('DB_ARCHIVE20_DATABASE', 'plb_db_archive20'),
            'username' => env('DB_ARCHIVE20_USERNAME', 'usr-jti'),
            'password' => env('DB_ARCHIVE20_PASSWORD', 'P@ssw0rd'),
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