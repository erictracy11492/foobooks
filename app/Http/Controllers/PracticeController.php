<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; # <----------- NEW

class PracticeController extends Controller
{

    public function practiceX()
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: '.$book->title);
    }
    
}

# [...]