<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    function delete($id)
    {
        # code...
        $data = Company::find($id);
        if(empty($data)){
            return redirect('admin/company');
        }
        $data->delete();
        Session()->flash('message', __('company.deletedMessage'));
        return redirect('admin/company');

    }
    function edit(Request $req)
    {
        # code...
        $data = Company::find($req->id);
        if(empty($data)){
            return redirect('admin/company');
        }
        return view('admin.addCompany',['data' => $data]);
        // return redirect('list');
    }
    function index(Request $req)
    {
        if ($req->ajax()) {
            $data = Company::select('id','name','email','logo')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/admin/company/edit/'.$row->id.'" class="btn btn-primary btn-sm">'.__('company.edit').'</a>';
                    $btn .= ' | <a href="/admin/company/delete/'.$row->id.'" class="btn btn-primary btn-sm">'.__('company.delete').'</a>';
                    return $btn;
                })
                ->addColumn('logo', function($row){
                    $img = "<img width='100px' height='100px' src='".asset('storage/'.$row->logo)."'>";
                    return $img;
                })
                ->rawColumns(['action','logo'])
                ->make(true);
        }
        # code...
       // $data = Company::all();
        // $data->withPath('/admin/users');

        return view('admin.company');
    }

    function create()
    {
        return view('admin.addCompany');
    }

    function store(Request $req) 
    {
        $id = $req->input('id');
        $sendMail = false;
        if($id){
            $validatedData = $req->validate([
                'name' => 'required',
                'email' => 'required|email'
            ]);
            $company = Company::find($id);
            Session()->flash('message', __('company.updatedMessage'));
        }else{
            $validatedData = $req->validate([
                'name' => 'required',
                'email' => 'required|email',
                'logo' => 'required',
            ]);
            $company = new Company();
            $sendMail = true;
            Session()->flash('message', __('company.createdMessage'));
        }
        
        
        $company->name = $req->input('name');
        $company->email = $req->input('email');
        $company->website = $req->input('website');
        if($req->file('logo')){
            $path = $req->file('logo')->store('company',['disk' => 'public']);
            $company->logo = $path;
        }
        
        $company->save();
        if($sendMail){
            EmailController::sendCompanyEmail($company);
        }
        return redirect('admin/company');
    }
}
