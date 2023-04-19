@extends('Dashboard/Template/AdminProductsView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Productos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('/Dashboard/Products.create')
                        <a class="btn btn-warning" href="{{ url('Dashboard/Products/create') }}">Nuevo Producto</a>                        
                        @endcan

                        @can('/Dashboard/Products.index')
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
                                    <img src="{{ asset('imagen/'.$product->imagen) }}" alt="" class="img-fluid" width="120px">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('/Dashboard/Products/status.status')
                                            @if ($product->status == 1)
                                            <form action="{{ url('/Dashboard/Products/status/'.$product->id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Desactivar</button>
                                            </form>
                                            @else
                                            <form action="{{ url('/Dashboard/Products/status/'.$product->id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-success">Activar</button>
                                            </form>
                                            @endif
                                        @endcan
                                        @can('/Dashboard/Products.edit')
                                            <a href="{{ url('Dashboard/Products/'.$product->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                        @endcan

                                        @can('/Dashboard/Products.destroy')
                                            <form action="{{ url('Dashboard/Products/'.$product->id) }}" style="display:inline" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                            </tbody>               
                        </table>
                        @endcan
                                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
@endsection