<?php

return [
    "menus" => [
        [
            "title" => "Dashboard",
            "url" => "dashboard",
            "icon" => "ti ti-home",
            "permission" => "",
        ],
        [
            "title" => "Master Data",
            "url" => "master-data/*",
            "icon" => "ti ti-book",
            "permission" => ["users.web.index"],
            "sub" => [
                [
                    "title" => "Pengguna",
                    "url" => "master-data/pengguna",
                    "icon" => "ti ti-user",
                    "permission" => "users.web.index",
                ]
            ]
        ],
        [
            "title" => "Setelan",
            "url" => "setelan/*",
            "icon" => "ti ti-settings",
            "permission" => ["roles.web.index"],
            "sub" => [
                [
                    "title" => "Peran & Hak Akses",
                    "url" => "setelan/peran-hak-akses",
                    "icon" => "ti ti-lock",
                    "permission" => "roles.web.index",
                ]
            ]
        ]
    ]
];
