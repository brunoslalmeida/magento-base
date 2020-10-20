<?php
return array(
    'session' => array(
        'save' => 'redis',
        'redis' => array(
            'host' => 'REDIS_HOST',
            'port' => '6379',
            'password' => 'REDIS_PASSWORD',
            'timeout' => '2.5',
            'persistent_identifier' => '',
            'database' => 'REDIS_DATABASE_SESSION',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => '6',
            'break_after_frontend' => '5',
            'break_after_adminhtml' => '30',
            'first_lifetime' => '600',
            'bot_first_lifetime' => '60',
            'bot_lifetime' => '7200',
            'disable_locking' => '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000'
        )
    ) ,
    'cache' => array(
        'frontend' => array(
            'default' => array(
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => array(
                    'server' => 'REDIS_HOST',
                    'port' => '6379',
                    'persistent' => '',
                    'database' => 'REDIS_DATABASE_DEFAULT',
                    'password' => 'REDIS_PASSWORD',
                    'force_standalone' => '0',
                    'connect_retries' => '1',
                    'read_timeout' => '10',
                    'automatic_cleaning_factor' => '0',
                    'compress_data' => '1',
                    'compress_tags' => '1',
                    'compress_threshold' => '20480',
                    'compression_lib' => 'gzip',
                    'use_lua' => '0',
                ) ,
            ) ,
            'page_cache' => array(
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => array(
                    'server' => 'REDIS_HOST',
                    'port' => '6379',
                    'persistent' => '',
                    'database' => 'REDIS_DATABASE_PAGE_CACHE',
                    'password' => 'REDIS_PASSWORD',
                    'force_standalone' => '0',
                    'connect_retries' => '1',
                    'lifetimelimit' => '57600',
                    'compress_data' => '0',
                ) ,
            ) ,
        ) ,
    ) ,
);

