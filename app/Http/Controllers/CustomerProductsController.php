<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Token;
use App\Mail\EnviarCorreo;
use App\Mail\PermisoToken;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerProductsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:/dashboard.idnex|/Dashboard/Customers.create|/dashboard.edit|/dashboard.destroy')->only('index');
         $this->middleware('permission:/dashboard.create', ['only' => ['create','store']]);
         $this->middleware('permission:/dashboard.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:/dashboard.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:/productos/status.status');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();

        return view('/Dashboard/Customers/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/Dashboard/Customers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'calzado' => 'required',
            'marca' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Products();

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."." .$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $product['imagen'] = "$imagenProducto";
        } else {
            unset($product['imagen']);
        }

        $product->nombre = $request->nombre;
        $product->cantidad = $request->cantidad;
        $product->precio = $request->precio;
        $product->calzado = $request->calzado;
        $product->marca = $request->marca;
        $product->status = $request->status;

        $product->save();

        return redirect('/productos/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Products::find($id);
        
        return view('/Dashboard/Customers/edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'calzado' => 'required',
            'marca' => 'required',
        ]);
    
        $product = Products::find($id);

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."." .$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $product['imagen'] = "$imagenProducto";
        } else {
            unset($product['imagen']);
        }

        $product->update($request->all());
    
        return redirect('/productos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::find($id)->delete();
    
        return redirect('/productos');
    }

    public function status($id){
    
        $product = Products::find($id);
        if($product->status == 1){
            $product->status = 0;
            $product->save();
            return redirect('/productos');
        }else{
            $product->status = 1;
            $product->save();
            return redirect('/productos');
        }
    }

    public function Pedir_Permisos_Cliente(){

        $signed_url = URL::temporarySignedRoute(
        'productos.Pedir_Permisos_Cliente', now()->addMinutes(30), Auth::user()->id );

        $rolname = "";

        foreach (auth()->user()->roles as $role) {
            $rolname = $role->name;
        }

        if($rolname == 'Customer'){
            $mail= new PermisoToken($signed_url,auth()->user()->name,auth()->user()->email);
            Mail::to('prueba08320@gmail.com')->send($mail); 

            return redirect('/productos');
        }
    }

    public function Verificar_Token_Customer(Request $request)
    {
        request()->validate([
            'token' => 'required',
        ]);
        $input = $request->all();

        $user_tokens = Token::where('Token_user_id', Auth::user()->id)
        ->where('status',true)->get();

        foreach ($user_tokens as $tokens) {
            if(Hash::check($input['token'], $tokens->token_web)){

                Auth::user()->givePermissionTo('/dashboard.edit');

                $trust_code = Token::find($tokens->id);
                $trust_code->status = false;
                $trust_code->save();
                Session::put('token', $tokens->token_web);
        
                return redirect('/productos');
            }else{
                return "error";
            }
        }

        return redirect('/productos');
    }
}
