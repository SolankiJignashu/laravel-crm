@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    @if (isset($data['id']))
    <p>{{ __('employee.edit')}}</p>     
    @else
        <p>{{ __('employee.add')}}</p> 
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/admin/employee/add">
        @csrf
        <table>
            <tr>
                <td>{{ __('employee.firstName')}} :</td>
                <td><input type="text" name="firstName" required value="{{(isset($data['firstName'])) ? $data['firstName'] : ''}}"></td>
            </tr>
            <tr>
                <td>{{ __('employee.lastName')}} :</td>
                <td><input type="text" name="lastName" required value="{{(isset($data['lastName'])) ? $data['lastName'] : ''}}"></td>
            </tr>
            
            <tr>
                <td>{{ __('employee.email')}} :</td>
                <td><input type="email" name="email" required value="{{(isset($data['email'])) ? $data['email'] : ''}}"></td>
            </tr>
            
            <tr>
                <td>{{ __('employee.phone')}} :</td>
                <td><input type="text" name="phone" required value="{{(isset($data['phone'])) ? $data['phone'] : ''}}"></td>
            </tr>
            <tr>
                <td>{{ __('employee.company')}} :</td>
                <td>
                    <select name='companyId' required>

                    
                        @foreach ($companies as $item)
                            <option value="{{$item['id']}}" {{(isset($data['companyId']) && $data['companyId'] == $item['id']) ? 'selected' : ''}} >{{$item['name']}}</option>        
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <input type="submit" value="{{__('company.submit')}}">
        @if (isset($data['id']))
        <input type="hidden" name='id' value="{{$data['id']}}">
        @endif
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
