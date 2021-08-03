<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Permission;
use DataTables;
use DB;

class StoreController extends Controller
{

    public function getStore(Request $request)
    {
        $value= $request->get('value');
        $sql = "SELECT * FROM sites where site_code in (SELECT site_code from user_site where username like '$value')";
        $data = DB::select($sql);
        $output='';
        // $output .='<option value="">Choose site ..</option>';
        foreach ($data as $row){
            $output .='<option value="'.$row-> site_code.'">'.$row->name.'</option>';
        }

        return  $output;
    }

}