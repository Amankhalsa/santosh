<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\EnquiryExport;
use App\Exports\ProductExport;

//use App\Imports\UsersImport;

use Maatwebsite\Excel\Facades\Excel;


class ImportExportController extends Controller
{

    /**

    * @return \Illuminate\Support\Collection

    */

    public function importExportView()

    {

       return view('import');

    }

   

    /**

    * @return \Illuminate\Support\Collection

    */

    public function export() 

    {

        return Excel::download(new EnquiryExport, 'enquiries.xlsx');

    }
    
    

   

    /**

    * @return \Illuminate\Support\Collection

    */

    public function import() 

    {

        Excel::import(new UsersImport,request()->file('file'));

           

        return back();

    }

}
