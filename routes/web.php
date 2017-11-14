<?php

Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

//Route::get('/', function () {
    //return view('welcome');
//});

//Route::view('/', 'welcome');
Route::get('/', 'WelcomeController');

Route::get('/example', function () {
    return 'hello there!';
});

//Route::get('/book/war-and-peace', function() {
    //return 'You are viewing War and Peace';
//});

#Show listing of ALL books
//Route::get('/book/', function () {
    //return 'Show all the books...';
//});

#Updated with Controller
Route::get('/book/', 'BookController@index');
    
//Route::get('/book/{title}', function($title) {
    #Query the books table where title matches $title
    
    //return 'You are viewing '.$title;
//});

#Updated with Controller
Route::get('/book/{title}', 'BookController@show');

//Route::get('/book/{title?}', function($title = '') {
    #Query the books table where title matches $title
    
    //if ($title == '') {
        //return 'You MUST specify a book title';
    //}
    //return 'You are viewing '.$title;
//});

Route::get('/search', 'BookController@search');



//Route parameters introduce placeholders, the value we're expecting. We feed {title} to closure function. Parameters must match (if you add say, 'category,' add to both). Instead of static, web pages become dynamic. Add question mark to make route parameter optional. User friendly URL helps with SEO also.
