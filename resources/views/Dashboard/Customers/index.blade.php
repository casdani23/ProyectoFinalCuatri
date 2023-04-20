@extends('dashboard')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading" style="color: #000000">Productos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group">
                                @can('/dashboard.create')
                                <a class="btn btn-warning" href="{{ url('productos/create') }}">Nuevo Producto</a>                        
                                @endcan
                            </div>
                            <br><br>
                            <div class="btn-group">
                                <form action="" method="POST">
                                    <a href="{{ route('productos.Pedir_Permisos_Cliente') }}" class="btn btn-primary">Pedir Token</a>
                                </form>
                                <form action="{{ route('productos.CustomerToken.TokenPermiso') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-success">Validar Token</button>
                                    <input type="text" name="token" id="token" value="" style="height: 35px" required>
                                </form>
                            </div>
        
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Cantidad</th>
                                    <th style="color:#fff;">Precio</th>
                                    <th style="color:#fff;">Calzado</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Imagen</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($products as $product)
                                <tr>                           
                                    <td>{{ $product->nombre }}</td>
                                    <td>{{ $product->cantidad }}</td>
                                    <td>{{ $product->precio }}</td>
                                    <td>{{ $product->calzado }}</td>
                                    <td>{{ $product->marca }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <button type="button" class="btn btn-sm btn-success">Activa</button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-danger">Inactiva</button>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ Storage::disk('do')->url( $product->imagen) }}" alt="" class="img-fluid" width="120px">
                                    </td>
                                    <td>                                
                                        <div class="btn-group">
                                            @can('/productos/status.status')
                                                @if ($product->status == 1)
                                                <form action="{{ url('productos/status/'.$product->id) }}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                                </form>
                                                @else
                                                <form action="{{ url('productos/status/'.$product->id) }}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Activar</button>
                                                </form>
                                                @endif
                                            @endcan
                                            @can('/dashboard.edit')
                                            <a id="boton-modificar" href="{{ url('productos/'.$product->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                            @endcan
                                            
                                            @can('/dashboard.destroy')
                                                <form action="{{ url('productos/'.$product->id) }}" style="display:inline" method="post">
                                                    @method('PUT')
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro de eliminar este cliente?');">Eliminar</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection