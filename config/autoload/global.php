<?php

// $dbHost = getenv("DB_HOST");

// return [
//     'db' => [
//         'adapters' => [
//             'Application\Db\WriteAdapter' => [
//                 "driver"   => "Pdo",
//                 "dsn"      => "mysql:dbname=album_db;host=localhost",
//                 "username" => "root",
//                 "password" => "",
//             ],
//             'Application\Db\ReadOnlyAdapter' => [
//                 "driver"   => "Pdo",
//                 "dsn"      => "mysql:dbname=album_db;host=localhost",
//                 "username" => "root",
//                 "password" => "",
//             ],
//         ],
//     ],
//     "translator" => [
//         "locale" => "en_US",
//         "translation_file_patterns" => [
//             [
//                 "type"     => "gettext",
//                 "base_dir" => getcwd() .  "/data/language",
//                 "pattern"  => "%s.mo",
//             ],
//         ],
//     ],
// ];



 return [
     "db" => [
         "driver"   => "Pdo",
         "dsn"      => "mysql:dbname=checkout_db;host=localhost",
         "username" => "root",
         "password" => "",
     ],
    //  "translator" => [
    //     "locale" => "en_US",
    //     "translation_file_patterns" => [
    //         [
    //             "type"     => "gettext",
    //             "base_dir" => getcwd() .  "/data/language",
    //             "pattern"  => "%s.mo",
    //         ],
    //     ],
    // ],
 ];
 