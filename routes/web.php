<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/

//Форма Пользователя
Route::get('/login', function () {
    return view('home');
});
Route::get('/team', function () {
    return view('team');
});
Route::get('/aboutus', function () {
    return view('aboutus');
});
Route::get('/team_gen', function () {
    return view('team_gen');
});
Route::get('/links', function () {
    return view('links');

});



Route::get('/', [\App\Http\Controllers\AddMapPointController::class, 'newpoint'])->name('index');
Route::get('/map', [\App\Http\Controllers\AddMapPointController::class, 'mappoint']);
Route::get('/video', [\App\Http\Controllers\AddMapPointController::class, 'videomap']);
Route::get('/team', [\App\Http\Controllers\AddMapPointController::class, 'teamform']);
Route::get('/doc', [\App\Http\Controllers\AddMapPointController::class, 'docmap']);
Route::get('/search_news', [App\Http\Controllers\AddMapPointController::class, 'search_news'])->name('search_news');//поиск новостей
Route::get('/search_documents', [App\Http\Controllers\AddMapPointController::class, 'search_documents'])->name('search_documents');//поиск документов
Route::get('/search_videos', [App\Http\Controllers\AddMapPointController::class, 'search_videos'])->name('search_videos');//поиск документов
Route::get('/search_team', [App\Http\Controllers\AddMapPointController::class, 'search_team'])->name('search_team');//поиск сотрудников
Auth::routes();

Route::get('/home', [App\Http\Controllers\AddMapPointController::class, 'mappoint'])->name('home')->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/add_message', [\App\Http\Controllers\AddMapPointController::class, 'indexmessagepols']);
Route::post('/addmessage', [App\Http\Controllers\AddMapPointController::class, 'addmessage']);
Route::post('/getaddresses', [\App\Http\Controllers\AddMapPointController::class, 'getaddresses'])->name('getaddresses')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
Route::post('/getuiks', [\App\Http\Controllers\AddMapPointController::class, 'getuiks'])->name('getuiks')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
Route::post('/getindexes', [\App\Http\Controllers\AddMapPointController::class, 'getindexes'])->name('getindexes')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
Route::get('/tidinggen/{id}', [\App\Http\Controllers\AddMapPointController::class, 'tidinggen']);
Route::get('/videogen/{id}', [\App\Http\Controllers\AddMapPointController::class, 'videogen']);
Route::get('/teamgenform/{id}', [\App\Http\Controllers\AddMapPointController::class, 'teamgenform']);

//Форма вопроса и ответа
Route::get('/faq', [\App\Http\Controllers\AddMapPointController::class, 'faq']);
Route::post('/adduserquestion', [App\Http\Controllers\AddMapPointController::class, 'adduserquestion'])->name('faq-form');



