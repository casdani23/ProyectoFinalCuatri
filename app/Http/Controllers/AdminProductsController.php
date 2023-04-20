<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class AdminProductsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:/Dashboard/Products.index|/Dashboard/Products.create|/Dashboard/Products.edit|/Dashboard/Products.destroy')->only('index');
         $this->middleware('permission:/Dashboard/Products.create', ['only' => ['create','store']]);
         $this->middleware('permission:/Dashboard/Products.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:/Dashboard/Products.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:/Dashboard/Products/status.status');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();

        return view('/Dashboard/Products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/Dashboard/Products/create');
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
        $archivo = $request->file('imagen');
        $nombre = $archivo->getClientOriginalName();
        $img = $request->file('imagen');
        $store = Storage::disk('do')->put('/imagenes/'.$nombre,file_get_contents($request->file('imagen')->getRealPath()), 'public');
        $folder = '/imagenes/'.$nombre;
        $product->imagen = $folder;

        $product->nombre = $request->nombre;
        $product->cantidad = $request->cantidad;
        $product->precio = $request->precio;
        $product->calzado = $request->calzado;
        $product->marca = $request->marca;
        $product->status = $request->status;

        $product->save();
    
        return redirect('/Dashboard/Products/create');
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
    public function edit(String $id)
    {
        $products = Products::find($id);
        
        return view('/Dashboard/Products/edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        request()->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'calzado' => 'required',
            'marca' => 'required',
        ]);
    
        $products = Products::find($id);

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."." .$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $products['imagen'] = "$imagenProducto";
        } else {
            unset($products['imagen']);
        }

        $products->update($request->all());
    
        return redirect('/Dashboard/Products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Products::find($id)->delete();
    
        return redirect('/Dashboard/Products');
    }

    public function status($id){
    
        $product = Products::find($id);
        if($product->status == 1){
            $product->status = 0;
            $product->save();
            return redirect('/Dashboard/Products');
        }else{
            $product->status = 1;
            $product->save();
            return redirect('/Dashboard/Products');
        }
    }
}
