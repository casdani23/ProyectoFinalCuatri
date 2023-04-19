@extends('Dashboard/Template/AdminRolesView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('/Dashboard/Roles.create')
                        <a class="btn btn-warning" href="{{ url('Dashboard/Roles/create') }}">Nuevo Rol</a>                        
                        @endcan
        
                        @can('/Dashboard/Roles.index')
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">                                                       
                                <th style="color:#fff;">Rol</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>  
                            <tbody>
                            @foreach ($roles as $rol)
                            <tr>                           
                                <td>{{ $rol->name }}</td>
                                <td>                                
                                    @can('/Dashboard/Roles.edit')
                                    <a href="{{ url('Dashboard/Roles/'.$rol->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                    @endcan
                                    
                                    @can('/Dashboard/Roles.destroy')
                                        <form action="{{ url('Dashboard/Roles/'.$rol->id) }}" style="display:inline" method="post">
                                            @method('PUT')
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    @endcan
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