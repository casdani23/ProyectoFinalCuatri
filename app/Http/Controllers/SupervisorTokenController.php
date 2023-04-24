<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Mail\PermisoToken;
use App\Mail\PermisoConToken;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class SupervisorTokenController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:/Dashboard/SupervisorToken.index')->only('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::whereHas('roles',function ($qurey){
            $qurey->where('name','=','Customer');
        })->get();


        return view('Dashboard/SupervisorToken/index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
        $encryption_key = env('CRYPT_KEY');
        $token = Token::where('Token_user_id', Auth::user()->id)->where('status',true)->first();
        return view('Dashboard.Tokens.Vista_Token_Supervisor',['token'=>Crypt::decryptString($token->token_verificacion_web, $encryption_key)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //agregar al web 1 y 2

    public function Pedir_Permisos_Supervisor(){

        $signed_url = URL::temporarySignedRoute(
        'Dashboard.SupervisorToken.Pedir_Permisos_Supervisor', now()->addMinutes(30), Auth::user()->id );

        $rolname = "";

        foreach (auth()->user()->roles as $role) {
            $rolname = $role->name;
        }

        if($rolname == 'Supervisor'){
            $mail= new PermisoToken($signed_url,auth()->user()->name,auth()->user()->email);
            Mail::to('roquerivaldo11@gmail.com')->send($mail); 

            return redirect('/Dashboard/User');
        }
    }

    public function Enviar_Correo_Token_cliente($id){


        $customer = User::find($id);

        $encryption_key = env('CRYPT_KEY');
        $codigoTokenPermisosCliente =  Str::random(20);

        $has_code = Token::where('Envio_user_id', Auth::user()->id)
        ->where('status',true)
        ->get();

        if(count($has_code)==0){
            $token = new Token();
            $token->token_web = Hash::make($codigoTokenPermisosCliente);
            $token->token_verificacion_web = Crypt::encryptString($codigoTokenPermisosCliente, $encryption_key);
            $token->Envio_user_id = Auth::user()->id;
            $token->Token_user_id = $customer->id;
            $token->status = true;
            $token->save();

            $encryption_key = env('CRYPT_KEY');
            $token = Token::where('Token_user_id', Auth::user()->id)->where('status',true)->first();
            $tokenvista = ['token'=>Crypt::decryptString($token->token_verificacion_web, $encryption_key)];

            $signed_url = URL::temporarySignedRoute(
                
                
                'Vista_Token_Customer', now()->addMinutes(30),Auth::user()->id,$tokenvista
            );



       

            $mailtoken = new PermisoConToken($signed_url,auth()->user()->name,auth()->user()->email);
            Mail::to($customer->email)->send($mailtoken);

          
            
            return redirect('Dashboard/SupervisorToken');
        }
    }

    public function Enviar_Correo_Token_supervisor($id){
        $user = User::find($id);

        $encryption_key = env('CRYPT_KEY');
        $codigoTokenPermisosSupervisor =  Str::random(20);

        $has_code = Token::where('Envio_user_id', Auth::user()->id)
        ->where('status',true)
        ->get();

        if(count($has_code)==0){
            $token = new Token();
            $token->token_web = Hash::make($codigoTokenPermisosSupervisor);
            $token->token_verificacion_web = Crypt::encryptString($codigoTokenPermisosSupervisor, $encryption_key);
            $token->Envio_user_id = Auth::user()->id;
            $token->Token_user_id = $user->id;
            $token->status = true;
            $token->save();



            $signed_url = URL::temporarySignedRoute(
                'Vista_Token_Supervisor', now()->addMinutes(30),Auth::user()->id
            );

            $mailtoken = new PermisoConToken($signed_url,auth()->user()->name,auth()->user()->email);
            Mail::to($user->email)->send($mailtoken);
            
            return redirect('Dashboard/User');
        }
    }
}
