<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }



    public function upload()
    {
        return view('products.upload');
    }

    public function import(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'attachment' => 'required|mimes:xlsx,xls,application/excel,csv',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $file = $request->file('attachment');


        Excel::import(new ProductsImport(), $file);


        return redirect()->route('products.index')->with([
            'message' => 'importing successfully',
            'alert-type' => 'success'
        ]);

    }

    public function delete()
    {
        DB::table('products')->delete();
        return redirect()->back();
    }


}
