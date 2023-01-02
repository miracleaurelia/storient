@guest
@else
    @if (Auth::user()->isAdmin == 1)
        <div><a href="/create/book" class="btn btnBookLink">Create Book</a>
            <a href="/display/book" class="btn btnBookLink  @if (View::getSection('title') == 'Display Book') active @endif">View
                Book</a>
            <a href="/updateView/book" class="btn btnBookLink  @if (View::getSection('title') == 'Update Book') active @endif">Update
                Book</a>

            <a href="/delete/book" class="btn btnBookLink @if (View::getSection('title') == 'Delete Book') active @endif">Delete
                Book</a>
        </div>
    @endif
@endguest

@if ($books->count() > 0)
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a
                            @if (View::getSection('title') == 'Display Book') href="/display/book"
                                    @elseif (View::getSection('title') == 'Update Book') href="/updateView/book"
                                    @elseif (View::getSection('title') == 'Delete Book') href="/delete/book" @endif>
                            All
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a
                                @if (View::getSection('title') == 'Display Book') href="/display/category/{{ $category->id }}"
                                        @elseif (View::getSection('title') == 'Update Book') href="/updateView/book/{{ $category->id }}"
                                        @elseif (View::getSection('title') == 'Delete Book') href="/delete/book/{{ $category->id }}" @endif>
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-lg-4 col-md-6 my-2">
                            <div class="card item-card">
                                <div class="item-cover d-flex justify-content-center">
                                    <img src="/images/{{ $book->image }}" class="card-img-top" alt="book cover">
                                </div>
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <h5 class="card-title">{{ $book->bookTitle }}</h5>
                                    <p class="card-text text-black">by <br> {{ $book->author }}</p>
                                    @guest
                                        <a href="/display/book/{{ $book->id }}"
                                            class="btn btn-primary customViewLink">View Details</a>
                                    @else
                                        @if (Auth::user()->isAdmin == 1)
                                            @if (View::getSection('title') == 'Update Book')
                                                <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning"
                                                    data-tip="edit"><i class="fa fa-edit"></i> Edit</a>
                                            @elseif (View::getSection('title') == 'Delete Book')
                                                <a href="#" data-uri="{{ route('deleteDB', $book->id) }}"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal"><i class="fa fa-trash"></i>
                                                    Delete</a>
                                                {{-- <a href="{{ route('deleteDB', $book->id) }}" class="btn btn-danger"
                                                            data-tip="delete"><i class="fa fa-trash"></i></a> --}}
                                            @elseif (View::getSection('title') == 'Display Book')
                                                <a href="/display/book/{{ $book->id }}"
                                                    class="btn btn-primary customViewLink">View
                                                    Book</a>
                                            @endif
                                        @else
                                            <a href="/display/book/{{ $book->id }}"
                                                class="btn btn-primary customViewLink">View Details</a>
                                        @endif
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($books->hasPages())
                        <div class="pagination-wrapper mt-3">
                            {{ $books->links() }}
                        </div>
                        <div class="mb-3">
                            Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row py-5 mt-4">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a
                            @if (View::getSection('title') == 'Display Book') href="/display/book"
                            @elseif (View::getSection('title') == 'Update Book') href="/updateView/book"
                            @elseif (View::getSection('title') == 'Delete Book') href="/delete/book" @endif>
                            All
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a
                                @if (View::getSection('title') == 'Display Book') href="/display/category/{{ $category->id }}"
                                @elseif (View::getSection('title') == 'Update Book') href="/updateView/book/{{ $category->id }}"
                                @elseif (View::getSection('title') == 'Delete Book') href="/delete/book/{{ $category->id }}" @endif>
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9 d-flex flex-column justify-content-center align-items-center">
                @guest
                    <h3>No books found</h3>
                    <div class="d-flex">
                        <a href="/" class="cmn-btn">Go To Home</a>
                    </div>
                @else
                    @if (Auth::user()->isAdmin == 1)
                        <h3>No books found</h3>
                        <div class="d-flex">
                            <a href="{{ route('createBook') }}" class="cmn-btn">Insert Book</a>
                        </div>
                    @else
                        <h3>No books found</h3>
                        <div class="d-flex">
                            <a href="/" class="cmn-btn">Go To Home</a>
                        </div>
                    @endif
                @endguest
            </div>
        </div>
    </div>
@endif
