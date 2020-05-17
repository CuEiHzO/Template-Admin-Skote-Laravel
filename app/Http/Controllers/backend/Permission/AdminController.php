<?php

namespace App\Http\Controllers\Backend\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index(Request $request)
    {

      return view('backend.permission.admin.index');
    }





    public function Datatable(){
        $sTable = \App\Models\Backend\Permission\Admin::search()->orderBy('id', 'asc');
        $sQuery = \DataTables::of($sTable);
        return $sQuery
        ->make(true);
    }
}
