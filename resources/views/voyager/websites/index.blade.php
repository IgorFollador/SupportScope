@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Websites')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-browser"></i> Websites
        </h1>
        @can('add',app('App\Models\Website'))
            <a href="{{ route('voyager.websites.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
            </a>
        @endcan
        <div class="row">
            <div class="col-md-12">
                @include('voyager::alerts')
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('voyager::generic.name') }}</th>
                                    <th>{{ __('voyager::generic.url') }}</th>
                                    <th>{{ __('voyager::generic.ssl') }}</th>
                                    <th>{{ __('voyager::generic.status') }}</th>
                                    <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($websites as $website)
                                    <tr>
                                        <td>{{ $website->name }}</td>
                                        <td>{{ $website->url }}</td>
                                        <td>{{ $website->ssl }}</td>
                                        <td>{{ $website->status }}</td>
                                        <td class="no-sort no-click text-right" id="bread-actions">
                                            @can('delete', $website)
                                                <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $website->id }}"
                                                     id="delete-{{ $website->id }}">
                                                    <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                                                </div>
                                            @endcan
                                            @can('edit', $website)
                                                <a href="{{ route('voyager.websites.edit', $website->id) }}"
                                                   class="btn btn-sm btn-primary pull-right edit">
                                                    <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                                                </a>
                                            @endcan
                                            @can('read', $website)
                                                <a href="{{ route('voyager.websites.show', $website->id) }}"
                                                   class="btn btn-sm btn-warning pull-right view">
                                                    <i class="voyager-eye"></i> {{ __('voyager::generic.view') }}
                                                </a>
                                            @endcan
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
@stop

@section('javascript')
    <script>
        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];
            $('#delete_modal').modal('show');
            deleteFormAction = form.action = '{{ route('voyager.websites.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
        });
        $('#delete_confirm').on('click', function () {
            $('#delete_form').submit();
        });
    </script>
@stop
