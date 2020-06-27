<?php


namespace App\Http\Controllers\Frontend;
use App\Models\BlogModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function login()
    {
        if (Auth::user()) { 
            return redirect('/');
        }else{
            return view('frontend.pages.user.login', ['page' => 'user']);
        }
    }
    public function loginuser(Request $request){
       
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password,'status'=>1]) )
        {     
             session()->put('email',$request->email);
             session()->put('role',3);
             session()->put('isloggedin',true);
             return redirect("/");
        }else{
            return redirect()->back()->withErrors(['errors', 'Please Check Your Input']);
        }
    }
    public function register()
    {
        return view('frontend.pages.user.register',['page' => 'user']);
    }
    public function activate(Request $request){
        $code =$request->input('code');
        if($code == ""){
            return redirect('/notfound');
        }
        $update = [
            'status' => 1
        ];
   
        $update = UserModel::where('code',$code)->update($update);
    
        if($update == 1){
            return redirect('/userlogin')->with('success', 'Success Validating Email');
        }else{
            return redirect('/notfound');
        }
       
    }
    public function registeruser(Request $request){
        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'email' => 'unique:users'
        ]);
        $code = rand();
   
        $user = UserModel::create([
            'name' => $request->nama_depan." ".$request->nama_belakang,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'perusahaan' => $request->nama_perusahaan,
            'negara' => $request->negara,
            'status'=>0,
            'code'=>$code,
            'role' => 3
        ]);
        $text             = 'Hello Mail';
        $mail             = new PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->AuthType = 'LOGIN';
        $mail->SMTPAuth   = true;
        $mail->Host       = env('MAIL_HOST');
        $mail->Port       = env('MAIL_PORT');
        $mail->IsHTML(true);
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SetFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->Subject = "Email Validation";
        $mail->Body    =   view('frontend.pages.email.register',['code' => $code]);
        $mail->AddAddress(trim($request->email));
        $send= $mail->Send();
   

        return redirect('/userregister')->with('success', 'Success Register Please Check Your Email Or Spam Folder To Validate');
 
    }
    public function forgotpassword()
    {
        return view('frontend.pages.user.forgotpassword',['page' => 'user']);
    }
    public function resetpassword()
    {
        return view('frontend.pages.user.resetpassword',['page' => 'user']);
    }
}