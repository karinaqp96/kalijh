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
                html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>'
            });
        </script>
    @endif
    <!-- formulario -->
    <div class="card card-primary">
        <div class="card-header"> 
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registro de creditos
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.credito.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select class="form-control" name="cliente_id" required>
                                <option selected disabled>Seleccione una opción</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Producto</label>
                            <select class="form-control" name="credito_id" required>
                                <option selected disabled>Seleccione una opción</option>
                                @foreach($creditos as $credito)
                                    <option value="{{ $credito->id }}">{{ $credito->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Escriba una descripción" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio de compra">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad" placeholder="Escriba el precio de compra del credito" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio de venta">Estado</label>
                            <input type="text" class="form-control" name="estado" placeholder="Escriba el precio de venta del credito" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- tabla de cursos--}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de clientes
            </h3>
        </div>
        <div class="card-body">
            <table id="credito" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($creditos as $credito)
                    <tr>
                        <td>{{ $credito->id }}</td>
                        <td>{{ $credito->clientes->nombre }}</td>
                        <td>{{ $credito->producto->nombre }}</td>
                        <td>{{ Str::limit($credito->descripcion, 50) }}</td>
                        <td>{{ $credito->cantidad }}</td>
                        <td>{{ $credito->estado }}</td>
                        <td width="10px">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $credito->id }}"><i class="fas fa-edit"></i></a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.credito.destroy', $credito->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal de edición -->
                    <div class="modal fade" id="editModal{{ $credito->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $credito->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $credito->id }}Label">Editar credito</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.credito.update', $credito->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control" name="cliente_id">
                                                <option disabled>Seleccione una opción</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ $credito->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name{{ $credito->id }}">Nombre del credito</label>
                                            <input type="text" class="form-control" name="nombre" id="name{{ $credito->id }}" value="{{ $credito->nombre }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description{{ $credito->id }}">Descripción</label>
                                            <input type="text" class="form-control" name="descripcion" id="description{{ $credito->id }}" value="{{ $credito->descripcion }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio{{ $credito->id }}">Precio de compra</label>
                                            <input type="text" class="form-control" name="precio_de_compra" id="precio{{ $credito->id }}" value="{{ $credito->precio_de_venta }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio{{ $credito->id }}">Precio de venta</label>
                                            <input type="text" class="form-control" name="precio_de_venta" id="precio{{ $credito->id }}" value="{{ $credito->precio_de_compra }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $credito->id }}">Stock</label>
                                            <input type="text" class="form-control" name="stock" id="stock{{ $credito->id }}" value="{{ $credito->stock }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
