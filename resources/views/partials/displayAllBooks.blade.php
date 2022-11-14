@if (count($books) > 0) 
<div class="row">
    <div class="col">
        <div class="book-list">
            <div class="book-list-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Page Count</th>
                            <th>Release Year</th>
                            <th>Category</th>
                            @if (View::getSection('title')=='Update Book' || View::getSection('title')=='Delete Book')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $k = 1;
                        @endphp
                        @foreach ($books as $book)
                        <tr>
                            <td>{{$k}}</td>
                            <td>{{$book->bookTitle}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->pageCount}}</td>
                            <td>{{$book->releaseYear}}</td>
                            <td>{{$book->category}}</td>
                            @if (View::getSection('title')=='Update Book')
                            <td>
                                <ul class="action-list">
                                    <li><a href="{{route('editBook', $book->id)}}" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                </ul>
                            </td>
                            @elseif (View::getSection('title')=='Delete Book')
                            <td>
                                <ul class="action-list">
                                    <li><a href="{{route('deleteDB', $book->id)}}" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                </ul>
                            </td>
                            @endif
                        </tr>
                        @php
                            $k++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="warning">
    <div class="row py-5 mt-4 align-items-center">
        <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 insert-img">
            <img src="{{URL::asset('/images/insert.png')}}" alt="">
        </div>
        <div class="col-md-6 ml-auto d-flex flex-column justify-content-center align-items-center">
            <h3>We don't have any book currently. Lend a hand to restock the books by inserting books.</h3>
            <div class="d-flex">
                <a href="{{route('createBook')}}" class="cmn-btn">Insert Book</a>
            </div>
        </div>
    </div>
</div>
@endif