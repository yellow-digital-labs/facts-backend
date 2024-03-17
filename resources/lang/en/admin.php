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

    'events-order' => [
        'title' => 'Events Orders',

        'actions' => [
            'index' => 'Events Orders',
            'create' => 'New Events Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'booking_user_id' => 'Booking user',
            'event_user_id' => 'Event user',
            'event_id' => 'Event',
            'no_of_booking' => 'No of booking',
            'booking_unit_amount' => 'Booking unit amount',
            'applicable_tax_amount' => 'Applicable tax amount',
            'booking_total_amount' => 'Booking total amount',
            'points_used' => 'Points used',
            'booking_payable_amount' => 'Booking payable amount',
            'status' => 'Status',
            
        ],
    ],

    'm-user-type' => [
        'title' => 'M User Types',

        'actions' => [
            'index' => 'M User Types',
            'create' => 'New M User Type',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
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

    'm-events-orders-status' => [
        'title' => 'M Events Orders Status',

        'actions' => [
            'index' => 'M Events Orders Status',
            'create' => 'New M Events Orders Status',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'events_orders_status_name' => 'Events orders status name',
            'active' => 'Active',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];