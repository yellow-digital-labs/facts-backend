<?php

return [
    'm-foods-category' => [
        'title' => 'M Foods Categories',

        'actions' => [
            'index' => 'M Foods Categories',
            'create' => 'New M Foods Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'food_category_name' => 'Food category name',
            'active' => 'Active',
            
        ],
    ],

    'm-event-category' => [
        'title' => 'M Event Categories',

        'actions' => [
            'index' => 'M Event Categories',
            'create' => 'New M Event Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'event_category_name' => 'Event category name',
            'active' => 'Active',
            
        ],
    ],

    'm-foods-category' => [
        'title' => 'M Foods Categories',

        'actions' => [
            'index' => 'M Foods Categories',
            'create' => 'New M Foods Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'food_category_name' => 'Food category name',
            'active' => 'Active',
            
        ],
    ],

    'event' => [
        'title' => 'Events',

        'actions' => [
            'index' => 'Events',
            'create' => 'New Event',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'user_id' => 'User',
            'event_categories_id' => 'Event categories',
            'event_name' => 'Event name',
            'event_start_datetime' => 'Event start datetime',
            'event_end_datetime' => 'Event end datetime',
            'event_description' => 'Event description',
            'event_primary_image' => 'Event primary image',
            'event_location' => 'Event location',
            'event_contact' => 'Event contact',
            'event_available_tickets' => 'Event available tickets',
            'event_ticket_amount' => 'Event ticket amount',
            'event_ticket_discount_amount' => 'Event ticket discount amount',
            'active' => 'Active',
            
        ],
    ],

    'events-order' => [
        'title' => 'Events Orders',

        'actions' => [
            'index' => 'Events Orders',
            'create' => 'New Events Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];