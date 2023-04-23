@extends('Dashboard/Template/AdminUserView')

@section('contenido')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Usuarios</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                        @can('/Dashboard/User.create')
                          <a class="btn btn-warning" href="{{ url('Dashboard/User/create') }}">Nuevo Usuario</a>  
                        @endcan
                        
                        @can('/dashboard.index')
                          <div class="btn-group">
                            <form action="" method="POST">
                                <a href="{{ route('Dashboard.SupervisorToken.Pedir_Permisos_Supervisor') }}" class="btn btn-primary">Pedir Token</a>
                            </form>
                            <form action="{{ route('Dashboard.User.SupervisorToken.TokenPermiso') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success">Validar Token</button>
                                <input type="text" name="token" id="token" value="" style="height: 35px" required>
                            </form>
                          </div>
                        @endcan
                         
                        @can('/Dashboard/User.index')
                        <table class="table table-striped mt-2">
                          <thead style="background-color:#6777ef">                                     
                              <th style="display: none;">ID</th>
                              <th style="color:#fff;">Nombre</th>
                              <th style="color:#fff;">E-mail</th>
                              <th style="color:#fff;">Rol</th>
                              <th style="color: #fff">Status</th>
                              <th style="color:#fff;">Acciones</th>                                                                   
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                              <tr>
                                <td style="display: none;">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $rolNombre)                                       
                                        {{ $rolNombre }}
                                    @endforeach
                                  @endif
                                </td>
                                <td>
                                  @if ($user->status == 1)
                                        <button type="button" class="btn btn-sm btn-success">Activa</button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-danger">Inactiva</button>
                                  @endif
                                </td>
                                <td>
                                  <div class="btn-group">
                                    @can('/Dashboard/User/status.status')
                                      @if ($user->status == 1)
                                      <form action="{{ url('Dashboard/User/status/'.$user->id) }}" method="post">
                                          @method('PUT')
                                          @csrf
                                          <button type="submit" class="btn btn-danger">Desactivar</button>
                                      </form>
                                      @else
                                      <form action="{{ url('Dashboard/User/status/'.$user->id) }}" method="post">
                                          @method('PUT')
                                          @csrf
                                          <button type="submit" class="btn btn-success">Activar</button>
                                      </form>
                                      @endif
                                    @endcan                                  
                                    @can('/Dashboard/User.edit')
                                      <a href="{{ url('Dashboard/User/'.$user->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                    @endcan
                                    @can('/Dashboard/User.destroy')

                                      @foreach($roles as $rol)
                                    @if($rol->name == 'Admin')
                                        <button  type="submit" class="btn btn-danger disabled" >Eliminar</button>

                                            @else
                                            <form action="{{ url('Dashboard/User/'.$user->id) }}" style="display:inline" method="post">
                                        @method('PUT')
                                        @method('DELETE')
                                        @csrf

                                      
                                        <button  type="submit" class="btn btn-danger"  >Eliminar</button>
                                      </form>

                                        @endif
                                        @endforeach



                                      <!-- @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $rolName)
                                            @foreach($roles as $rol)
                                            <option value="{{ $rol->id }}" @if ($rolName == $rol->name) 
                                                {{'selected'}} @endif>{{ $rol->name }}</option>
                                            @endforeach
                                            @endforeach
                                        @endif -->




                                    @endcan
                                    @can('/Dashboard/Roles.index')
                                      @if ($user->status == 1)
                                      <form method="post" action="{{ url('Dashboard/SupervisorToken/Token_supervisor/'.$user->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-success">Enviar Correo</button>
                                      </form>
                                      @else
                                      <form method="post" action="{{ url('Dashboard/SupervisorToken/Token_supervisor/'.$user->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-success" disabled>Enviar Correo</button>
                                      </form>
                                      @endif 
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