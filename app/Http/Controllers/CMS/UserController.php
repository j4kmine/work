<?php


namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
       
        $users = UserModel::where('name', 'LIKE', '%' . $search . '%')
                     ->paginate(10);

        
        

        return view('cms.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cms.pages.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed|min:6',
            'role'=>'required'
        ]);
        
        $contact = new UserModel([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => $request->get('role'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address')
        ]);
        $data = $contact->save();
       
        return redirect('/users/create')->with('success', 'Success Input Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $data['users'] = UserModel::where($where)->first();
      
        return view('cms.pages.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      
        if( $request->password != ''){
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required|confirmed|min:6',
                'role'=>'required'
            ]);
             
            $update = ['name' => $request->name, 'email' => $request->email, 'role' => $request->role,'phone' => $request->phone,'address' => $request->address,'password' => bcrypt($request->password)];
          
        }else{
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                
                'role'=>'required'
            ]);
             
            $update = ['name' => $request->name, 'email' => $request->email, 'role' => $request->role,'phone' => $request->phone,'address' => $request->address];
            UserModel::where('id',$id)->update($update);
            $where = array('id' => $id);
          
        }
        UserModel::where('id',$id)->update($update);
        return redirect('/users/'.$id.'/edit')->with('success', 'Success Input Data');
   
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserModel::where('id',$id)->delete();
   
        return redirect('/users')->with('success', 'Deleted Successfully');
    }
    public function hapus($id)
    {
        UserModel::where('id',$id)->delete();
   
        return redirect('/users')->with('success', 'Deleted Successfully');
    }
    public function postProcess(Request $request){
        $postvalue =  $request->datacek;
 
		if($postvalue != ''){
			foreach($postvalue as $data){
                UserModel::where('id',$data)->delete();
			}
            echo "success";
		}else{
            echo "failed";
        }
	}
}

                        

                                    
                                                        
                                    
                                                        
                                    
                                                        
                                    
                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                                                    
                                                                                
                                                                                                                                                                    
                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
