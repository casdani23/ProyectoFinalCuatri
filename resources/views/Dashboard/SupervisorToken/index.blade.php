@extends('Dashboard.Template.AdminSupervisorToken')

@section('contenido')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Lista de usuarios para mandar token</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                             
                         
                        @can('/Dashboard/User.index')
                        <table class="table table-striped mt-2">
                          <thead style="background-color:#6777ef">                                     
                              <th style="display: none;">ID</th>
                              <th style="color:#fff;">Nombre</th>
                              <th style="color:#fff;">E-mail</th>
                              <th style="color:#fff;">Rol</th>
                              <th style="color: #fff">Status</th>        
                              <th style="color: #fff">Opciones</th>                                                          
                          </thead>
                          <tbody>
                            @foreach ($customers as $customer)
                              <tr>
                                <td style="display: none;">{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                  @if(!empty($customer->getRoleNames()))
                                    @foreach($customer->getRoleNames() as $rolNombre)                                       
                                        {{ $rolNombre }}
                                    @endforeach
                                  @endif
                                </td>
                                <td>
                                  @if ($customer->status == 1)
                                        <button type="button" class="btn btn-sm btn-success">Activa</button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-danger">Inactiva</button>
                                  @endif
                                </td>
                                <td>
                                  @if ($customer->status == 1)
                                    <form method="post" action="{{ url('Dashboard/SupervisorToken/Token_customer/'.$customer->id) }}">
                                      @method('PUT')
                                      @csrf
                                      <button type="submit" class="btn btn-success">Enviar Correo</button>
                                    </form>
                                  @else
                                    <form method="post" action="{{ url('Dashboard/SupervisorToken/Token_customer/'.$customer->id) }}">
                                      @method('PUT')
                                      @csrf
                                      <button type="submit" class="btn btn-success" disabled>Enviar Correo</button>
                                    </form>
                                  @endif   
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