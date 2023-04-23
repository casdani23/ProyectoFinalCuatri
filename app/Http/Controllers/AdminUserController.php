<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Mail\PermisoToken;
use App\Mail\PermisoConToken;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Traits\HasRoles;

class AdminUserController extends Controller
{

    use HasRoles;

    function __construct()
    {
         $this->middleware('permission:/Dashboard/User.index|/Dashboard/User.create|/Dashboard/User.edit|/Dashboard/User.destroy')->only('index');
         $this->middleware('permission:/Dashboard/User.create', ['only' => ['create','store']]);
         $this->middleware('permission:/Dashboard/User.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:/Dashboard/User.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:/Dashboard/User/status.status', ['only' => ['status']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $userRole = $users->roles->pluck('name','name')->all();

        return view('Dashboard/Users/index', compact('users','roles','userRole'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('Dashboard/Users/create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('rol'));
    
        return redirect('/Dashboard/User/create');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $encryption_key = env('CRYPT_KEY');
        $token = Token::where('Token_user_id', Auth::user()->id)->where('status',true)->first();
        return view('Dashboard.Tokens.Vista_Token_Admin',['token'=>Crypt::decryptString($token->token_verificacion_web, $encryption_key)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('Dashboard/Users/edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'status' => 'required',
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
    
        return redirect('/Dashboard/User');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect('/Dashboard/User');
    }

    public function status($id){
    
        $user = User::find($id);
        if($user->status == 1){
            $user->status = 0;
            $user->save();
            return redirect('/Dashboard/User');
        }else{
            $user->status = 1;
            $user->save();
            return redirect('/Dashboard/User');
        }
    }

    public function Verificar_Token_Supervisor(Request $request)
    {
        request()->validate([
            'token' => 'required',
        ]);
        $input = $request->all();

        $user_tokens = Token::where('Token_user_id', Auth::user()->id)
        ->where('status',true)->get();

        foreach ($user_tokens as $tokens) {
            if(Hash::check($input['token'], $tokens->token_web)){

                Auth::user()->givePermissionTo('/Dashboard/User/status.status');

                $trust_code = Token::find($tokens->id);
                $trust_code->status = false;
                $trust_code->save();
                Session::put('token', $tokens->token_web);
        
                return redirect('/Dashboard/User');
            }else{
                return "error";
            }
        }

        return redirect('/Dashboard/User');
    }
}
