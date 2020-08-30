<?php
use Carbon\Carbon;
use App\Category;

  // socialite package route for facebook
  Route::get('login/facebook', 'Auth\FacebookController@redirectToProvider');
  Route::get('login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

  //  like unlike route section
    Route::post('likeUnlike', 'LikeController@likeUnlike')->name('likeUnlike');
    Route::get('getLiveValue', 'LikeController@getLiveValue')->name('getLiveValue');

  // socialite package route for google
  Route::get('login/google', 'Auth\GoogleController@redirectToProvider');
  Route::get('login/google/callback', 'Auth\GoogleController@handleProviderCallback');

  Route::post('/addNewSubscriber', 'SubscriberController@addSubscriber')->name('addSubscriber');
  Route::post('/unSubscribe', 'SubscriberController@unSubscribe')->name('unSubscribe');

  Route::get('searchQuestion','SearchController@searchQuestion')->name('searchQuestion');
  Route::post('home','SearchController@searchQuestionByType')->name('searchQuestionByType');


  Auth::routes();

  Route::get('/', 'HomeController@index')->name('index');
  Route::get('/add-question', 'QuestionController@AskQuestion')->name('askquestion');
  Route::get('/home', 'HomeController@home')->name('home');
  Route::get('/question/{id}', 'HomeController@ReadQuestion')->name('question');
  Route::post('/home/add-question', 'QuestionController@addQuestion')->name('addquestion');

  Route::post('/question-ans/{id}','AnswerController@Answer')->name('questionans');
  Route::post('/reply-ans/{id}','AnswerController@ReplyAnswer')->name('replyans');
  Route::post('/deleteAnswer/{id}','AnswerController@deleteAnswer')->name('deleteAnswer');
  Route::post('/deleteReplyAnswer/{id}','AnswerController@deleteReplyAnswer')->name('deleteReplyAnswer');
  Route::post('/editAnswer','AnswerController@editAnswer')->name('editAnswer');

  // comment and reply comment section
  Route::post('/blog/comment/{id}','CommentController@Comment')->name('comment');
  Route::post('/blog/comment/edit/{id}/{blogId}','CommentController@editComment')->name('editComment');
  Route::post('comment/delete/{id}','CommentController@DeleteComment')->name('delete');
  Route::post('/blog/reply-comment/{id}/{blogId}','CommentController@ReplyComment')->name('replyComment');
  Route::post('comment/reply/delete/{id}','CommentController@DeleteReplyComment')->name('replyCommentDelete');
  Route::post('/blog/reply-comment-edit/{blogId}/{comneId}/{id}','CommentController@ReplyCommentEdit')->name('replyCommentEdit');

  Route::get('/blog','HomeController@Blogpage')->name('blog');
  Route::get('/blog/{category}/{id}','HomeController@BlogCats')->name('blogCats');
  Route::post('blog','HomeController@blogByCategory')->name('blogSearchByCategory');
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
    $dt= Carbon::createFromFormat('Y-m-d H:i:s', $cat->created_at);
    echo $dt->diffForHumans();

  });
