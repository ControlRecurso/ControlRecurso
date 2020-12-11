@extends("layouts.Menu")
@section('content')

    <br>
    <div class="container-fluid">
        <diV class="card">
            <div class="card-header">
                <h3>Listado de recursos prestados
                    <button class="btn btn-sm btn-success"
                            data-toggle="modal" data-target="#crearHistorialModal">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </h3>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-right" style="background: transparent">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recursos prestados</li>
                </ol>
            </nav>


            <form action="{{route("buscar.historial")}}" method="get">
                @csrf
                <div class="form-group float-right mr-3">
                    <div class="input-group" style="width: 400px">
                        <input placeholder="Buscar..."
                               type="search"
                               name="busqueda"
                               class="form-control">
                        <div class="input-group-prepend">
                            <button class="form-control">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            @if(session("exito"))
                <div class="alert alert-success">
                    {{session("exito")}}
                </div>
            @endif
            <hr>
            @if($historiales->count()>0)
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Numero de cuenta</th>
                            <th scope="col">Recurso</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historiales as $item=> $historial)
                            <tr>
                                <th scope="row">{{$item+$historiales->firstItem()}}</th>
                                <td>{{$historial->nombre}}</td>
                                <td>{{$historial->numero_cuenta}}</td>
                                <td>{{$historial->recurso->nombre}}</td>
                                <td>{{$historial->fecha}}</td>
                                <th>{{$historial->cantidad}}</th>
                                <td>
                                    <button class="btn btn-sm btn-success"
                                            data-toggle="modal"
                                            data-target="#editarHistorialModal"
                                            data-id="{{$historial->id}}"
                                            data-nombre="{{$historial->nombre}}"
                                            data-numero_cuenta="{{$historial->numero_cuenta}}"
                                            data-recurso_id="{{$historial->recurso->id}}"
                                            data-fecha="{{$historial->fecha}}"
                                            data-cantidad="{{$historial->cantidad}}"
                                    >
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </button>

                                    <button class="btn btn-sm btn-danger"
                                            data-toggle="modal"
                                            data-id="{{$historial->id}}"
                                            data-target="#eliminarHistorial">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-sm ">
                        {{$historiales->links()}}
                    </div>


                </div>
            @else
                <div class="alert alert-info">
                    No hay registros de prestamos hechos aun
                </div>
            @endif
        </diV>
    </div>
    <div class="modal fade" id="crearHistorialModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("create.historial")}}">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ingrese el nombre del alumno:<i class="text-danger">*</i></label>
                            <input class="form-control @error('nombre') is-invalid @endError"
                                   type="text"
                                   required
                                   name="nombre"
                                   value="{{old("nombre")}}"
                                   maxlength="192">
                            @error('nombre')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ingrese el numero de cuenta:
                                <i class="text-danger">*</i> </label>
                            <input class="form-control @error('numero_cuenta') is-invalid @endError"
                                   type="text"
                                   maxlength="11"
                                   required
                                   value="{{old("numero_cuenta")}}"
                                   name="numero_cuenta">
                            @error('numero_cuenta')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ingrese la cantidad:<i class="text-danger">*</i></label>
                            <input class="form-control @error("cantidad") is-invalid @endError"
                                   name="cantidad"
                                   min="0"
                                   type="number">
                            @error('cantidad')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fecha:<i class="text-danger">*</i> </label>
                            <input name="fecha"
                                   value="{{now()->format("Y-m-d")}}"
                                   readonly
                                   class="form-control @error('fecha') is-invalid @endError"
                                   required>
                            @error('fecha')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Seleccione el recurso a prestar:<i class="text-muted">*</i>
                            </label>
                            <select class="form-control"
                                    required
                                    name="id_recurso">
                                <option value="" disabled selected>Seleccione una opcion</option>
                                @foreach($recursos as $recurso)
                                    <option value="{{$recurso->id}}">{{$recurso->nombre}} |
                                        Cantidad: {{$recurso->cantidad}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editarHistorialModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route("update.historial")}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ingrese el nombre del alumno:<i class="text-danger">*</i></label>
                            <input class="form-control @error('nombre') is-invalid @endError"
                                   type="text"
                                   required
                                   name="nombre"
                                   id="nombre"
                                   value="{{old("nombre")}}"
                                   maxlength="192">
                            @error('nombre')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ingrese el numero de cuenta:
                                <i class="text-danger">*</i> </label>
                            <input class="form-control @error('numero_cuenta') is-invalid @endError"
                                   type="text"
                                   maxlength="11"
                                   id="numero_cuenta"
                                   required
                                   value="{{old("numero_cuenta")}}"
                                   name="numero_cuenta">
                            @error('numero_cuenta')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ingrese la cantidad:<i class="text-danger">*</i></label>
                            <input class="form-control @error("cantidad") is-invalid @endError"
                                   name="cantidad"
                                   min="0"
                                   id="cantidad"
                                   type="number">
                            @error('cantidad')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fecha:<i class="text-danger">*</i> </label>
                            <input name="fecha"
                                   value="{{now()->format("Y-m-d")}}"
                                   readonly
                                   id="fecha"
                                   class="form-control @error('fecha') is-invalid @endError"
                                   required>
                            @error('fecha')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Seleccione el recurso a prestar:<i class="text-muted">*</i>
                            </label>
                            <select class="form-control"
                                    required
                                    id="selectRecurso"
                                    name="id_recurso">
                                <option value="" disabled selected>Seleccione una opcion</option>
                                @foreach($recursos as $recurso)
                                    <option value="{{$recurso->id}}">{{$recurso->nombre}} |
                                        Cantidad: {{$recurso->cantidad}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <input id="id_historial" name="id" type="hidden" >
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade " id="eliminarHistorial" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Historial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de que deseas borrar el historial?</p>
                </div>
                <form action="{{route("destroy.historial")}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-footer">
                        <input name="id" id="id_historial" type="hidden">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection