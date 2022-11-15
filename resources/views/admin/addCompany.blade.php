@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    @if (isset($data['id']))
    <p>{{ __('company.edit')}}</p>     
    @else
        <p>{{ __('company.add')}}</p> 
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
    <form method="POST" action="/admin/company/add" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>{{ __('company.name')}} :</td>
                <td><input type="text" name="name" required value="{{(isset($data['name'])) ? $data['name'] : ''}}"></td>
            </tr>
            <tr>
                <td>{{ __('company.email')}} :</td>
                <td><input type="text" name="email" required value="{{(isset($data['email'])) ? $data['email'] : ''}}"></td>
            </tr>
            <tr>
                <td>{{ __('company.logo')}} :</td>
                <td><input type="file" name="logo" {{(!isset($data['id'])) ? 'required' : ''}} >
                @if (isset($data['logo']))
                    <img width='100px' height='100px' src='{{asset('storage/'.$data['logo'])}}'>
                @endif
                </td>
            </tr>
            <tr>
                <td>{{ __('company.website')}} :</td>
                <td><input type="text" name="website"  value="{{(isset($data['website'])) ? $data['website'] : ''}}"></td>
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
