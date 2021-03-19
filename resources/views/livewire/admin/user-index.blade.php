<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
        </div>

        @if ($users->count())

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>E-MAIL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td> {{$user->id}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td width="10px">
                                    <a href=" {{route('admin.users.edit', $user)}} " class="btn btn-primary text-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>

        @else
            <div class="card-body">
                <h2>No hay registros</h2>
            </div>
        @endif
</div>
