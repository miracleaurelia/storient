@include('partials.header', 
    ['navItems' => 
        [
            [
                'item' => 'Home',
                'title' => 'Home Page',
                'navLink' => ''
            ], 
            [
                'item' => 'Display',
                'title' => 'Display Book',
                'navLink' => 'display/book'
            ], 
            [
                'item' => 'Insert',
                'title' => 'Insert Book',
                'navLink' => 'create/book'
            ],
            [
                'item' => 'Update',
                'title' => 'Update Book',
                'navLink' => 'updateView/book'
            ],
            [
                'item' => 'Delete',
                'title' => 'Delete Book',
                'navLink' => 'delete/book'
            ]
        ]
    ]
)

@yield('content')

@include('partials.footer')