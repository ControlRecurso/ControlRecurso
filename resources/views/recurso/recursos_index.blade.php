@extends("layouts.Menu")
@section('content')

    <br>
    <div class="container-fluid">
        <diV class="card">
            <div class="card-header">
                <h3>Listado de recursos
                    <button class="btn btn-sm btn-success"
                            data-toggle="modal" data-target="#agregarRecurso">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </h3>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-right" style="background: transparent">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recursos</li>
                </ol>
            </nav>


            <form action="{{route("buscar.recurso")}}" method="get">
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
            @if($recursos->count()>0)
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($recursos as $item=>$recurso)
                        <tr>
                            <th scope="row">{{$item+$recursos->firstItem()}}</th>
                            <td>{{$recurso->nombre}}</td>
                            <td>{{$recurso->cantidad}}</td>
                            <td>
                                <button class="btn btn-sm btn-success"
                                        data-toggle="modal"
                                        data-target="#editarRecursoModal"
                                        data-id="{{$recurso->id}}"
                                        data-nombre="{{$recurso->nombre}}"
                                        data-cantidad="{{$recurso->cantidad}}"
                                >
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger"
                                        data-id="{{$recurso->id}}"
                                        data-toggle="modal" data-target="#eliminarRecurso">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination pagination-sm">
                    {{$recursos->links()}}
                </div>
            @else
                <div class="alert alert-info">No se han agregado recursos aun.</div>
            @endif

        </diV>

    </div>
    <div class="modal fade" id="agregarRecurso" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar un recurso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route("create.recurso")}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ingrese el nombre: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control"
                                       name="nombre"
                                       required
                                       placeholder="Ingrese el nombre "
                                       type="text" maxlength="192">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ingrese la cantidad: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control"
                                       required
                                       placeholder="Ingrese la cantidad"
                                       name="cantidad"
                                       type="number"
                                       min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"

                                class="btn btn-primary"><i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cerrar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editarRecursoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar un recurso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route("update.recurso")}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ingrese el nombre: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control"
                                       name="nombre"
                                       id="nombre"
                                       required
                                       placeholder="Ingrese el nombre "
                                       type="text" maxlength="192">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ingrese la cantidad: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control"
                                       required
                                       id="cantidad"
                                       placeholder="Ingrese la cantidad"
                                       name="cantidad"
                                       type="number"
                                       min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="id_recurso"
                               name="id"
                               type="hidden">
                        <button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Actualizar
                        </button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cerrar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminarRecurso" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Recurso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro que deseas borrar el recurso?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{route("destroy.recurso")}}">
                        @csrf
                        @method("DELETE")
                        <input id="id_recurso" name="id" type="hidden">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection