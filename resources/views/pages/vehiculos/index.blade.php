@extends('adminlte::page')

@section('title', 'Lista de vehiculos')

@section('content')

    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h3 class="card-title">
                            <strong>LISTA DE VEHICULOS</strong>
                        </h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
                        <div class="input-group input-group-sm">
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm  tipo" name="tipo">
                                    <option value="">Seleccione</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button id="filtrar" class="btn-sm btn-danger">Filtrar</button>
                            </div>
                        </div>
                    </div>
                    @include('partials.vehiculos.table_vehiculos')
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop

@section('js')
    <script>
        $(window).on('load', function() {
            let a = 'hola'
            if ('{{ $errors->any() }}') {
                $('#formCreateModal').modal('show');
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn btn-sm'
            })

            var table = $('#table_vehiculos').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('vehiculos.index') }}",
                    data: function(d) {
                        d.tipo = $('.tipo').val()
                    },
                },
                dataType: 'json',
                type: "POST",
                language: {
                    searchPlaceholder: "placa",
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'collection',
                        text: 'Opciones',
                        className: 'bg-navy',
                        buttons: [{
                                extend: 'copy',
                                className: 'btn-secondary',
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                        ]
                    },
                    {
                        extend: 'collection',
                        text: 'Exportar',
                        className: 'bg-navy',
                        buttons: [{
                                extend: 'excel',
                                className: 'btn-secondary',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn btn-secondary',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn btn-secondary',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                        ]
                    },
                    {
                        extend: 'colvis',
                        className: 'bg-maroon',
                        text: 'Visibilidad Columnas',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],

                columns: [{
                        data: 'placa',
                        name: 'placa'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'marca',
                        name: 'marca',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'b_sisa',
                        name: 'b_sisa',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            return (data == true) ? '<span class="badge bg-success">HÁBIL</span>' :
                                ' <span class="badge bg-secondary">INHÁBIL</span> ';
                        }

                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    }
                ],
            })

            $('#filtrar').click(function() {
                table.draw()
            })
        })
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
@stop
