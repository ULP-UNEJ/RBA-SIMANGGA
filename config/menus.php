<?php

return [
    "menu" => [
        [
            "title" => "Dashboard",
            "url" => "admin/dashboard",
            "icon" => "ti ti-home",
            "permission" => "",
        ],
        [
            "title" => "Setelan",
            "icon" => "ti ti-settings",
            "permission" => ["roles.web.index"],
            "sub" => [
                [
                    "title" => "Peran & Hak Akses",
                    "url" => "admin/peran",
                    "icon" => "ti ti-lock",
                ]
            ]
        ]
    ]
];
