<div class="mt-3">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            })
        </script>
    @endif
    <!-- formulario -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registrar Cliente
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre y Apellido</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Escriba el nombre"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" name="direccion"
                                placeholder="Escriba una direccion" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="number" class="form-control" name="celular" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- tabla de cursos --}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de categorias
            </h3>
        </div>
        <div class="card-body">
            <table id="clientes" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Celular</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->celular }}</td>
                            <td width="10px">
                                <a href="" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $cliente->id }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.cliente.destroy', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $cliente->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModal{{ $cliente->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $cliente->id }}Label">Editar
                                            cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.cliente.update', $cliente->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Campos del formulario de edición -->
                                            <div class="form-group">
                                                <label for="nombre{{ $cliente->id }}">Nombre</label>
                                                <input type="text" class="form-control" name="nombre"
                                                    id="nombre{{ $cliente->id }}" value="{{ $cliente->nombre }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion{{ $cliente->id }}">Direccion</label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="direccion{{ $cliente->id }}"
                                                    value="{{ $cliente->direccion }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="celular{{ $cliente->id }}">Celular</label>
                                                <input type="celular" class="form-control" name="celular"
                                                    id="celular{{ $cliente->id }}" value="{{ $cliente->celular }}">
                                            </div>
                                            <!-- Otros campos del formulario -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
