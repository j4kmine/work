<?php

namespace App\Http\Controllers\API;

use Validator;
use URL;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;

class UsersController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registercompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'nohp' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
            'perusahaan' => 'required',
            'npwp' => 'required',
            'role' => 'required',
            'tos' => 'required',
            'update' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 201);
        }

        $user = User::create([
            'name' => $request->name . " " . $request->nama_belakang,
            'phone' => $request->nohp,
            'email' => $request->email,
            'perusahaan' => $request->perusahaan,
            'npwp' => $request->npwp,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'code' => md5($request->nama_depan . $request->email),
            'negara' => $request->negara,
            'address' => $request->address
        ]);

        $url_aktivasi = URL::to('/') . "/api/aktivasi" . "?email=" . $request->email . "&code=" . md5($request->nama_depan . $request->email);
        if ($user) {
            $token = $user->createToken('TutsForWeb')->accessToken;

            $data_email['users'] = [
                'name' => $request->perusahaan,
                'phone' => $request->nohp,
                'email' => $request->email,
                'role' => $request->role,
                'code' => md5($request->nama_depan . $request->email),
                'url_aktivasi' => $url_aktivasi
            ];

            $send = Mail::to($request->email)->send(new RegisterEmail($data_email));

            if ($send) {
                $data_user = UserModel::where('email', '=', $request->email)->first();
                return response()->json(['token' => $token, 'status_query' => $user, 'data' => $data_user, 'status_send' => $send, 'message' => "REGISTER COMPANY SUKSES EMAIL SUKSES"], 200);
            } else {
                $data_user = UserModel::where('email', '=', $request->email)->first();
                return response()->json(['token' => $token, 'status_query' => $user, 'data' => $data_user, 'status_send' => $send, 'message' => "REGISTER COMPANY SUKSES EMAIL GAGAL"], 200);
            }
        } else {
            return response()->json(['status_query' => $user, 'message' => "REGISTER COMPANY GAGAL"], 200);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'nohp' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
            'role' => 'required',
            'tos' => 'required',
            'update' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 201);
        }

        $user = User::create([
            'name' => $request->nama_depan . " " . $request->nama_belakang,
            'phone' => $request->nohp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'code' => md5($request->nama_depan . $request->email),
            'negara' => $request->negara,
            'address' => $request->address,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $url_aktivasi = URL::to('/') . "/api/aktivasi" . "?email=" . $request->email . "&code=" . md5($request->nama_depan . $request->email);
        if ($user) {
            $token = $user->createToken('TutsForWeb')->accessToken;

            $data_email['users'] = [
                'name' => $request->nama_depan . " " . $request->nama_belakang,
                'phone' => $request->nohp,
                'email' => $request->email,
                'role' => $request->role,
                'code' => md5($request->nama_depan . $request->email),
                'url_aktivasi' => $url_aktivasi
            ];

            $send = Mail::to($request->email)->send(new RegisterEmail($data_email));

            if ($send) {
                $data_user = UserModel::where('email', '=', $request->email)->first();
                return response()->json(['token' => $token, 'status_query' => $user, 'data' => $data_user, 'status_send' => $send, 'message' => "REGISTER SUKSES EMAIL SUKSES"], 200);
            } else {
                $data_user = UserModel::where('email', '=', $request->email)->first();
                return response()->json(['token' => $token, 'status_query' => $user, 'data' => $data_user, 'status_send' => $send, 'message' => "REGISTER SUKSES EMAIL GAGAL"], 200);
            }
        } else {
            return response()->json(['status_query' => $user, 'message' => "REGISTER GAGAL"], 200);
        }
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            $data = UserModel::where('email', '=', $request->email)->first();
            return response()->json(['token' => $token, "data" => $data], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }


    public function userSelect2(Request $request)
    {

        // $this->validate($request, [
        //     'title' => 'required'

        // ]);

        $conditional = "";
        $name = $request->input('q');

        $userQuery = UserModel::where('name', 'LIKE', '%' . $name . '%')
            ->select('*', 'name as text')
            ->paginate(10);
        return response()->json([$userQuery], 200);
    }

    public function aktivasi(Request $request)
    {
        $email = $request->email;
        $code = $request->code;

        $update = [
            'status' => "1",
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $where = ['email' => $email, 'code' => $code];
        $data = UserModel::where($where)->update($update);
        if ($data) {
            $data_user = UserModel::where('email', '=', $request->email)->first();
            return response()->json(['status_query' => $data, 'data' => $data_user, 'message' => 'AKTIVASI SUKSES'], 200);
        } else {
            return response()->json(['status_query' => $data, 'message' => 'AKTIVASI GAGAL'], 201);
        }
    }
}
