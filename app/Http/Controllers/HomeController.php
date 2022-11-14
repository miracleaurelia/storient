<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carouselImg = ['1.jpg', '2.jpg', '3.jpg'];
        $services = [
            [
                'serviceName' => 'Book Lender',
                'description' => 'You can borrow books from us and return it within the deadline that we have given. Upon returning, we will inspect the book to see if there are any damages. If we find any damage, you will be charged 5 USD for any book.'
            ],
            [
                'serviceName' => 'Book Seller',
                'description' => 'We sell some of the books in this library. Not every book in the library is available to buy. To buy books, just ask our admin for the availability of the book and specify whether you want the hardcover or softcover version of the book.'
            ],
            [
                'serviceName' => 'Book Searcher',
                'description' => 'If you need rare book you cannot find anywhere, just contact us and we will look it up for you to buy it from us. Please note that this feature is available for members of PM Library only. To become a member, please contact our admin for registration.'
            ]
        ];
        $awardsDetail = [
            [
                'name' => 'Best Library',
                'desc' => 'We received the best library in Jakarta award for our top-notch customer service.',
                'img' => 'cs.png'
            ],
            [
                'name' => 'Most Comfortable',
                'desc' => 'We received the most comfortable library in Jakarta award for our calming library ambience.',
                'img' => 'comfort.png'
            ],
            [
                'name' => 'Most Aesthetically Pleasing',
                'desc' => 'We received the Most Aesthetically Pleasing in Jakarta award for our fancy building architecture.',
                'img' => 'fancy.png'
            ],
            [
                'name' => 'Best Book Collection',
                'desc' => 'We received the library with best book collection in Jakarta award for our complete and massive book collection.',
                'img' => 'books.png'
            ]
        ];
        return view('welcome', compact('carouselImg', 'services', 'awardsDetail'));
    }
}