//Форма Администратора
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', function () {
        return view('/admin/admin');//Главная админ панель
    });
    //Редактирование Новостей
    Route::get('/add_tiding', [\App\Http\Controllers\AddMapPointController::class, 'addtidingform']);//Форма добавления новости
    Route::post('/addtiding', [App\Http\Controllers\AddMapPointController::class, 'addtiding'])->name('add-tiding');
    Route::get('/edittiding/{id}', [\App\Http\Controllers\AddMapPointController::class, 'edittiding']);//Форма редактирования новости
    Route::post('/updatetiding', [\App\Http\Controllers\AddMapPointController::class, 'updatetiding'])->name('updatetiding');
    Route::get('/deletetiding/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletetiding'])->name('deletetiding');//Удаление новости
    Route::get('/search_tiding', [App\Http\Controllers\AddMapPointController::class, 'search_tiding'])->name('search_tiding');//поиск

    //Редактирование Видео
    Route::get('/add_video', [\App\Http\Controllers\AddMapPointController::class, 'addvideoform']);//Форма добавления видео
    Route::post('/addvideo', [App\Http\Controllers\AddMapPointController::class, 'addvideo'])->name('add-video');
    Route::get('/editvideo/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editvideo']);//Форма редактирования видео
    Route::post('/updatevideo', [\App\Http\Controllers\AddMapPointController::class, 'updatevideo'])->name('updatevideo');
    Route::get('/deletevideo/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletevideo'])->name('deletevideo');//Удаление видео
    Route::get('/search_video', [App\Http\Controllers\AddMapPointController::class, 'search_video'])->name('search_video');//поиск

    //Редактирование Членов команды
    Route::get('/add_teammate', [\App\Http\Controllers\AddMapPointController::class, 'addteammateform']);//Форма добавления членов команды
    Route::post('/addteammatespoint', [App\Http\Controllers\AddMapPointController::class, 'addteammatespoint'])->name('add-teammate');
    Route::get('/editteammate/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editteammate']);//Форма редактирования членов команды
    Route::post('/updateteammate', [\App\Http\Controllers\AddMapPointController::class, 'updateteammate'])->name('updateteammate');
    Route::get('/deleteteammate/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deleteteammate'])->name('deleteteammate');//Удаление членов команды
    Route::get('/search_teammate', [App\Http\Controllers\AddMapPointController::class, 'search_teammate'])->name('search_teammate');//поиск

    //Редактирование документов
    Route::get('/add_document', [\App\Http\Controllers\AddMapPointController::class, 'adddocumentform']);//Форма добавления Документов
    Route::post('/adddocument', [App\Http\Controllers\AddMapPointController::class, 'addocument'])->name('add-document');
    Route::get('/editdocument/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editdocument']);//Форма редактирования Документов
    Route::post('/updatedocument', [\App\Http\Controllers\AddMapPointController::class, 'updatedocument'])->name('updatedocument');
    Route::get('/deletedocument/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletedocument'])->name('deletedocument');//Удаление документов
    Route::get('/search_document', [App\Http\Controllers\AddMapPointController::class, 'search_document'])->name('search_document');//поиск

    //Выдача ролей
    Route::get('/assign_role', [\App\Http\Controllers\AddMapPointController::class, 'assign_role']);//Форма изменения роли пользователям
    Route::get('/editassignrole/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editassignrole']);//Форма редактирования роли пользователю
    Route::post('/updateassignrole', [\App\Http\Controllers\AddMapPointController::class, 'updateassignrole'])->name('updateassignrole');
    Route::get('/deleteassignrole/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deleteassignrole'])->name('deleteassignrole');//Удаление пользователя
    Route::get('/searchname_assign_role', [App\Http\Controllers\AddMapPointController::class, 'search_assign_role'])->name('searchname_assign_role');//поиск

    //Добавление раздела FAQ
    Route::get('/add_chapter', [\App\Http\Controllers\AddMapPointController::class, 'addchapterform']);//Добавление раздела FAQ
    Route::post('/addchapter', [App\Http\Controllers\AddMapPointController::class, 'addchapter'])->name('add-chapter');
    Route::get('/deletechapter/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletechapter'])->name('deletechapter');//Удаление раздела
    Route::get('/editchapter/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editchapter']);//Форма редактирования FAQ
    Route::post('/updatechapter', [\App\Http\Controllers\AddMapPointController::class, 'updatechapter'])->name('updatechapter');

    //Добавление Вопроса FAQ
    Route::get('/add_question', [\App\Http\Controllers\AddMapPointController::class, 'addquestionform']);//Добавление Вопроса FAQ
    Route::post('/addquestion', [App\Http\Controllers\AddMapPointController::class, 'addquestion'])->name('add-question');
    Route::get('/deletequestion/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletequestion'])->name('deletequestion');//Удаление раздела
    Route::get('/editquestion/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editquestion']);//Форма редактирования FAQ
    Route::post('/updatequestion', [\App\Http\Controllers\AddMapPointController::class, 'updatequestion'])->name('updatequestion');
    Route::get('/search_question_expert', [App\Http\Controllers\AddMapPointController::class, 'search_question_expert'])->name('search_question_expert');//поиск

    //Панель специолиста ответа на вопрос
    Route::get('/sent_question_expert', [\App\Http\Controllers\AddMapPointController::class, 'sentquestionform']);//Панель специолиста ответа на вопрос



});
//Форма специалиста
Route::group(['middleware' => ['role:expert|admin']], function () {
    Route::get('/expert', function () {
        return view('/expert/expert');//Главная панель эксперта
    });
    //Форма ответа на сообщение
    Route::get('/message_expert', [\App\Http\Controllers\AddMapPointController::class, 'replymessageform']);//Панель специолиста ответа на сообщения
    Route::post('/updatemessage', [\App\Http\Controllers\AddMapPointController::class, 'updatemessage'])->name('updatemessage');
    Route::get('/editmessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editmessage']);//Форма ответа на сообщение
    Route::get('/deletemessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletemessage'])->name('deletemessage');//Удаление сообщения
    Route::get('/archive_message_expert/{id}', [\App\Http\Controllers\AddMapPointController::class, 'archivereplymessageform']);//архив
    Route::get('/search_replymessage', [App\Http\Controllers\AddMapPointController::class, 'search_replymessage'])->name('search_replymessage');//поиск

    //Форма отвеченных сообщений
    Route::get('/sent_message_expert', [\App\Http\Controllers\AddMapPointController::class, 'sentmessageform']);//Панель специолиста
    Route::get('/editsentmessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editsentmessage']);//Форма отвеченных сообщений
    Route::get('/deletesentmessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletesentmessage'])->name('deletesentmessage');//Удаление отвеченного сообщения
    Route::post('/updatesentmessage', [\App\Http\Controllers\AddMapPointController::class, 'updatesentmessage'])->name('updatesentmessage');
    Route::get('/search_sentmessage', [App\Http\Controllers\AddMapPointController::class, 'search_sentmessage'])->name('search_sentmessage');//поиск

    //Редактирование Статуса
    Route::get('/add_status_message', [\App\Http\Controllers\AddMapPointController::class, 'addstatusmessageform']);//Форма добавления статуса
    Route::post('/addstatus', [App\Http\Controllers\AddMapPointController::class, 'addstatus'])->name('add-status');
    Route::get('/editstatus/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editstatus']);//Форма редактирования статуса
    Route::post('/updatestatus', [\App\Http\Controllers\AddMapPointController::class, 'updatestatus'])->name('updatestatus');
    Route::get('/deletestatus/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletestatus'])->name('deletestatus');//Удаление статуса
    Route::get('/search_status', [App\Http\Controllers\AddMapPointController::class, 'search_status'])->name('search_status');//поиск





    //Форма ответа на вопрос
    Route::get('/question_expert', [\App\Http\Controllers\AddMapPointController::class, 'replyquestionform']);//Панель специолиста ответа на вопрос

    Route::get('/edituserquestion/{id}', [\App\Http\Controllers\AddMapPointController::class, 'edituserquestion']);//Форма ответа на сообщение
    Route::post('/updatesentquestion', [\App\Http\Controllers\AddMapPointController::class, 'updatesentquestion'])->name('updatesentquestion');
    Route::get('/deletesentquestion/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletesentquestion'])->name('deletesentquestion');//Удаление сообщения
    Route::get('/deletemessagequestion/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletemessagequestion'])->name('deletemessagequestion');//Удаление сообщения
    Route::get('/search_sent_question_expert', [App\Http\Controllers\AddMapPointController::class, 'search_sent_question_expert'])->name('search_sent_question_expert');//поиск

    //Форма обратной связи
    Route::get('/feedback/{id}', [\App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [\App\Http\Controllers\FeedbackController::class, 'send'])->name('feedback.send');
});
//Форма пользователя
Route::group(['middleware' => ['role:expert|admin|user']], function () {
    Route::get('/my_map_message/{id}', [\App\Http\Controllers\AddMapPointController::class, 'mymappointmessage']);//Мои сообщения
    Route::get('/deletemymapmessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletemymapmessage'])->name('deletemymapmessage');//Удаление моего сообщения
    Route::get('/editmymapmessage/{id}', [\App\Http\Controllers\AddMapPointController::class, 'editmymapmessage']);//Форма редактирования моего сообщения
    Route::post('/updatemymapmessage', [\App\Http\Controllers\AddMapPointController::class, 'updatemymapmessage'])->name('updatemymapmessage');
});
