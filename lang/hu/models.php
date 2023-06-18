<?php

return [
    'wedding' => [
        'action' => [
            'create' => 'Esküvő létrehozása',
            'edit' => ':title esküvő szerkesztése',
            'delete' => 'Esküvő törlése',
        ],
        'column' => [
            'title' => 'Megnevezés',
            'date' => 'Dátum',
            'planned_from' => 'Dátum(-tól)',
            'planned_to' => 'Dátum(-ig)',
        ],
        'overview' => [
            'subheading' => 'A NAGY napig!!! 🥳🎉',
            'planning' => 'Tervezés áttekintése',
            'budget' => 'Pénzügyek áttekintése',
            'ideas' => 'Ötletek áttekintése',
        ],
        'heading' => 'Az esküvő részletei',
        'subheading' => 'Add meg az esküvőd részleteit.',
        'not_sure' => 'Nem vagyok biztos a pontos dátumban.',
    ],
    'todo' => [
        'action' => [
            'create' => 'Teendő hozzáadása',
            'edit' => 'Teendő szerkesztése',
            'delete' => 'Teendő törlése',
        ],
        'column' => [
            'title' => 'Megnevezés',
            'status' => 'Státusz'
        ],
        'status' => [
            "todo" => 'Elvégzendő' ,
            "pending" => 'Függőben' ,
            "failed" => 'Sikertelen' ,
            "done" => 'Kész'
        ],
        'bigtitle' => 'Tervezés',
    ],
    'budget' => [
        'column' => [
            'title' => 'Megnevezés',
            'status' => 'Státusz'
        ],
        'subheader' => 'Lagzira szánt összeg:',
        'subheader2' => 'Maradék összeg:'
    ],
    'item' => [
        'action' => [
            'create' => 'Tétel létrehozása',
            'edit' => 'Tétel szerkesztése',
            'delete' => 'Tétel törlése',
        ],
        'column' => [
            'title' => 'Megnevezés',
            'value' => 'Érték'
        ],
    ],
    'idea' => [
        'heading' => 'Keress ötleteket!',
        'button' => 'Kérem az ötleteket!',
        'favorite' => 'A kedvenc ötleteid',
    ],
    'event' => [
        'action' => [
            'create' => 'Új esemény',
            'edit' => 'Esemény szerkesztése',
            'delete' => 'Esemény törlése',
        ],
        'column' => [
            'title' => 'Megnevezés',
            'starts_at' => 'Kezdés'
        ],
    ]
];