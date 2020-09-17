<?php
 
namespace App\Http\Controllers\API;
 
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
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
        $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'nohp' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'perusahaan' => 'required',
            'npwp' => 'required',
            'c_password' => 'required|same:password' ,
            'tos' => 'required',
            'update' => 'required',
        ]);
 
        $user = User::create([
            'name' => $request->name." ".$request->nama_belakang,
            'phone' => $request->nohp,
            'email' => $request->email,
            'perusahaan' => $request->perusahaan,
            'password' => bcrypt($request->password),
            'role' => 3
        ]);
 
        $token = $user->createToken('TutsForWeb')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    public function register(Request $request)
    {
        $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'nohp' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password' ,
            'tos' => 'required',
            'update' => 'required',
        ]);
 
        $user = User::create([
            'name' => $request->name." ".$request->nama_belakang,
            'phone' => $request->nohp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 3
        ]);
 
        $token = $user->createToken('TutsForWeb')->accessToken;
 
        return response()->json(['token' => $token], 200);
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
            return response()->json(['token' => $token], 200);
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
}
