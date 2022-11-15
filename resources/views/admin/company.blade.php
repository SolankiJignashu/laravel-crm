
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    <h3>{{ session('message') }}</h3>
</div>
@endif
@csrf
    <p>{{__('company.list_of_companies')}}</p> <a href="/admin/company/add">{{__('company.add_new_company')}}</a>
    <table id='companyList'>
        <thead>
            <tr>
                <th>{{ __('company.id')}}</th>
                <th>{{ __('company.name')}}</th>
                <th>{{ __('company.email')}}</th>
                <th>{{ __('company.logo')}}</th>
                <th>{{ __('company.action')}}</th>
            </tr>
        </thead>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(function () {
    var table = $('#companyList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('company.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'logo', name: 'logo'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@stop