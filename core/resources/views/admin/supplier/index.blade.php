@extends('admin.layout')
@section('content')

@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!!
        session()->get('message') !!}</div>
@endif
<div class="p-0 -mb-5">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
        <div class="sm:w-1/2 pr-4 pl-4">
            <h1 class="flex flex-wrap text-lg capitalize text-bold pt-3 pb-3 py-4 px-4 mb-2 m-0 text-gray-900">{{ __('Supplier') }} </h1>
        </div><!-- /.col -->
        <div class="sm:w-1/2 pr-4 pl-4">
            <ol class="flex flex-wrap list-reset sm:float-right py-4 px-4 mb-2 m-0">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="inline-block px-2 py-2 text-gray-700">{{ __('Supplier') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div
                    class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-primary card-outline">
                    <div class="flex my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <h3 class="px-4 mt-1 w-1/2">{{ __('Supplier List') }}</h3>
                        <div class="w-1/2 justify-end flex">
                            <a href="{{ route('supplier.create') }}"
                                class="inline-flex justify-center py-2 px-4 mr-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><i
                                    class="dripicons-plus"></i>
                                {{ __('Add Supplier') }}</a>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Tax Number') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $id=>$supplier)
                                    <tr>
                                        <td>
                                            {{ $id }}
                                        </td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->company_name }}</td>
                                        <td>{{ $supplier->tax_number }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phone_number }}</td>
                                        <td>{{ $supplier->address }}
                                            <blade
                                                if|(%24supplier-%3Ecity)%7B%7B%2526%252339%253B%252C%2520%2526%252339%253B.%2524supplier-%253Ecity%7D%7D%40endif%3C%2Ftd%3E>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">{{ trans('action') }}
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                    user="menu">
                                                    <li>
                                                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                                                            class="btn btn-link"><i class="dripicons-document-edit"></i>
                                                            {{ __('edit') }}</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    {{ Form::open(['route' => ['supplier.destroy', $supplier->id], 'method' => 'DELETE'] ) }}
                                                    <li>
                                                        <button type="submit" class="btn btn-link"
                                                            onclick="return confirmDelete()"><i
                                                                class="dripicons-trash"></i>
                                                            {{ __('delete') }}</button>
                                                    </li>
                                                    {{ Form::close() }}
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="importSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'supplier.import', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{ __('Import Supplier') }}
                </h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                            class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic">
                    <small>{{ __('The field labels marked with * are required input fields') }}.</small>
                </p>
                <p>{{ __('The correct column order is') }} (name*, image,
                    company_name*, tax_number, email*, phone_number*, address*, city*)
                    {{ __('and you must follow this') }}.</p>
                <p>{{ __('To display Image it must be stored in') }}
                    public/images/supplier {{ __('directory') }}</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Upload CSV File') }} *</label>
                            {{ Form::file('file', array('class' => 'form-control','required')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('Sample File') }}</label>
                            <a href="public/sample_file/sample_supplier.csv" class="btn btn-info btn-block btn-md"><i
                                    class="dripicons-download"></i> {{ __('Download') }}</a>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{{ __('submit') }}" class="btn btn-primary"
                    id="submit-button">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });

    $("ul#people").siblings('a').attr('aria-expanded', 'true');
    $("ul#people").addClass("show");
    $("ul#people #supplier-list-menu").addClass("active");

    var supplier_id = [];


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Voulez-vous vraiment supprimer?")) {
            return true;
        }
        return false;
    }

    $('#supplier-table').DataTable({
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{ __("records per page") }}',
            "info": '<small>{{ __("Showing") }} _START_ - _END_ (_TOTAL_)</small>',
            "search": '{{ __("Search") }}',
            'paginate': {
                'previous': '<i class="dripicons-chevron-left"></i>',
                'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [{
                "orderable": false,
                'targets': [0, 1, 8]
            },
            {
                'checkboxes': {
                    'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': {
            style: 'multi',
            selector: 'td:first-child'
        },
        'lengthMenu': [
            [100, 50, 25, 10],
            [100, 50, 25, 10]
        ],
        dom: '<"row"lfB>rtip',
        buttons: [{
                extend: 'pdf',
                text: '<i class="dripicons-view-list" data-toggle="popover" data-content="Enregistrer la liste en PDF." data-trigger="hover" data-original-title="{{ __("PDF") }}" />',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function (doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                            var imagehtml = doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: 'csv',
                text: '<i class="dripicons-export" data-toggle="popover" data-content="Enregistrer la liste sur Excel." data-trigger="hover" data-original-title="{{ __("CSV") }}" />',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    format: {
                        body: function (data, row, column, node) {
                            if (column === 0 && (data.indexOf('<img src=') !== -1)) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];
                            }
                            return data;
                        }
                    }
                },
            },
            {
                extend: 'print',
                text: '<i class="dripicons-print" data-toggle="popover" data-content="Imprimer la liste sur papier." data-trigger="hover" data-original-title="{{ __("Print") }}" />',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
            },
            {
                text: '<i class="dripicons-trash" data-toggle="popover" data-content="Sélectionner plusieurs lignes et les supprimer." data-trigger="hover" data-original-title="{{ __("delete") }}" />',
                className: 'buttons-delete',
                action: function (e, dt, node, config) {
                    supplier_id.length = 0;
                    $(':checkbox:checked').each(function (i) {
                        if (i) {
                            supplier_id[i - 1] = $(this).closest('tr').data('id');
                        }
                    });
                    if (supplier_id.length && confirm("Voulez-vous vraiment supprimer?")) {
                        $.ajax({
                            type: 'POST',
                            url: 'supplier/deletebyselection',
                            data: {
                                supplierIdArray: supplier_id
                            },
                            success: function (data) {
                                alert(data);
                            }
                        });
                        dt.rows({
                            page: 'current',
                            selected: true
                        }).remove().draw(false);
                    } else if (!supplier_id.length)
                        alert('No supplier is selected!');
                }
            },
            {
                extend: 'colvis',
                text: '<i class="dripicons-zoom-in"  data-toggle="popover" data-content="Modifier la visibilité des colonnes." data-trigger="hover" data-original-title="{{ __("Column visibility") }}" />',
                columns: ':gt(0)'
            },
        ],
    });

    if (all_permission.indexOf("suppliers-delete") == -1)
        $('.buttons-delete').addClass('d-none');
</script>
@endsection