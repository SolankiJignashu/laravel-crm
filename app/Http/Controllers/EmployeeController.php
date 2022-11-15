<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    //
    function index(Request $req)
    {
        if ($req->ajax()) {
            $companyData = [];
            $data = Employee::select('id','firstName','lastName','email','companyId')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/admin/employee/edit/'.$row->id.'" class="btn btn-primary btn-sm">'.__('employee.edit').'</a>';
                    $btn .= ' | <a href="/admin/employee/delete/'.$row->id.'" class="btn btn-primary btn-sm">'.__('employee.delete').'</a>';
                    return $btn;
                })
                ->addColumn('companyName', function($row){
                    $company = Company::find($row->companyId);
                    return $company['name'];
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        # code...
       // $data = Company::all();
        // $data->withPath('/admin/users');

        return view('admin.employee');
    }
    function create()
    {
        $companies = Company::get();
        return view('admin.addEmployee', ['companies' => $companies]);
    }
    function store(Request $req) 
    {
        $id = $req->input('id');
        if($id){
            $validatedData = $req->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email'
            ]);
            $employee = Employee::find($id);
            Session()->flash('message', __('employee.updatedMessage'));
        }else{
            $validatedData = $req->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email'
            ]);
            $employee = new Employee();
            Session()->flash('message', __('employee.createdMessage'));
        }
        
        
        $employee->firstName = $req->input('firstName');
        $employee->lastName = $req->input('lastName');
        $employee->email = $req->input('email');
        $employee->phone = $req->input('phone');
        $employee->companyId = $req->input('companyId');
        
        $employee->save();
        return redirect('admin/employee');
    }
    function edit(Request $req)
    {
        # code...
        $data = Employee::find($req->id);
        if(empty($data)){
            return redirect('admin/employee');
        }
        $companies = Company::get();
        return view('admin.addEmployee',['data' => $data,'companies' => $companies]);
        // return redirect('list');
    }
    function delete($id)
    {
        # code...
        $data = Employee::find($id);
        if(empty($data)){
            return redirect('admin/employee');
        }
        $data->delete();
        Session()->flash('message', __('employee.deletedMessage'));
        return redirect('admin/employee');

    }
}