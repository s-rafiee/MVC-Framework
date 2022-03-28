<?php
$SETTINGS = [
    'PUBLIC_DIR' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__) . '/public')),
    'ROOT' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__))),

    /*
     * DataBase Setting
     */
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'mvc',
    'DB_USER' => 'root',
    'DB_PASSWORD' => '',
    'DB_CHARSET' => 'utf8',

    /*
     * Default Language
     */
    'LAN' => 'fa',

    /*
     * Application Name
     */
    'APP_NAME' => 'MVC',
];