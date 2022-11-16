<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Descripcion</th>

    </tr>
    </thead>
    <tbody>
    @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->codigo}}</td>
            <td>{{ $categoria->nombre}}</td>
            <td>{{ $categoria->descripcion}}</td>

        </tr>
    @endforeach
    </tbody>
</table>