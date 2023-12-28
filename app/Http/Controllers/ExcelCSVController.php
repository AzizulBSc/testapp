<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelCSVController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return view('excel-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExcelCSV(Request $request)
    {
        $validatedData = $request->validate([

            'file' => 'required',

        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect('excel-csv-file')->with('status', 'The file has been excel/csv imported to database in laravel 9');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportExcelCSV($slug)
    {
        return Excel::download(new UsersExport, 'users.'.$slug);
    }
}
