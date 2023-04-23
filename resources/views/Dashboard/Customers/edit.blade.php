@extends('dashboard')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Producto</h3>
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

                    <form action="{{ url('productos/'.$products->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $products->nombre }}" required>
                            </div>
                        </div>
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cantidad" id="cantidad" value="{{ $products->cantidad }}" required>
                            </div>
                        </div>
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="precio" id="precio" value="{{ $products->precio }}" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="calzado" class="col-sm-2 col-form-label">Calzado</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="calzado" id="calzado" value="{{ $products->calzado }}" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="marca" id="marca" value="{{ $products->marca }}" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group text-dark">
                                <img id="imagenSelecionada" src="#" alt="Vista previa de la imagen" style="display: none; height: 100px; width: 250px;">
                            </div>
                        </div>
                
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group text-dark">
                                <strong>Imagen:</strong>
                                <input type="file" id="imagen" name="imagen" class="form-control" placeholder="Imagen">
                            </div>
                        </div>

                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group text-dark">
                            <img src="{{ Storage::disk('do')->url( $products->imagen) }}" alt="" class="img-fluid" width="120px">
                            </div>
                        </div>
                        <br><br>
            
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="{{ url('/productos') }}" class="btn btn-secondary">Regresar</a>
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