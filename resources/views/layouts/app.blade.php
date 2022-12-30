<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    {{-- NAVBAR --}}
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

    {{-- CONTENT --}}
    @yield('content')

    {{-- TOASTS --}}
    @if (session('success_message') || session('error_message'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header {{ session('success_message') ? 'bg-success' : 'bg-danger' }} text-white">
                <strong class="me-auto">Storient</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success_message') ? session('success_message') : session('error_message') }}
            </div>
            </div>
        </div>

        <script>
                const toastLiveExample = document.getElementById('liveToast')
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
        </script>
    @endif

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="formDelete" method="POST" action="">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL BORROW --}}
    <div class="modal fade" id="confirmBorrowModal" tabindex="-1" aria-labelledby="confirmBorrowModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmBorrowModalLabel">Borrow Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Please read before borrowing.</h3>
                    <p>
                        There are a few things you should know before borrowing our book.
                        <ol>
                            <li style="list-style: decimal">You can only borrow 1 book at a time and you can borrow the book for 1 week.</li>
                            <li style="list-style: decimal">You are only allowed to borrow another book 1 week after returning the book safely to us.</li>
                            <li style="list-style: decimal">The book you borrow will be sent to your home address. <a href="">Click here to update home address.</a></li>
                            <li style="list-style: decimal">If you fail to return the book before the deadline, you will be charged Rp5.000,00 each day.</li>
                            <li style="list-style: decimal">2 weeks of late return will result in permanent account ban and our officer will visit your address to demand for our book.</li>
                        </ol>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="formBorrow" method="POST" action="">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-danger btn-sm">Borrow</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    {{-- SCRIPTS --}}
    <script>
        document.getElementById('confirmDeleteModal').addEventListener('show.bs.modal', (e) => {
            document.getElementById('formDelete').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
        })

        document.getElementById('confirmReturnModal').addEventListener('show.bs.modal', (e) => {
            document.getElementById('formReturn').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
        })

        document.getElementById('confirmReturnWithFineModal').addEventListener('show.bs.modal', (e) => {
            document.getElementById('fine').innerHTML = e.relatedTarget.getAttribute('data-fine')
            document.getElementById('formReturnFine').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
        })

        document.getElementById('confirmBorrowModal').addEventListener('show.bs.modal', (e) => {
            document.getElementById('formBorrow').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
        })
    </script>
</body>

</html>
