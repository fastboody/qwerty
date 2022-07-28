<?php

namespace App\Http\Controllers;

use App\Events\FeedbackMailEvent;
use App\Mail\FeedbackMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index($id) {
        $row = DB::table('userquestions')
            ->where('id', $id)
            ->first();
        $data =[
            'Infos'=>$row
        ];
        return view('expert.feedback',$data);
    }

    public function send(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:500',
            'status' => 'required'
        ]);
        $updating = DB::table('userquestions')
            ->where('id', $request->input('id_feeedback'))
            ->update([
                'status'=>$request->input('status'),
                'sent_question'=>$request->input('message')
            ]);

        $data = new \stdClass();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->message = $request->message;

        /*
         * Вместо отправки письма возбуждаем событие
         * Mail::to($data->email)->send(new FeedbackMailer($data));
         */
        event(new FeedbackMailEvent($data));
        return redirect('question_expert')
            ->with('success', 'Ваше сообщение успешно отправлено');
    }
}
