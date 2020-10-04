<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactusEmail;
use Illuminate\Support\Facades\Mail;

class ContactusController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);
        
        $data_email['contactus'] = [
            'is_jenis' => $request->input('is_jenis'),
            'id_tracking' => $request->input('id_tracking'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'date' => date('Y-m-d H:i:s')
        ];

        $send = Mail::to(env('EMAIL_CONTATUS'))->send(new ContactusEmail($data_email));

        if($send){
            return response()->json(['status' => $send,'message' => 'KIRIM EMAIL SUKSES'], 200);
        } else {
            return response()->json(['status' => $send,'message' => 'KIRIM EMAIL GAGAL'], 200);
        }
    }
}