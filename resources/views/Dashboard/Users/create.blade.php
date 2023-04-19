@extends('Dashboard/Template/AdminUserView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Usuarios</h3>
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

                        <form action="{{ url('Dashboard/User') }}" method="post">
                            @csrf
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" value="" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="email" class="col-sm-2 col-form-label">Correo Electronico</label>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" value="" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" value="" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="confirm-password" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirm-password" id="confirm-password" value="" required>
                                </div>
                            </div>
                
                            <div class="mb-3 row">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="status" id="status" value="
                                    {{ true }}" required hidden>
                                </div>
                            </div>
                
                            <div class="mb-3 row">
                                <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                                <div class="form-group">
                                    <select name="rol" id="rol" class="form-select">
                                        <option value="">Seleccionar rol</option>
                                        @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><br>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ url('Dashboard/User') }}" class="btn btn-secondary">Regresar</a>
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