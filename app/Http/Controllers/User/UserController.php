<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $_user;
    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function index()
    {
        // $user = User::whereNot('id',auth()->user()->id)->get();
        // dd($user);
        return view('admin.user.index',[
            'title' => 'User',
            'users' => $this->_user->all()
            // 'users' => $this->_user->whereNot('id',auth()->user()->id)->get()
        ]);
    }

    public function tes()
    {
        return $this->_user->all();
    }

    public function store(UserRequest $request)
    {
        $user = $this->_user->create($request->except('role'));
        $user->assignRole($request->role);
        if ($user) {
            return response()->json([
                'data' => $user,
                // 'reqall' => $request->all(),
                // 'reqrol' => $request->role,
                // 'onlyrole' => $request->only('role'),
                // 'exceptrole' => $request->except('role')
            ]);
        }else{
            return response()->json([
                'data' => $request->all()
            ]);
        }
    }

    public function checkEmail(Request $request)
    {
        if ($request->ajax()) {
            // $user = User::firstWhere('email', $request->email);
            $user = $this->_user->firstWhere('email', $request->email);
            if ($user) {
                return response()->json([
                    'request' => $request,
                    'message' => 'Email already registered',
                ]);
            }
            die;
        }
        abort(404);
    }
}
