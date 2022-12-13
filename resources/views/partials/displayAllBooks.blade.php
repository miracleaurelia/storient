@if (count($books) > 0)
    <div class="row">
        <div class="col">

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

            <div class="container">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                            <div class="card item-card">
                                <div class="item-cover d-flex justify-content-center">
                                    <img src="/images/{{ $book->image }}" class="card-img-top" alt="book cover">
                                </div>
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <h5 class="card-title">{{ $book->bookTitle }}</h5>
                                    <p class="card-text text-black">by <br> {{ $book->author }}</p>
                                    @if (Auth::user()->isAdmin == 1)
                                        @if (View::getSection('title') == 'Update Book')
                                            <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning"
                                                data-tip="edit"><i class="fa fa-edit"></i> Edit</a>
                                        @elseif (View::getSection('title') == 'Delete Book')
                                            <a href="#" data-uri="{{ route('deleteDB', $book->id) }}"
                                            class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal"><i class="fa fa-trash"></i> Delete</a>
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="warning">
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 insert-img">
                <img src="{{ URL::asset('/images/insert.png') }}" alt="">
            </div>
            <div class="col-md-6 ml-auto d-flex flex-column justify-content-center align-items-center">
                @if (Auth::user()->isAdmin == 1)
                    <h3>We don't have any book currently. Lend a hand to restock the books by inserting books.</h3>
                    <div class="d-flex">
                        <a href="{{ route('createBook') }}" class="cmn-btn">Insert Book</a>
                    </div>
                @else
                    <h3>We don't have any book currently. Please wait for us to restock.</h3>
                    <div class="d-flex">
                        <a href="/" class="cmn-btn">Go To Home</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
