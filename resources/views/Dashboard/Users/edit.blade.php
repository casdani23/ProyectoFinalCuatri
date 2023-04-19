@extends('Dashboard/Template/AdminUserView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Usuario</h3>
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

                        <form action="{{ url('Dashboard/User/'.$user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="email" class="col-sm-2 col-form-label">Correo Electronico</label>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" value="
                                    {{ $user->email }}" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="status" id="status" value="{{ $user->status }}" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="roles" class="col-sm-2 col-form-label">Rol</label>
                                <div class="form-group">
                                    <select name="roles" id="roles" class="form-select">
                                        <option value="">Seleccionar rol</option>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $rolName)
                                            @foreach($roles as $rol)
                                            <option value="{{ $rol->id }}" @if ($rolName == $rol->name) 
                                                {{'selected'}} @endif>{{ $rol->name }}</option>
                                            @endforeach
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <a href="{{ url('Dashboard/User') }}" class="btn btn-secondary">Regresar</a>
                
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection