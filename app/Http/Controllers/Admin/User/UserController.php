<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Blog\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index()
    {
        if (auth()->user()->roles[0]->name != "super") {
            abort(404);
        }
        return view('admin.user.index',[
            'title' => 'User',
        ]);
    }

    /* FUNGSI GET ALL USER DATATABLE*/
    public function getAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $model = User::with('roles')->get();

            return DataTables::of($model)
                    ->only(['id','name','username','email','updated_at','role','action'])
                    ->addIndexColumn()
                    ->addColumn('role',function(User $user){
                        return view('admin.user.userdt', [
                            'name' => $user->roles[0]->name
                        ]);
                    })
                    ->editColumn('updated_at', function($row){
                        $created = Carbon::parse($row->created_at)->translatedFormat('l').', '.Carbon::now('Asia/Jakarta')->parse($row->created_at)->translatedFormat('d F Y');
                        $updated = Carbon::parse($row->updated_at)->translatedFormat('l').', '.Carbon::now('Asia/Jakarta')->parse($row->updated_at)->translatedFormat('d F Y');
                        $date = "$created | $updated";
                        return $date;
                    })
                    ->editColumn('action', function($row){
                        $btn = '
                            <a href="#" data-user="'.$row->id.'" id="btnEditUser" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <a href="#" data-user="'.$row->id.'" id="btnHapusUser" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                        ';
                        return $btn;
                    })
                    ->toJson();
        }
        return abort(404);
    }

    /* FUNGSI GET USER BY */
    public function getUserById($id = null){
        if (request()->ajax()) {
            $user = User::findOrfail($id)->toArray();
            $userWithRole = User::with('roles')->find($id)->toArray();
            $userRole = strtolower($userWithRole['roles'][0]['name']);

            $data = [
                ...$user,
                'roles' => $userRole
            ];
            return response()->json([
                'data' => $data,
            ]);
        }
        abort(404);
    }

    /* FUNGSI SIMPAN USER */
    public function store(StoreUserRequest $request)
    {
        if ($request->ajax()) {
            $user = User::create($request->except('role'));
            $user->assignRole($request->role);
            if ($user) {
                return $this->sendResponse([],'created',201);
            }
        }
        abort(404);
    }

    /* FUNGSI UPDATE USER */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->ajax()) {
            if ($request->has('password') && isset($request->password)) {
                $user->syncRoles($request->role);
                $user->update([
                    ...$request->except('role'),
                    'password' => Hash::make($request->password)
                ]);
            }else{
                $user->update([
                    ...$request->except(['role']), 
                    'password' => $user->password
                ]);
                $user->syncRoles($request->role);
            }

            return $this->sendResponse([],'updated',201);
        }
        abort('404');
    }

    /* FUNGSI DELETE USER */
    public function destroy(User $user)
    {
        if (request()->ajax()) {
            foreach ($user->posts()->get() as $key => $value) {
                Storage::delete($value->thumbnail);
            }
            $deleted = $user->delete();
            if ($deleted) {
                return $this->sendResponse([],'deleted',200);
            }
        }
        abort(404);
    }

    /* FUNGSI CHECK EMAIL DAN USERNAME */
    public function checkEmailAndUsername(Request $request, $id = null)
    {
        if ($request->ajax()) {
            if ($id) {
                $userParams = $request->get('username');
                $emailParams = $request->get('email');
                $data = User::findOrfail($id);
                $dataAllUsername = User::all('username')->whereNotBetween('id', [$id])->toArray();
                $dataAllEmails = User::all('email')->whereNotBetween('id', [$id])->toArray();
                $listUsernameExists = array();
                $listEmailExists = array();

                if ($request->get('username')) {

                    foreach ($dataAllUsername as $key ) {
                        $listUsernameExists[] = $key['username'];
                    }
                    if ($userParams != $data->username) {
                        if (in_array($userParams, $listUsernameExists)) {
                            return response()->json([
                                'message' => 'Username sudah terdaftar, silahkan ganti username lainnya!',
                            ]);
                        }
                    }
                }

                if ($request->get('email')) {

                    foreach ($dataAllEmails as $key ) {
                        $listEmailExists[] = $key['email'];
                    }
                    if ($emailParams != $data->email) {
                        if (in_array($emailParams, $listEmailExists)) {
                            return response()->json([
                                'message' => 'Email sudah terdaftar, silahkan ganti username lainnya!',
                            ]);
                        }
                    }
                }

            }else {
                $emailExists = User::firstWhere('email', $request->email);
                $usernameExists = User::firstWhere('username', $request->username);
    
                if ($emailExists) {
                    return response()->json([
                        'message' => 'Email sudah terdaftar, silahkan ganti email lainnya!',
                    ]);
                }
    
                if ($usernameExists) {
                    return response()->json([
                        'message' => 'Username sudah terdaftar, silahkan ganti username lainnya!',
                    ]);
                }            
            }
            exit;
        }
        abort(404);
    }
}
