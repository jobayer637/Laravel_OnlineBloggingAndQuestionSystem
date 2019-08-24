<?php
use Carbon\Carbon;
use App\Category;
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

  // socialite package route for facebook
  Route::get('login/facebook', 'Auth\FacebookController@redirectToProvider');
  Route::get('login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

  // socialite package route for google
  Route::get('login/google', 'Auth\GoogleController@redirectToProvider');
  Route::get('login/google/callback', 'Auth\GoogleController@handleProviderCallback');


  Auth::routes();

  Route::get('/', 'HomeController@index')->name('index');
  Route::get('/add-question', 'HomeController@AskQuestion')->name('askquestion');
  Route::get('/home', 'HomeController@home')->name('home');
  Route::get('/question/{id}', 'HomeController@ReadQuestion')->name('question');
  Route::post('/home', 'HomeController@addQuestion')->name('addquestion');

  Route::post('/question-ans/{id}','AnswerController@Answer')->name('questionans');
  Route::post('/reply-ans/{id}','AnswerController@ReplyAnswer')->name('replyans');

  Route::post('/blog/comment/{id}','CommentController@Comment')->name('comment');
  Route::post('comment/delete/{id}','CommentController@DeleteComment')->name('delete');
  Route::post('comment/reply/delete/{id}','CommentController@DeleteReplyComment')->name('replyCommentDelete');
  Route::post('/blog/reply-comment/{id}/{blogId}','CommentController@ReplyComment')->name('replyComment');

  Route::get('/blog','HomeController@Blogpage')->name('blog');
  Route::get('/blog/{category}/{id}','HomeController@BlogCats')->name('blogCats');
  Route::get('/blog/{category}/{id}/{title}','HomeController@ReadBlog')->name('read_blog');

  Route::group(['as'=>'admin.', 'prefix'=>'admin' ,'namespace'=>'Admin', 'middleware'=>['auth','admin']], function (){
      Route::get('dashboard', 'AdminController@admin')->name('dashboard');
      Route::resource('category','CategoryController');
      Route::resource('user','UserController');
      Route::resource('question','QuestionController');
      Route::resource('blog','BlogController');
  });

  Route::group(['as'=>'author.','prefix'=>'author','middleware'=>['auth','author']], function (){
      Route::get('dashboard', 'HomeController@author')->name('dashboard');
  });

  Route::get('/time',function(){

    $cat = Category::first();

    // $year = Carbon::createFromFormat('Y-m-d H:i:s', $cat->created_at)->year;

    $dt= Carbon::createFromFormat('Y-m-d H:i:s', $cat->created_at);
    echo $dt->diffForHumans();

  });
