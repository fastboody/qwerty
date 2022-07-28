<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\map;
use App\Models\chapter;
use App\Models\question;
use App\Models\status;
use App\Models\teammate;
use App\Models\tiding;
use App\Models\userquestion;
use App\Models\video;
use App\Models\document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMapPointController extends Controller
{
    public function mappoint()/*Вывод точек на карте и новотсей на главной стр*/
    {
        $row = DB::table('maps')
            ->orderBy('title')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude')
            ->where('status', '!=', 'Обработка')
            ->get();
        return view('map', [
            'list'=>$row
        ]);
    }
    protected function checkRecaptcha($token, $ip)
    {
        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => config('recaptcha.secret'),
                'response' => $token,
                'remoteip' => $ip,
            ],
        ]);
        $response = json_decode((string)$response->getBody(), true);
        return $response['success'];
    }
    /* Начало форма ответа на вопрос */
    public function replyquestionform()/*Вывод всех новостей в админке*/
    {
        $showq = userquestion::orderBy('id','desc')
            ->where('status','=','не отвечен' )
            ->paginate(8);
        return view('/expert/question_expert', [
            'showq' => $showq
        ]);
    }
    public function sentquestionform()/*Вывод всех новостей в админке*/
    {
        $showq = userquestion::orderBy('id','desc')
            ->where('status','!=','не отвечен' )
            ->paginate(8);
        return view('/expert/sent_question_expert', [
            'showq' => $showq
        ]);
    }
    public function edituserquestion($id)/*Передача всех данных новости*/
    {
        $row = DB::table('userquestions')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('/expert/edit_user_question', $data);
    }
    public function updatesentquestion(Request $request)/*запись всех данных сообщений в БД*/
    {
        $request->validate([
            'sent_question'=>'required',
            'status'=>'required'

        ]);

        $updating = DB::table('userquestions')
            ->where('id', $request->input('id_sentquestion'))
            ->update([
                'sent_question'=>$request->input('sent_question'),
                'status'=>$request->input('status')

            ]);
        return redirect('question_expert');

    }
    public function deletesentquestion($id)
    {
        $delete = DB::table('userquestions')
            ->where('id', $id)
            ->delete();
        return redirect('sent_question_expert');


    }
    public function deletemessagequestion($id)
    {
        $delete = DB::table('userquestions')
            ->where('id', $id)
            ->delete();
        return redirect('question_expert');


    }
    /* Конец формы ответа на вопрос*/
    public function newpoint()
    {
        $new = tiding::orderBy('id', 'desc')->paginate(3);
        return view('index', [
            'news' => $new
        ]);

    }
  public function mymappointmessage($id)/*Вывод точек на карте моих сообщений*/
    {
        $row = DB::table('maps')
            ->orderBy('title')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.user_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude', 'users.name', 'users.email')
            ->where('status', '!=', 'Обработка')
            ->where('maps.user_id', '=', $id)
            ->get();
        $showm = map::orderBy('id','desc')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.user_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude','users.name', 'users.email')
            ->where('status', '=','Обработка')
            ->where('maps.user_id', '=', $id)
            ->paginate(5);
        return view('my_map_message', [
            'list'=>$row,
            'showm' => $showm
        ]);
    }
    public function deletemymapmessage($id)
    {
        $delete = DB::table('maps')
            ->where('id', $id)
            ->delete();
        $deletearchive = DB::table('archive_maps')
            ->where('message_id', $id)
            ->delete();
        return redirect('/');


    }
    public function editmymapmessage($id)/*Передача всех данных новости*/
    {
        $row = DB::table('maps')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];
        $rowarchive = DB::table('archive_maps')
            ->where('message_id', $id)
            ->first();
        if($rowarchive === null)
        {
            $query = DB::table('archive_maps')-> insert([
                'message_id'=>$row->id,
                'addresses_id'=>$row->addresses_id,
                'description'=>$row->description,
                'status'=>$row->status,
                'user_id'=>$row->user_id,
                'link_source'=>$row->link_source,
                'image'=>$row->image
            ]);
        }

        return view('edit_my_message', $data);
    }
    public function updatemymapmessage(Request $request)/*запись всех данных новости в БД*/
    {

        $request->validate(
            [
                "id_address" => 'required|integer',
                'id_message'=>'required',
                'status'=>'required',
                'user_id'=>'required',
                'description'=>'required',
                'link_source'=>'required',
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ],
            [
                "id_address.required" => "Одно из полей (Адрес, Уик, Индекс) должно быть заполнено!"
            ]
        );
        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }

        $updating = DB::table('maps')
            ->where('id', $request->input('id_message'))
            ->update([
                'addresses_id'=>$request->input('id_address'),
                'description'=>$request->input('description'),
                'link_source'=>$request->input('link_source'),
                'image'=>json_encode($images_name)

            ]);
        $updatingarchive = DB::table('archive_maps')-> insert([
            'addresses_id'=>$request->input('id_address'),
            'message_id'=>$request->input('id_message'),
            'description'=>$request->input('description'),
            'status'=>$request->input('status'),
            'user_id'=>$request->input('user_id'),
            'link_source'=>$request->input('link_source'),
            'image'=>json_encode($images_name)
        ]);
        return redirect('/');
    }
    /*Добавление новостей -- НАЧАЛО*/
    public function addtidingform()/*Вывод всех новостей в админке*/
    {
        $show = tiding::orderBy('id', 'desc')
            ->join('users', 'tidings.user_id', '=', 'users.id')
            ->select('tidings.*','users.name', 'users.email')
            ->paginate(5);
        return view('/admin/add_tiding', [
            'show' => $show
        ]);

    }
    public function addtiding(Request $request)/*Обработчик добавления новостей*/
    {


        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'user_id'=>'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }

        $query = DB::table('tidings')-> insert([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'description_max'=>$request->input('description_max'),
            'user_id'=>$request->input('user_id'),
            'image'=>json_encode($images_name)
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    /*Добавление новостей -- КОНЕЦ*/
    /*Редактирование новостей -- НАЧАЛО*/
    public function updatetiding(Request $request)/*запись всех данных новости в БД*/
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);
        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }

        $updating = DB::table('tidings')
            ->where('id', $request->input('id_tiding'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'description_max'=>$request->input('description_max'),
                'image'=>json_encode($images_name)

            ]);
        return redirect('add_tiding');

    }
    public function edittiding($id)/*Передача всех данных новости*/
    {
        $row = DB::table('tidings')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('/admin/edit_tiding', $data);
    }
    /*Редактирование новостей -- КОНЕЦ*/
    /*Удаление новостей -- НАЧАЛО*/
    public function deletetiding($id)
    {
        $delete = DB::table('tidings')
            ->where('id', $id)
            ->delete();
        return redirect('add_tiding');


    }
    /*Удаление новостей -- Конец*/
    /*Добавление сообщения пользователя -- НАЧАЛО*/
    public function indexmessagepols()/*Вывод всех новостей в админке*/
    {
        $show = map::all();
        return view('add_message', [
            'show' => $show
        ]);

    }
    public function addmessage(Request $request)/*Обработчик добавления новостей*/
    {
        $request->validate(
            [
                "id_address" => 'required|integer',
                'title'=>'required',
                'description'=>'required',
                'status'=>'required',
                'user_id'=>'required',
                'link_source'=>'required',
//                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ],
            [
                "id_address.required" => "Одно из полей (Адрес, Уик, Индекс) должно быть заполнено!"
            ]
        );

        $images = $request->file('images');
        $images_name = [];

        if($images !== null){
            foreach($images as $image){
                $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'uploads';
                $image->move($destinationPath, $imageName);

                $images_name[] = $imageName;
            }
        }

        $query = DB::table('maps')-> insert([
            'addresses_id'=>$request->input('id_address'),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'status'=>$request->input('status'),
            'user_id'=>$request->input('user_id'),
            'link_source'=>$request->input('link_source'),
            'image'=>json_encode($images_name)
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    public function adduserquestion(Request $request)
    {
        $request->validate(
            [
                'username'=>'required',
                'question'=>'required',
                'status'=>'required',
                'g-recaptcha-response' => 'required|captcha'
            ],
            [
                'g-recaptcha-response.required' => 'Вы не прошли проверку!'
            ]

        );



        $query = DB::table('userquestions')-> insert([
            'username'=>$request->input('username'),
            'usermail'=>$request->input('usermail'),
            'usernumber'=>$request->input('usernumber'),
            'question'=>$request->input('question'),
            'status'=>$request->input('status')


        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    /*Добавление сообщения пользователя -- КОНЕЦ*/
    public function editmessage($id)/*Передача всех данных новости*/
    {
        $row = DB::table('maps')
            ->where('id', $id)
            ->first();
        $Infos = status::all();

        $data =[
            'Infos'=>$Infos,
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('/expert/edit_message', $data);
    }
    public function updatesentmessage(Request $request)/*запись всех данных сообщений в БД*/
    {
        $request->validate([
            'title'=>'required',
            'link_source_spc'=>'required',
            'status'=>'required'

        ]);

        $updating = DB::table('maps')
            ->where('id', $request->input('id_message'))
            ->update([
                'title'=>$request->input('title'),
                'link_source_spc'=>$request->input('link_source_spc'),
                'status'=>$request->input('status')

            ]);
        return redirect('sent_message_expert');

    }
    public function updatemessage(Request $request)/*запись всех данных сообщений в БД*/
    {
        $request->validate([
            'title'=>'required',
            'spec_id'=>'required',
            'link_source_spc'=>'required',
            'status'=>'required'

        ]);

        $updating = DB::table('maps')
            ->where('id', $request->input('id_message'))
            ->update([
                'title'=>$request->input('title'),
                'spec_id'=>$request->input('spec_id'),
                'link_source_spc'=>$request->input('link_source_spc'),
                'status'=>$request->input('status')

            ]);
        return redirect('message_expert');

    }
    public function deletemessage($id)
    {
        $delete = DB::table('maps')
            ->where('id', $id)
            ->delete();
        return redirect('message_expert');


    }
    public function archivereplymessageform($id)/*архив*/
    {
        $showm = DB::table('archive_maps')->orderBy('id','desc')
            ->join('addresses', 'archive_maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'archive_maps.user_id', '=', 'users.id')
            ->select('archive_maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude','users.name', 'users.email')
            ->where('status', '=','Обработка')
            ->Where('archive_maps.message_id', $id)
            ->paginate(8);
        return view('/expert/archive_message_expert', [
            'showm' => $showm
        ]);
    }
    public function deletesentmessage($id)
    {
        $delete = DB::table('maps')
            ->where('id', $id)
            ->delete();
        return redirect('sent_message_expert');


    }
    public function editsentmessage($id)/*Передача всех данных новости*/
    {
        $row = DB::table('maps')
            ->where('id', $id)
            ->first();
        $Infos = status::all();
        $data =[
            'Info'=>$row,
            'Infos'=>$Infos,
            'Title'=>'Редактирование данных'
        ];

        return view('/expert/edit_sent_message', $data);
    }
    public function addstatus(Request $request)/*Обработчик добавления video*/
    {
        $request->validate([
            'user_id'=>'required',
            'status'=>'required'
        ]);

        $query = DB::table('statuses')-> insert([
            'user_id'=>$request->input('user_id'),
            'status'=>$request->input('status')
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    public function editstatus($id)/*Передача всех данных video*/
    {
        $row = DB::table('statuses')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoV'=>$row,
            'TitleV'=>'Редактирование данных'
        ];

        return view('/expert/edit_status', $data);
    }
    public function updatestatus(Request $request)/*запись видео в БД*/
    {
        $request->validate([
            'status'=>'required'
        ]);
        $updating = DB::table('statuses')
            ->where('id', $request->input('id_status'))
            ->update([
                'status'=>$request->input('status')
            ]);
        return redirect('add_status_message');

    }
    public function deletestatus($id)
    {
        $delete = DB::table('statuses')
            ->where('id', $id)
            ->delete();
        return redirect('add_status_message');


    }
    public function addstatusmessageform()/*Вывод video в админке*/
    {
        $showv = status::orderBy('id', 'desc')
            ->join('users', 'statuses.user_id', '=', 'users.id')
            ->select('statuses.*','users.name', 'users.email')
            ->paginate(8);
        return view('/expert/add_status_message', [
            'showv' => $showv
        ]);
    }

  // НАЧАЛО ФОРМЫ ВОПРОСОВ РАЗДЕЛОВ В FAQ
    public function faq()/*Вывод точек на карте и новотсей на главной стр*/
    {
        $row = question::orderBy('question_name')
            ->join('chapters', 'questions.id_chapter', '=', 'chapters.id')
            ->select('questions.*', 'chapters.chapter_name','chapters.link')
            ->get();
        $Info= chapter::all();

        return view('faq', [
            'list'=>$row,
            'Info'=>$Info
        ]);
    }
    public function addquestionform()/*Вывод всех новостей в админке*/
    {
        $showq = question::orderBy('question_name')
            ->join('chapters', 'questions.id_chapter', '=', 'chapters.id')
            ->select('questions.*', 'chapters.chapter_name')
            ->paginate(5);
        $Info=chapter::all();

        return view('/expert/add_question', [
            'showq' => $showq,
            'Info'=>$Info
        ]);

    }

    public function addquestion(Request $request)/*Обработчик добавления вопросов*/
    {
        $request->validate([
            'question_name'=>'required',
            'description'=>'required',
            'id_chapter'=>'required'
        ]);

        $query = DB::table('questions')-> insert([
            'question_name'=>$request->input('question_name'),
            'description'=>$request->input('description'),
            'id_chapter'=>$request->input('id_chapter')
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    public function deletequestion($id)
    {
        $delete = DB::table('questions')
            ->where('id', $id)
            ->delete();
        return redirect('add_question');


    }
    public function editquestion($id)/*Передача всех данных разделов*/
    {
        $row = DB::table('questions')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoQ'=>$row,
            'TitleQ'=>'Редактирование данных'
        ];

        return view('/expert/edit_question', $data);
    }
    public function updatequestion(Request $request)/*запись разделов в БД*/
    {
        $request->validate([
            'question_name'=>'required'
        ]);
        $updating = DB::table('questions')
            ->where('id', $request->input('id_question'))
            ->update([
                'question_name'=>$request->input('question_name'),
                'description'=>$request->input('description')
            ]);
        return redirect('add_question');

    }
    // Конец ФОРМЫ ВОПРОСОВ РАЗДЕЛОВ В FAQ

    // НАЧАЛО ФОРМЫ ДОБАВЛЕНИЯ РАЗДЕЛОВ В FAQ
    public function addchapterform()/*Раздел FAQ*/
    {
        $showc = chapter::orderBy('id', 'desc')->paginate(8);
        return view('/expert/add_chapter', [
            'showc' => $showc
        ]);

    }
    public function addchapter(Request $request)/*Обработчик добавления разделов*/
    {
        $request->validate([
            'chapter_name'=>'required',
            'link'=>'required'
        ]);

        $query = DB::table('chapters')-> insert([
            'chapter_name'=>$request->input('chapter_name'),
            'link'=>$request->input('link')
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    public function deletechapter($id)
    {
        $delete = DB::table('chapters')
            ->where('id', $id)
            ->delete();
        return redirect('add_chapter');


    }
    public function editchapter($id)/*Передача всех данных разделов*/
    {
        $row = DB::table('chapters')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoC'=>$row,
            'TitleC'=>'Редактирование данных'
        ];

        return view('/expert/edit_chapter', $data);
    }
    public function updatechapter(Request $request)/*запись разделов в БД*/
    {
        $request->validate([
            'chapter_name'=>'required',
            'link'=>'required'
        ]);
        $updating = DB::table('chapters')
            ->where('id', $request->input('id_chapter'))
            ->update([
                'chapter_name'=>$request->input('chapter_name'),
                'link'=>$request->input('link')
            ]);
        return redirect('add_chapter');

    }
    // КОНЕЦ ФОРМЫ ДОБАВЛЕНИЯ РАЗДЕЛОВ В FAQ

    /*Вывод новости*/
    public function tidinggen($id)/*Передача всех данных новости*/
    {
        $row = DB::table('tidings')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('tiding_gen', $data);
    }
    /*Конец вывода новстей*/

  /*Вывод сотрудника*/
    public function teamgenform($id)/*Передача всех данных о сотруднике*/
    {
        $row = DB::table('teammates')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Наша команда'
        ];

        return view('team_gen', $data);
    }
    /*Конец вывода сотрудника*/

    public function docmap()/*Вывод точек на карте и новотсей на главной стр*/
    {
        $doc = document::orderBy('id', 'desc')->paginate(6);
        return view('document', [
            'document' => $doc
        ]);


    }
    public function adddocumentform()/*Вывод всех новостей в админке*/
    {
        $showD = document::orderBy('id', 'desc')
            ->join('users', 'documents.user_id', '=', 'users.id')
            ->select('documents.*','users.name', 'users.email')
            ->paginate(5);
        return view('/admin/add_document', [
            'showD' => $showD
        ]);

    }
    public function addocument(Request $request)/*Обработчик добавления сотрудника*/
    {


        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'document' => 'required|file|mimes:pdf|max:2048'
        ]);

        $document = $request->file('document');
        $documentName = md5(random_bytes(32)) . '.' . $document->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $document->move($destinationPath, $documentName);


        $query = DB::table('documents')->insert([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'document' => $documentName
        ]);
        if ($query) {
            return back()->with('success', 'Данные успешно загружены');
        } else {
            return back()->with('fail', 'Данные не были загружены');
        }
    }
    public function editdocument($id)/*Передача всех данных новости*/
    {
        $row = DB::table('documents')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoD'=>$row,
            'TitleD'=>'Редактирование данных'
        ];

        return view('/admin/edit_document', $data);
    }
    public function updatedocument(Request $request)/*запись всех данных в БД*/
    {
        $request->validate([
            'title'=>'required',
            'document' => 'required|file|mimes:pdf|max:2048'
        ]);

        $document = $request->file('document');
        $documentName = md5(random_bytes(32)) . '.' . $document->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $document->move($destinationPath, $documentName);

        $updating = DB::table('documents')
            ->where('id', $request->input('id_document'))
            ->update([
                'title'=>$request->input('title'),
                'document' => $documentName

            ]);
        return redirect('add_document');

    }
    public function deletedocument($id)
    {
        $delete = DB::table('documents')
            ->where('id', $id)
            ->delete();
        return redirect('add_document');


    }
    /*Видео*/
    public function videomap()/*Вывод точек на карте и новотсей на главной стр*/
    {
        $vid = video::orderBy('id', 'desc')->paginate(6);
        return view('video', [
            'video' => $vid
        ]);


    }
    public function videogen($id)/*Передача всех данных для видео*/
    {
        $row = DB::table('videos')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoV'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('video_gen', $data);
    }
    public function updatevideo(Request $request)/*запись видео в БД*/
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required'
        ]);
        $updating = DB::table('videos')
            ->where('id', $request->input('id_video'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'description_max'=>$request->input('description_max'),
                'video_link'=>$request->input('video_link')

            ]);
        return redirect('add_video');

    }
    public function addvideo(Request $request)/*Обработчик добавления video*/
    {
        $request->validate([
            'title'=>'required',
            'user_id'=>'required',
            'description'=>'required',
            'description_max'=>'required'
        ]);

        $query = DB::table('videos')-> insert([
            'title'=>$request->input('title'),
            'user_id'=>$request->input('user_id'),
            'description'=>$request->input('description'),
            'description_max'=>$request->input('description_max'),
            'video_link'=>$request->input('video_link')
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    public function addvideoform()/*Вывод video в админке*/
    {
        $showv = video::orderBy('id', 'desc')
        ->join('users', 'videos.user_id', '=', 'users.id')
        ->select('videos.*','users.name', 'users.email')
        ->paginate(6);
        return view('/admin/add_video', [
            'showv' => $showv
        ]);

    }
    public function editvideo($id)/*Передача всех данных video*/
    {
        $row = DB::table('videos')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoV'=>$row,
            'TitleV'=>'Редактирование данных'
        ];

        return view('/admin/edit_video', $data);
    }
    /*Удаление video -- НАЧАЛО*/
    public function deletevideo($id)
    {
        $delete = DB::table('videos')
            ->where('id', $id)
            ->delete();
        return redirect('add_video');


    }
    /*Удаление video -- Конец*/

    public function teamform()
    {
        $newt = teammate::paginate(6);
        return view('team', [
            'news' => $newt
        ]);


    }
    /*Администрирование video -- КОНЕЦ*/
    /*Администрирование Сотрудников -- НАЧАЛО*/
 /*   public function addteammatespoint(Request $request)/*Обработчик добавления сотрудника
    {


        $request->validate([
            'employee' => 'required',
            'description' => 'required',
            'description_max' => 'required',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        $image = $request->file('image');
        $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $imageName);


        $query = DB::table('teammates')->insert([
            'employee' => $request->input('employee'),
            'description' => $request->input('description'),
            'description_max' => $request->input('description_max'),
            'user_id' => $request->input('user_id'),
            'image' => $imageName
        ]);
        if ($query) {
            return back()->with('success', 'Данные успешно загружены');
        } else {
            return back()->with('fail', 'Данные не были загружены');
        }
    }
  */

  public function addteammatespoint(Request $request)/*Обработчик добавления новостей*/
    {


        $request->validate([
            'employee'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'user_id'=>'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'gram_images' => 'required',
            'gram_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480'
        ]);

        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }


        $gram_images = $request->file('gram_images');
        $gram_images_name = [];

        foreach($gram_images as $gram_image){
            $gram_imageName = md5(random_bytes(32)) . '.' . $gram_image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $gram_image->move($destinationPath, $gram_imageName);

            $gram_images_name[] = $gram_imageName;
        }

        $query = DB::table('teammates')-> insert([
            'employee'=>$request->input('employee'),
            'description'=>$request->input('description'),
            'description_max'=>$request->input('description_max'),
            'user_id'=>$request->input('user_id'),
            'image'=>json_encode($images_name),
            'gram_image'=>json_encode($gram_images_name)
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }


    public function addteammateform()/*Вывод video в админке*/
    {
        $showt = teammate::orderBy('id', 'desc')
            ->join('users', 'teammates.user_id', '=', 'users.id')
            ->select('teammates.*','users.name', 'users.email')
            ->paginate(6);
        return view('/admin/add_teammate', [
            'showt' => $showt
        ]);

    }
    public function editteammate($id)/*Передача всех данных новости*/
    {
        $row = DB::table('teammates')
            ->where('id', $id)
            ->first();
        $data =[
            'InfoT'=>$row,
            'TitleT'=>'Редактирование данных'
        ];

        return view('/admin/edit_teammate', $data);
    }
 /*   public function updateteammate(Request $request)/*запись всех данных членов команды в БД
    {
        $request->validate([
            'employee'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        $image = $request->file('image');
        $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $imageName);

        $updating = DB::table('teammates')
            ->where('id', $request->input('id_teammate'))
            ->update([
                'employee'=>$request->input('employee'),
                'description'=>$request->input('description'),
                'description_max'=>$request->input('description'),
                'image' => $imageName

            ]);
        return redirect('add_teammate');

    }
  */

  public function updateteammate(Request $request)/*запись всех данных новости в БД*/
    {
        $request->validate([
            'employee'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'gram_images' => 'required',
            'gram_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480'

        ]);
        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }

        $gram_images = $request->file('gram_images');
        $gram_images_name = [];

        foreach($gram_images as $gram_image){
            $gram_imageName = md5(random_bytes(32)) . '.' . $gram_image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $gram_image->move($destinationPath, $gram_imageName);

            $gram_images_name[] = $gram_imageName;
        }

        $updating = DB::table('teammates')
            ->where('id', $request->input('id_teammate'))
            ->update([
                'employee'=>$request->input('employee'),
                'description'=>$request->input('description'),
                'description_max'=>$request->input('description_max'),
                'image'=>json_encode($images_name),
                'gram_image'=>json_encode($gram_images_name),

            ]);
        return redirect('add_teammate');

    }



    /*Удаление новостей -- НАЧАЛО*/
    public function deleteteammate($id)
    {
        $delete = DB::table('teammates')
            ->where('id', $id)
            ->delete();
        return redirect('add_teammate');


    }
    /*Добавление новостей -- НАЧАЛО*/
    public function assign_role()/*Вывод всех новостей в админке*/
    {
        $show = DB::table('users')
            ->orderBy('name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.*')
            ->paginate(10);
        return view('/admin/assign_role', [
            'show' => $show
        ]);

    }
    /*Поисковая система*/
    /*Начало*/
    public function search_assign_role(Request $request)
    {
        $s = $request->s;
        $show = DB::table('users')
            ->where('users.name', 'LIKE', "%{$s}%" )
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orWhere('users.id', 'LIKE', "%{$s}%")
            ->orWhere('model_has_roles.role_id', 'LIKE', "%{$s}%")
            ->orderBy('name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.*')
            ->paginate(10);
        return view('/admin/assign_role', [
            'show' => $show
        ]);

    }
    public function search_document(Request $request)
    {
        $s = $request->s;
        $showD = DB::table('documents')
            ->join('users', 'documents.user_id', '=', 'users.id')
            ->select('documents.*','users.name', 'users.email')
            ->where('documents.title', 'LIKE', "%{$s}%" )
            ->orWhere('documents.id', 'LIKE', "%{$s}%")
            ->orWhere('documents.created_at', 'LIKE', "%{$s}%")
            ->orWhere('documents.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('/admin/add_document', [
            'showD' => $showD
        ]);

    }
    public function search_teammate(Request $request)
    {
        $s = $request->s;
        $showt = DB::table('teammates')
            ->join('users', 'teammates.user_id', '=', 'users.id')
            ->select('teammates.*','users.name', 'users.email')
            ->where('teammates.employee', 'LIKE', "%{$s}%" )
            ->orWhere('teammates.description', 'LIKE', "%{$s}%")
            ->orWhere('teammates.id', 'LIKE', "%{$s}%")
            ->orWhere('teammates.created_at', 'LIKE', "%{$s}%")
            ->orWhere('teammates.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('/admin/add_teammate', [
            'showt' => $showt
        ]);

    }
    public function search_video(Request $request)
    {
        $s = $request->s;
        $showv = DB::table('videos')
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->select('videos.*','users.name', 'users.email')
            ->where('videos.title', 'LIKE', "%{$s}%" )
            ->orWhere('videos.description', 'LIKE', "%{$s}%")
            ->orWhere('videos.description_max', 'LIKE', "%{$s}%")
            ->orWhere('videos.id', 'LIKE', "%{$s}%")
            ->orWhere('videos.created_at', 'LIKE', "%{$s}%")
            ->orWhere('videos.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('/admin/add_video', [
            'showv' => $showv
        ]);

    }
    public function search_tiding(Request $request)
    {
        $s = $request->s;
        $show = DB::table('tidings')
            ->join('users', 'tidings.user_id', '=', 'users.id')
            ->select('tidings.*','users.name', 'users.email')
            ->where('tidings.title', 'LIKE', "%{$s}%" )
            ->orWhere('tidings.description', 'LIKE', "%{$s}%")
            ->orWhere('tidings.description_max', 'LIKE', "%{$s}%")
            ->orWhere('tidings.id', 'LIKE', "%{$s}%")
            ->orWhere('tidings.created_at', 'LIKE', "%{$s}%")
            ->orWhere('tidings.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('/admin/add_tiding', [
            'show' => $show
        ]);

    }
    public function search_status(Request $request)
    {
        $s = $request->s;
        $showv = DB::table('statuses')
            ->join('users', 'statuses.user_id', '=', 'users.id')
            ->select('statuses.*','users.name', 'users.email')
            ->where('statuses.status', 'LIKE', "%{$s}%" )
            ->orWhere('statuses.id', 'LIKE', "%{$s}%")
            ->orWhere('statuses.created_at', 'LIKE', "%{$s}%")
            ->orWhere('statuses.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view('/expert/add_status_message', [
            'showv' => $showv
        ]);

    }
    public function search_replymessage(Request $request)
    {
        $s = $request->s;
        $showm = DB::table('maps')
            ->where('maps.title', 'LIKE', "%{$s}%" )
            ->orWhere('maps.description', 'LIKE', "%{$s}%")
            ->orWhere('maps.link_source', 'LIKE', "%{$s}%")
            ->orWhere('maps.id', 'LIKE', "%{$s}%")
            ->orWhere('addresses.address', 'LIKE', "%{$s}%")
            ->orWhere('maps.created_at', 'LIKE', "%{$s}%")
            ->orWhere('maps.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.user_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude','users.name', 'users.email')
            ->where('status', '=','Обработка')
            ->paginate(8);
        return view('/expert/message_expert', [
            'showm' => $showm
        ]);

    }
    public function search_sentmessage(Request $request)
    {
        $s = $request->s;
        $showm = DB::table('maps')
            ->where('maps.title', 'LIKE', "%{$s}%" )
            ->orWhere('maps.description', 'LIKE', "%{$s}%")
            ->orWhere('maps.link_source', 'LIKE', "%{$s}%")
            ->orWhere('maps.id', 'LIKE', "%{$s}%")
            ->orWhere('addresses.address', 'LIKE', "%{$s}%")
            ->orWhere('maps.created_at', 'LIKE', "%{$s}%")
            ->orWhere('maps.updated_at', 'LIKE', "%{$s}%")
            ->orWhere('users.name', 'LIKE', "%{$s}%")
            ->orWhere('users.email', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.spec_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude', 'users.name', 'users.email')
            ->where('status', '!=','Обработка')
            ->paginate(8);
        return view('/expert/sent_message_expert', [
            'showm' => $showm
        ]);


    }
  public function search_news(Request $request)
    {
        $s = $request->s;
        $news = DB::table('tidings')
            ->where('tidings.title', 'LIKE', "%{$s}%" )
            ->orWhere('tidings.description', 'LIKE', "%{$s}%")
            ->orWhere('tidings.created_at', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('index', [
            'news' => $news
        ]);

    }
  public function search_documents(Request $request)
    {
        $s = $request->s;
        $document = DB::table('documents')
            ->where('documents.title', 'LIKE', "%{$s}%" )
            ->orWhere('documents.created_at', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('document', [
            'document' => $document
        ]);

    }
   public function search_videos(Request $request)
    {
        $s = $request->s;
        $video = DB::table('videos')
            ->where('videos.title', 'LIKE', "%{$s}%" )
            ->orWhere('videos.description', 'LIKE', "%{$s}%")
            ->orWhere('videos.created_at', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('video', [
            'video' => $video
        ]);

    }
   public function search_team(Request $request)
    {
        $s = $request->s;
        $newt = DB::table('teammates')
            ->where('teammates.employee', 'LIKE', "%{$s}%" )
            ->orWhere('teammates.description', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('team', [
            'news' => $newt
        ]);

    }

    public function search_question_expert(Request $request)
    {
        $s = $request->s;
        $showq = DB::table('userquestions')
            ->where('userquestions.username', 'LIKE', "%{$s}%" )
            ->orWhere('userquestions.id', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.usermail', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.usernumber', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.question', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.sent_question', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.created_at', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.updated_at', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('/expert/question_expert', [
            'showq' => $showq
        ]);

    }
    public function search_sent_question_expert(Request $request)
    {
        $s = $request->s;
        $showq = DB::table('userquestions')
            ->where('userquestions.username', 'LIKE', "%{$s}%" )
            ->orWhere('userquestions.id', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.usermail', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.usernumber', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.question', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.sent_question', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.created_at', 'LIKE', "%{$s}%")
            ->orWhere('userquestions.updated_at', 'LIKE', "%{$s}%")
            ->orderBy('id', 'desc')
            ->where('status', '=','отвечен')
            ->paginate(6);
        return view('/expert/sent_question_expert', [
            'showq' => $showq
        ]);

    }



    /*Поисковая система*/
    /*Конец*/
    public function editassignrole($id)/*Передача всех данных новости*/
    {
        $row = DB::table('model_has_roles')
            ->where('model_id', $id)
            ->first();
        $data =[
            'Infos'=>$row,
            'Title'=>'Редактирование роли'
        ];

        return view('/admin/edit_assign_role', $data);
    }
    public function updateassignrole(Request $request)/*запись всех данных новости в БД*/
    {
        $request->validate([
            'role_id'=>'required'
        ]);



        $updating = DB::table('model_has_roles')
            ->where('model_id', $request->input('model_id'))
            ->update([
                'role_id'=>$request->input('role_id'),

            ]);
        return redirect('assign_role');

    }
    public function deleteassignrole($id)
    {
        $delete = DB::table('users')
            ->where('id', $id)
            ->delete();
        return redirect('assign_role');


    }
    /*Удаление новостей -- Конец*/
    /*Администрирование сотрудников -- КОНЕЦ*/
    public function replymessageform()/*Вывод всех новостей в админке*/
    {
        $showm = map::orderBy('id','desc')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.user_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude','users.name', 'users.email')
            ->where('status', '=','Обработка')
            ->paginate(8);
        return view('/expert/message_expert', [
            'showm' => $showm
        ]);
    }
    public function sentmessageform()/*Вывод всех отвеченых сообщений в админке*/
    {
        $showm = map::orderBy('id', 'desc')
            ->join('addresses', 'maps.addresses_id', '=', 'addresses.id')
            ->join('users', 'maps.spec_id', '=', 'users.id')
            ->select('maps.*', 'addresses.address', 'addresses.latitude', 'addresses.longitude', 'users.name', 'users.email')
            ->where('status', '!=','Обработка')
            ->paginate(8);
        return view('/expert/sent_message_expert', [
            'showm' => $showm
        ]);

    }
    public function getaddresses(Request $request)
    {
        $data = $request->all();
        $addresses = [];

        if(!empty($data["address"])){
            $rows = DB::table('addresses')
                ->select(['id', 'address'])
                ->where('address', 'LIKE', "%{$data['address']}%")
                ->get();


            foreach ($rows as $row){
                $addresses[] = [
                    "id" => $row->id,
                    "address" => $row->address
                ];
            }
        }

        return response()->json($addresses);
    }
    public function getuiks(Request $request){
        $data = $request->all();
        $uiks = [];

        if(!empty($data["uik"])){
            $rows = DB::table('addresses')
                ->select(['id', 'uik'])
                ->where('uik', 'LIKE', "%{$data['uik']}%")
                ->get();


            foreach ($rows as $row){
                $uiks[] = [
                    "id" => $row->id,
                    "uik" => $row->uik
                ];
            }
        }

        return response()->json($uiks);
    }
    public function getindexes(Request $request){
        $data = $request->all();
        $indexes = [];

        if(!empty($data["index"])){
            $rows = DB::table('addresses')
                ->select(['id', 'index'])
                ->where('index', 'LIKE', "%{$data['index']}%")
                ->get();


            foreach ($rows as $row){
                $indexes[] = [
                    "id" => $row->id,
                    "index" => $row->index
                ];
            }
        }

        return response()->json($indexes);
    }
}
