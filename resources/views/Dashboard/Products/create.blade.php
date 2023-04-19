@extends('Dashboard/Template/AdminProductsView')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Producto</h3>
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

                        <form action="{{ url('Dashboard/Products') }}" method="post" enctype="multipart/form-data">
                            @csrf
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="cantidad" id="cantidad" value="" required>
                                </div>
                            </div>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="precio" id="precio" value="" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="calzado" class="col-sm-2 col-form-label">Calzado</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="calzado" id="calzado" value="" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="marca" id="marca" value="" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group text-dark">
                                    <img id="imagenSelecionada" src="#" alt="Vista previa de la imagen" style="display: none; height: 100px; width: 250px;">
                                </div>
                            </div>
                    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group text-dark">
                                    <strong>Imagen:</strong>
                                    <input type="file" id="imagen" name="imagen" class="form-control" placeholder="Imagen">
                                </div>
                            </div>
                
                
                            <div class="mb-3 row">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="status" id="status" value="
                                    {{ true }}" required hidden>
                                </div>
                            </div>
                            <br><br>
                
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ url('Dashboard/Products') }}" class="btn btn-secondary">Regresar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(e){
            $('#imagen').change(function(){
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagenSelecionada').attr('src', e.target.result);
                    $('#imagenSelecionada').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endsection