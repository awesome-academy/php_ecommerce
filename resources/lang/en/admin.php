<?php

return [
    'text' => [
        'heading' => 'Hello Admin',
        'subheading' => 'This is your admin page. You can control anything!',
        'table_user' => 'Data Table User',
        'table_order' => 'Data Table Order',
        'table_product' => 'Data Table Product',
        'table_request' => 'Data Table Request product',
    ],
    'breadcrumb' => [
        'dashboard' => 'Dashboard',
        'overview' => 'Overview',
        'table_user' => 'Table User',
        'table_order' => 'Table Order',
        'table_product' => 'Table Product',
    ],
    'table' => [
        'user' => [
            'full_name' => 'Fullname',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'email' => 'Email',
            'phone' => 'Phone'
        ],
        'order' => [
            'user_name' => 'User name',
            'payment_type' => 'Payment Type',
            'total_price' => 'Total Price',
            'detail_qty' => 'Quantity',
            'detail_price' => 'Price',
            'detail_name' => 'Product name',
            'detail_image' => 'Image',
        ],
        'product' => [
            'name' => 'Name',
            'description' => 'Description',
            'stock_quantity' => 'Stock quantity',
            'price' => 'Price',
            'image' => 'Image',
            'category' => 'Category',
        ],
        'id' => 'ID',
        'created_at' => 'Created at',
        'status' => 'Status',
        'action' => 'Action',
    ],
    'card' => [
        'messages' => ':num New Messages!',
        'users' => ':num New Users!',
        'orders' => ':num New Orders!',
        'requests' => ':num New Requests!',
        'detail' => 'View Details',
    ],
    'sidebar' => [
        'dashboard' => 'Dashboard',
        'tables' => 'Tables',
        'users' => 'Users',
        'products' => 'Products',
        'orders' => 'Orders',
        'categories' => 'Categories',
        'charts' => 'Charts'
    ],
    'option' => [
        'status' => [
            '0' => 'Pending',
            '1' => 'Accepted',
            '-1' => 'Rejected',
        ],
    ],
    'message' => [
        'order' => [
            'delete' => [
                'success' => 'This order was deleted.',
            ],
        ],
        'product' => [
            'create' => [
                'success' => 'This product has been created.'
            ],
            'update' => [
                'success' => 'Your product was updated successfully',
            ],
            'delete' => [
                'success' => 'This product was deleted.',
            ],
            'find' => [
                'fail' => 'Cannot find this product',
            ],
        ],
    ],
    'chart' => [
        'order' => [
            'title' => [
                'detail_month' => 'Orders by Month',
                'detail_year' => 'Orders by Year',
                'revenue' => 'Revenue this year',
            ],
            'label' => [
                'total' => 'Total Orders',
            ],
        ],
    ],
];
