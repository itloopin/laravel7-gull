<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        \LogActivity::addToLog('User index','masuk ke menu users');
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        \LogActivity::addToLog('User create','');
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        \LogActivity::addToLog('User save data');
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = '1';
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function userUpdateStatus(Request $request)
    {
        $username=$request->username;
        $oldStatus=$request->oldStatus;
        $newStatus=$request->newStatus;

        \LogActivity::addToLog('User update status',"username: $username Status from $oldStatus to $newStatus");

        DB::beginTransaction();
        try {
                $row_affected=DB::table('users')->where('username',$username)->update(
                    [
                    'status'=>$newStatus,
                    'updated_at' => date('Y-m-d H:i:s')
                    ]
                );

                DB::commit();

                if($row_affected>0){
                    return response()->json(array('status' => 1, 'message' => 'Update status berhasil'));
                }else{
                    return response()->json(array('status' => 0, 'message' => 'Update status gagal'));
                }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(array('status' => 0, 'message' => 'Update data gagal'));
        }



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
        
        \LogActivity::addToLog('User update data');

        $this->validate($request, [
            'name' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        \LogActivity::addToLog('User Delete data');
        $id=$request->userid;
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function userProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        // $user = User::where('username','=',$username);
        // return response()->json($user);
        return view('users.profile',compact('user'));
    }

    public function changePassword(Request $request)
    {

        \LogActivity::addToLog('Change password','');

        $this->validate($request, [
            'oldPassword' => ['required'],
            'newPassword' => ['required'],
            'retypeNewPassword' => ['same:newPassword'],
        ]);
     
        $hashedPassword = Auth::user()->password;
     
        if (\Hash::check($request->oldPassword , $hashedPassword )) {
     
             if (!\Hash::check($request->newPassword , $hashedPassword)) {
                $users =user::find(Auth::user()->id);
                $users->password = bcrypt($request->newPassword);
                user::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
                $message = 'Password updated successfully';
            }else{
                $message ='New password can not be the old password!';
            }
        }else{           
            $message ="Old password doesn't matched";
        }

        return response()->json([
            'message' => $message
        ]);

    }

    public function changeProfile(Request $request)
    {

        \LogActivity::addToLog('Change profile','');

        $this->validate($request, [
            'username' => ['required'],
            'name' => ['required'],
        ]);

        $username = $request->username;

        DB::beginTransaction();
        try {
                $row_affected=DB::table('users')->where('username',$username)->update(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                    ]
                );

                DB::commit();

                if($row_affected>0){
                    return response()->json([
                        'message' => "Profile updated successfully"
                    ]);
                }else{
                    return response()->json([
                        'message' => "Profile updated failed"
                    ]);
                }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Profile updated failed"
            ]);
        }

    }


    public function detlistuser()
    {
        $sql = ("SELECT * from users");
        $users = DB::select($sql);
        return  Response()->json($users);
    }

    public function userLists(Request $request)
    {
        $query = $request->get('q');
        $user = User::where('name', 'LIKE', '%' . $query . '%');
        return Datatables::of($user)
        ->addColumn('action', function ($user) {
            $buttons = '<div class="d-inline-flex">
                            <button class="btn bg-transparent _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                            </button>';
            $buttons .=     '<div class="dropdown-menu"  x-placement="bottom-start">';
            $buttons .=         '<a class="dropdown-item" href="'. route('users.edit', $user->id) .'" >
                                    <i class="nav-icon i-Pen-2 text-success font-weight-bold mr-2"></i>
                                    Edit
                                </a>';
            $buttons .=         '<a class="dropdown-item" href="javascript:;" onclick="validasidelete(\''.$user->id.'\')" >
                                    <i class="nav-icon i-Close-Window text-danger font-weight-bold mr-2"></i>
                                    Delete
                                </a>';
            $buttons .=     '</div>
                        </div>';

            return $buttons;
            })
        ->addColumn('roles', function ($user) {
            $isinya=''; 
            foreach($user->getRoleNames() as $v) {
                $isinya.= '<label class="badge badge-pill badge-success">'.$v.'</label>';
            }
            return $isinya;
        })
        ->addColumn('group_id', function ($user) {
            return '';
        })
        ->addColumn('status', function ($user) {
            if ($user->status =='1') {
                $status = ' <label class="switch pr-5 switch-primary mr-3" >
                                <span id="lblUserLock_'.$user->username.'">Active</span>
                                <input type="checkbox" class="userLock" id="userLock_'.$user->username.'" data-nama="'.$user->username.'" checked/>
                                <span class="slider"></span>
                            </label>';
            } else {
                $status = ' <label class="switch pr-5 switch-primary mr-3">
                                <span id="lblUserLock_'.$user->username.'">Locked</span>
                                <input type="checkbox" class="userLock" id="userLock_'.$user->username.'" data-nama="'.$user->username.'"/>
                                <span class="slider"></span>
                            </label>';
            }
            return $status;
        })
        ->rawColumns(['action','status','roles'])
        ->make(true);
    }


}
