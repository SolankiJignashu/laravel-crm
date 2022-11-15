
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
@if (session('message'))
<div class="alert alert-success">
    <h3>{{ session('message') }}</h3>
</div>
@endif
@csrf
    <p>{{__('employee.list_of_employees')}}</p> <a href="/admin/employee/add">{{__('employee.add_new_employee')}}</a>
    <table id='employeeList'>
        <thead>
            <tr>
                <th>{{ __('employee.id')}}</th>
                <th>{{ __('employee.firstName')}}</th>
                <th>{{ __('employee.lastName')}}</th>
                <th>{{ __('employee.email')}}</th>
                <th>{{ __('employee.companyName')}}</th>
                <th>{{ __('employee.action')}}</th>
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
    var table = $('#employeeList').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employee.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'firstName', name: 'firstName'},
            {data: 'lastName', name: 'lastName'},
            {data: 'email', name: 'email'},
            {data: 'companyName', name: 'companyName'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@stop