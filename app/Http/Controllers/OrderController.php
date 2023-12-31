<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {


        $data = DB::table('orders')->get();
        $categories = DB::table('categories')->get();
        $menus = DB::table('menus')->get();
        return view('orders',['data'=>$data,'categories'=>$categories,'menus'=>$menus]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
        ]);


        DB::table('orders')->insert([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);
        return redirect()->back()->with(['message' => 'Orders berhasil ditambahkan','status' => 'success']);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
        ]);

        DB::table('orders')->where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);
        return redirect()->back()->with(['message' => 'Orders berhasil di Edit','status' => 'success']);
    }



    public function destroy($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->back()->with(['message' => 'Orders berhasil di Hapus','status' => 'success']);
    }
}
