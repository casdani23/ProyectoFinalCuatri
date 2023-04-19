@extends('Dashboard/Template/AdminRolesView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    <form action="{{ url('Dashboard/Roles/'.$role->id) }}" method="post">
                        @method('PUT')
                        @csrf
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" required>
                            </div>
                        </div>
            
                        <div class="mb-3 row">
                            <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                            <div class="form-group">
                                @foreach($permission as $value)
                                <br>
                                <label for="permission">
                                    <input type="checkbox" name="permission[]" value="{{$value->id }}" @if (in_array($value->id, $rolePermissions) ? true : false) checked @endif>
                                    {{ $value->name }}
                                </label>    
                                <br>
                                @endforeach
                            </div>
                        </div>
                        <br><br>
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="{{ url('Dashboard/Roles') }}" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection