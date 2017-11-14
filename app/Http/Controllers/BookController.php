<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{

    //
    
    //will act as index for all of the books
    public function index() 
    {
        //return 'Show all the books...';
        return view('book.index');
    }
    
    //public function show($title) 
    //{
        //return 'You are viewing '.$title;
    //}
    
    public function show($title) 
    {
        return view('book.show')->with ([
            'title' => $title,
        ]);
    }
    
    //public function show($title = null) 
    //{
        //dump($title);
        //return view('book.show')->with ([
            //'title' => $title,
       // ]);
   // }
    
    //public function search() 
    //{
        //return view('book.search');
    //}
    
public function search(Request $request) {

    # Start with an empty array of search results; books that
    # match our search query will get added to this array
    $searchResults = [];
    
    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.
    $searchTerm = $request->input('searchTerm', null);
    
    # Only try and search *if* there's a searchTerm
    if ($searchTerm) {
        # Open the books.json data file
        # database_path() is a Laravel helper to get the path to the database folder
        # See https://laravel.com/docs/helpers for other path related helpers
        $booksRawData = file_get_contents(database_path('/books.json'));
        
        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $books = json_decode($booksRawData, true);
        
        # Loop through all the book data, looking for matches
        # This code was taken from v0 of foobooks we built earlier in the semester
        foreach ($books as $title => $book) {
            # Case sensitive boolean check for a match
            if ($request->has('caseSensitive')) {
                $match = $title == $searchTerm;
            # Case insensitive boolean check for a match
            } else {
                $match = strtolower($title) == strtolower($searchTerm);
            }
            
            # If it was a match, add it to our results
            if ($match) {
                $searchResults[$title] = $book;
            }
        }
    }
    
    # Return the view, with the searchTerm *and* searchResults (if any)
    return view('book.search')->with([
        'searchTerm' => $searchTerm,
        'caseSensitive' => $request->has('caseSensitive'),
        'searchResults' => $searchResults
    ]);
}
    
}
