<x-app-layout>
    <!-- Scripts -->
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" /> <!-- 'classic' theme -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Atenção: </strong> {!! \Session::get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="py-12" style="padding-bottom: 0px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 15px;">
               <form action="" id="search-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nome">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf"
                                       placeholder="CPF">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control" id="rg" name="rg"
                                       placeholder="RG">
                            </div>
                        </div>
                        <div class="col-lg-12" >
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 15px;">
                <div class="col-lg-12" >
                    <div class="text-end">
                        <a href="{{ url('clients_create') }}" class="btn btn-sm btn-success">Incluir</a>
                    </div>
                </div>
                <table id="tickets-table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Dt Nascimento</th>
                        <th>RG</th>
                        <th>CPF</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });

        var oTable = $('#tickets-table').DataTable({
            dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r><'row'<'col-xs-12't>><'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            processing: true,
            serverSide: true,
            order: [[ 0, 'asc' ]],
            ajax: {
                url: '{{ url('clients_getcustomfilterdata') }}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.cpf = $('input[name=cpf]').val();
                    d.rg = $('input[name=rg]').val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'birth', name: 'birth'},
                {data: 'rg', name: 'rg'},
                {data: 'cpf', name: 'cpf'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "language": {
                "sProcessing":    "Procesando...",
                "sLengthMenu":    "Mostrar _MENU_ registros",
                "sZeroRecords":   "Nenhum registro encontrado",
                "sEmptyTable":    "Nenhum registro encontrado",
                "sInfo":          "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty":     "Mostrando 0 até 0 de 0 registro(s)",
                "sInfoFiltered":  "(Filtrados de _MAX_ registros)",
                "sInfoPostFix":   "",
                "sSearch":        "Pesquisar:",
                "sUrl":           "",
                "sInfoThousands":  ".",
                "sLoadingRecords": "Carregando...",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sLast":    "Último",
                    "sNext":    "Próximo",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    </script>
</x-app-layout>
