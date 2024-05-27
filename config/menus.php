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
            "title" => "Setelan",
            "url" => "setelan/*",
            "icon" => "ti ti-settings",
            "permission" => ["roles.web.index"],
            "sub" => [
                [
                    "title" => "Peran & Hak Akses",
                    "url" => "setelan/peran",
                    "icon" => "ti ti-lock",
                    "permission" => "roles.web.index",
                ]
            ]
        ]
    ]
];
