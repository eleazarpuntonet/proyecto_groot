@extends('layouts.mainLayout')

@section('contenido')
<div class="mainTitle">
	<h1>Usuarios</h1>
</div>

<div class="container" id="mainTableProveedores">
  <table id="tableProv" class="table">
    <thead class="thead-light">
      <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Email</th>
          <th scope="col">Usuario</th>
          <th scope="col">Contraseña</th>
          <th scope="col">Rol</th>
          <th scope="col">Edit</th>
      </tr>
    </thead>

    <tbody>
      @foreach($users as $user)
        <tr>
          <td scope="row">
            <a href="{{ route('usuarios.show',$user->id) }}">{{ $user->name }}</a>
          </td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->password }}</td>
          <td>{{ $user->role }}</td>
          <td>
        <div class="container" id="editButtons">
          <div class="button-btn">
            <button type="button" class="btn btn-light btn-sm">
              <a href="{{ route('usuarios.edit',$user->id) }}">Editar</a>
            </button>
          </div>
          <div class="button-btn">
                <form action="{{  route('usuarios.destroy',$user->id) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-light btn-sm">Eliminar
              </button>
                </form>
          </div>
        </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>


@endsection
