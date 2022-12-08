@if (count($books) > 0)
    <div class="row">
        <div class="col">
            <div><a href="/create/book" class="btn btnBookLink">Create Book</a>
                <a href="/display/book" class="btn btnBookLink  @if (View::getSection('title') == 'Display Book') active @endif">View
                    Book</a>
                <a href="/updateView/book" class="btn btnBookLink  @if (View::getSection('title') == 'Update Book') active @endif">Update
                    Book</a>

                <a href="/delete/book" class="btn btnBookLink @if (View::getSection('title') == 'Delete Book') active @endif">Delete
                    Book</a>
            </div>

            <div class="book-list">
                <div class="book-list-body table-responsive">
                    <div class="d-flex flex-wrap">
                        @php
                            $k = 1;
                        @endphp
                        @foreach ($books as $book)
                            <div class="card mx-2 mb-3" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body ">
                                    <h5 class="card-title">{{ $book->bookTitle }}</h5>
                                    <p class="card-text text-dark">Author: {{ $book->author }}</p>
                                    <p class="card-text text-dark">Page Count: {{ $book->pageCount }}</p>
                                    <p class="card-text text-dark">Release Date: {{ $book->releaseYear }}</p>
                                    <p class="card-text text-dark">Category: {{ $book->category }}</p>
                                    <div class="d-flex w-100 justify-content-end">
                                        @if (View::getSection('title') == 'Update Book')
                                            <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning"
                                                data-tip="edit"><i class="fa fa-edit"></i></a>
                                        @elseif (View::getSection('title') == 'Delete Book')
                                            <a href="{{ route('deleteDB', $book->id) }}" class="btn btn-danger"
                                                data-tip="delete"><i class="fa fa-trash"></i></a>
                                        @elseif (View::getSection('title') == 'Display Book')
                                            <a href="/display/book/{{ $book->id }}"
                                                class="btn btn-primary customViewLink">View
                                                Book</a>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            @php
                                $k++;
                            @endphp
                        @endforeach
                    </div>
                    {{-- <table class="table">

                        <tbody>
                            @php
                                $k = 1;
                            @endphp
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $k }}</td>
                                    <td>{{ $book->bookTitle }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->pageCount }}</td>
                                    <td>{{ $book->releaseYear }}</td>
                                    <td>{{ $book->category }}</td>
                                    @if (View::getSection('title') == 'Update Book')
                                        <td>
                                            <ul class="action-list">
                                                <li><a href="{{ route('editBook', $book->id) }}" data-tip="edit"><i
                                                            class="fa fa-edit"></i></a></li>
                                            </ul>
                                        </td>
                                    @elseif (View::getSection('title') == 'Delete Book')
                                        <td>
                                            <ul class="action-list">
                                                <li><a href="{{ route('deleteDB', $book->id) }}" data-tip="delete"><i
                                                            class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    @elseif (View::getSection('title') == 'Display Book')
                                        <td>
                                            <a href="/display/book/{{ $book->id }}" class="customViewLink">View
                                                Book</a>
                                        </td>
                                    @endif
                                </tr>
                                @php
                                    $k++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table> --}}
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
                <h3>We don't have any book currently. Lend a hand to restock the books by inserting books.</h3>
                <div class="d-flex">
                    <a href="{{ route('createBook') }}" class="cmn-btn">Insert Book</a>
                </div>
            </div>
        </div>
    </div>
@endif
