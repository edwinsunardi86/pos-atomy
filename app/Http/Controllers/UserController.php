<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')->select('username','email','fullname','role',DB::Raw('users.id AS user_id'));
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<a href="/users/' . $row->username . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                <a href="users/edit_user/' . $row->username . '" class="edit btn btn-secondary btn-sm"><i class="fas fa-user-edit"></i> Edit</a>
                <a href="users/access/' . $row->user_id . '" class="edit btn bg-purple btn-sm"><i class="fas fa-universal-access"></i> Access</a>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        return view('setting.user.index', [
            'active_gm' => 'Setting',
            'active_m'  => 'users',
            'title'     => 'Daftar User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_user()
    {
        return view('setting.user.create_user', [
            'active_gm' => 'Setting',
            'active_m' =>   'users',
            'title'     => 'Input User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_user(Request $request)
    {
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'password' => bcrypt('12345'),
            'role' => $request->role,
            'client_id' => $request->client_id
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:50|unique:users',
            'email'    => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $email = $errors->first('email');
            $username = $errors->first('username');
            $confirmation = ['username' => $username, 'email' => $email, 'icon' => 'error'];
        } else {
            DB::table('users')->insert($data);
            $confirmation = ['message' => 'Data user sukses ditambahkan', 'icon' => 'success', 'redirect' => '/users'];
        }
        return response()->json($confirmation);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function detail_user($username)
    {
        $data_user = User::Where(['username' => $username])->first();
        return view('setting.user.show', [
            'user' => $data_user,
            'active_gm' => 'Setting',
            'active_m' =>   'users',
            'title'     => 'View User'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit_user($username)
    {
        $data_user = User::Where(['username' => $username])->first();
        return view('setting.user.edit_user', [
            'user' => $data_user,
            'active_gm' => 'Setting',
            'active_m' =>   'users',
            'title'     => 'Edit User'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request)
    {
        $user = new User;

        $check_valid = $user->whereNotIn('username',[$request->username])->where('email',$request->email)->count();
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'role' => $request->role,
            'client_id' => $request->client_id
        ];
        $rules = [];
        if($check_valid > 0){
            $rules['email'] = 'required|email|unique:users';
        }
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            $errors = $validate->errors();
            $email = $errors->first('email');
            $confirmation = ['email' => $email, 'icon' => 'error'];
        } else {
            User::where('username', $request->username)->update($data);
            $confirmation = ['message' => 'Data user sukses diupdate', 'icon' => 'success', 'redirect' => '/users'];
        }
        return response()->json($confirmation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function usersAccess($id){
        $menuParent = DB::table('menu')->where('menu_parent_id',0)->get();
        $menu = DB::table('menu')->select('menu.menu_parent_id','menu.id','menu.nama_menu')->where('menu.menu_parent_id','<>',0)->get();
        $access_menu = DB::table('usersprivilege')->select('menu_id','menu.menu_parent_id','create','update','delete')->where('user_id',$id)->join('menu','menu.id','=','usersprivilege.menu_id')->get();
        $role_user = DB::table('users')->select('id','username','fullname','email','role')->where('users.id',$id)->first();
        
        $menu_array = array();
        $menu_parent_id = [];
        foreach($access_menu as $row){
            array_push($menu_array,array( 'menu_id'=> $row->menu_id,'create'=> $row->create, 'update' => $row->update, 'delete'=>$row->delete));
        }
        
        $user_data_access = DB::table('usersdataaccess')->select('branch_id','company_id')->where('user_id',$id)->get();
        $arrayData = array_map(function($item){
                return (array)$item->branch_id;
            },$user_data_access->toArray());
        $arr_data = [];
        foreach($user_data_access as $row){
            array_push($arr_data,$row->branch_id);
        }
        $imp_user_data_access = implode(",",$arr_data);
        $user = DB::table('users')->select('id','username','fullname','email')->where('users.id',$id)->first();
        return view('setting.user.user_access', [
            'user'                          => $user,
            'access_menu_parent'            => $menuParent,
            'access_menu'                   => $menu,
            'menu_array'                    => $menu_array,
            'menu_parent_id'                => $menu_parent_id,
            'role'                          => $role_user,
            'user_data_access'              => $imp_user_data_access,
            'active_gm'                     => 'Setting',
            'active_m'                      => 'users',
            'title'                         => 'User Access'
        ]);
    }

    public function getUserCompanyBranches($userId){
        $user_data_access = DB::table('usersdataaccess')->select('branch_id','branch_name','company.company_id','company_name')
        ->join('company', 'usersdataaccess.company_id','=','company.company_id')
        ->join('branch','usersdataaccess.branch_id','=','branch.id')
        ->where('user_id',$userId)->get();
        return response()->json($user_data_access);
    }

    public function setUserAccessPrevilage(Request $request){
        $getPrivilegeUserId = DB::table('users')->where('users.id',$request->user_id)->join('usersprivilege','users.id','=','usersprivilege.user_id')->get();
        if($getPrivilegeUserId->count() > 0){
            DB::table('usersprivilege')->where('user_id',$request->user_id)->delete();
        }
        $getUserId = DB::table('users');
        for($i = 0;$i < count($request->menu); $i++){
            DB::table('usersprivilege')->insert([
                'user_id' => $request->user_id,
                'menu_id' => $request->menu[$i]['menu_id'],
                'create' => $request->menu[$i]['create'],
                'update' => $request->menu[$i]['update'],
                'delete' => $request->menu[$i]['delete'],
            ]);
        }
        if($getUserId){
            $confirmation = ['title'=>'Warning!','message' => 'Perubahan akses privilege user berhasil!', 'icon' => 'success', 'redirect' => '/users'];
        }else{
            $confirmation = ['title'=>'Warning!','message' => 'Perubahan akses privilege user gagal! Kemungkinan user tersebut sudah di blok atau dihapus dari backend!', 'icon' => 'error','error'=>1 ];
        }
        return $confirmation;
    }

    public function setDataAccess(Request $request){
        $jsonDecodeFinalData = json_decode($request->finalData, true);
        DB::table('usersdataaccess')->where('user_id',$request->id)->delete();
        foreach($jsonDecodeFinalData as $parent){
            // echo $parent['company_id'];
            $branches = $parent['branches'];
            foreach($branches as $child){
                $post = array(
                    'user_id' => $request->id,
                    'company_id' => $parent['company_id'],
                    'branch_id' => $child
                );
                DB::table('usersdataaccess')->insert($post);
            }
        }
        $confirmation = ['title'=>'Warning!','message' => 'Data Access saved', 'icon' => 'success','redirect' =>"/users/access/".$request->user_id];
        return $confirmation;
    }


    function viewChangePassword(){
        return view('users.change_password',[
            'active_gm'=> 'User',
            'active_m'=> '/change_password',
            'title'=> 'Change Password',
        ]);
    }
    
    function changeSelfPassword(Request $request){
        $user_id = Auth::user()->id;
        $password = $request->password;
        User::where('id',$user_id)->update(['password'=>bcrypt($password)]);
        $confirmation = ['message' => 'Password has been changed', 'icon' => 'success', 'redirect' => '/send_email'];
        $request->session()->flash('change', 'Password has been changed');
        return redirect('/dashboard_v1');
    }

    function setUserAccessAuthority(Request $request){
        $branch = $request->branch;
        $get_authority = DB::table('usersauthority')->where('user_id',$request->user_id)->get();
        $get_username = DB::table('users')->where('id',$request->user_id)->first();
        if($get_authority->count() > 0){
            DB::table('usersauthority')->where('user_id',$request->user_id)->delete();
        }
        for($i = 0;$i < count($branch);$i++){
            $post = array(
                'user_id'=>$request->user_id,
                'location_id'=>$request->branch[$i],
                'created_by'=>Auth::id()
            );
            DB::table('usersauthority')->insert($post);
            $check_location_master = DB::table("setup_location")->where('id',$request->branch[$i])->get();
            if($check_location_master->count() == 0){
                $post = array(
                    'id'=>$request->branch[$i],
                    'location_name'=>$request->location_name[$i]
                );
                DB::table('setup_location')->insert($post);
            }
        }
        $confirmation = ['title'=>'Warning!','message' => 'User authority with name '.$get_username->fullname.' successfully created', 'icon' => 'success','redirect' =>"/users/access/".$request->user_id];
        return response()->json($confirmation);
    }

    function getUserAccessAuthority(){
        $query = DB::table('usersauthority')->
        join('setup_location','setup_location.id','=','usersauthority.location_id')->
        join('setup_region','setup_region.id','=','setup_location.region_id')->
        join('setup_project','setup_project.project_code','=','setup_region.project_code')->
        join('header_template','header_template.location_id','=','setup_location.id')->
        join('template_area','template_area.id_header','=','header_template.id')->
        join('template_sub_area','template_sub_area.id_area','=','template_area.id')->
        join('m_service','m_service.service_code','=','template_area.service_code')->select('setup_project.project_code','project_name',DB::Raw('setup_region.id AS region_id'),'setup_region.region_name',DB::Raw('setup_location.id AS location_id'),'location_name',DB::Raw('template_area.id AS area_id'),'area_name',DB::Raw('template_sub_area.id AS sub_area_id'),'sub_area_name','m_service.service_code','service_name')->where('usersauthority.user_id',Auth::id())->get();
        return response()->json($query);
    }

    public function getUserAuthorityLocationToSelectedByRegion(Request $request){
        $db = DB::table('setup_location')->
        join('usersauthority','usersauthority.location_id','=','setup_location.id')->
        join('setup_region','setup_location.region_id','=','setup_region.id')->
        select('setup_location.id','setup_location.location_name','setup_location.address',DB::Raw('setup_location.description AS location_description,setup_region.description AS region_description','usersauthority.location_id'))->where('usersauthority.user_id',$request->user_id);
        // var_dump($db);
        if($request->location_id != ""){
            $db = $db->where('setup_location.id',$request->location_id)->get();
        }else{
            $db = $db->where('setup_region.id',$request->region_id)->get();
        }
        // var_dump($db);
        return response()->json($db);
    }

    public function forgotPassword(Request $request){
        $check_valid_email = DB::table('users')->where('email',$request->email)->get();
        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if($check_valid_email->count() > 0){
                $random_str = $this->generateRandomString(50);
                $post = array('remember_token'=>$random_str);
                DB::table('users')->where('email',$request->email)->update($post);
                $details = ['title'=>"Forgot Password", 'encrypt'=>$random_str];
                Mail::to($request->email)->send(new  \App\Mail\EmailForgetPassword($details));
                $message = "Check your email";
                $icon = "success";
            }else{
                $message = "Email not listed in App";
                $icon = "error";
            }
        }else{
            $message = "Email not valid";
            $icon = "error";
        }
        $confirmation = ['message' => $message,'icon' => $icon, 'redirect' => '/'];
        return response()->json($confirmation);
    }   

    function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function SessionForgetToPasswordchangePassword($token){
        return view('setting.user.forget_password_to_change_password',[
            'active_gm' => 'User',
            'active_m'  => '/change_password',
            'title'     => 'Change Password',
            'token_user'     =>  $token
        ]);
    }

    function changePasswordByToken(Request $request){
        $checkValidToken = DB::table('users')->where('remember_token',$request->token)->first();
        if($checkValidToken){
            $update = DB::table('users')->where('remember_token',$request->token)->update(['password'=>bcrypt($request->password)]);
            if($update){
                $confirmation = ['message' => 'Update your password success','icon' => 'success', 'redirect' => '/'];
            }else{
                $confirmation = ['message' => 'Update your password failed','icon' => 'error', 'redirect' => '/'];
            }
        }else{
            $confirmation = ['message' => 'Update your password failed','icon' => 'error', 'redirect' => '/'];
        }
        return response()->json($confirmation);
    }
}
