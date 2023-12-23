<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        // if ($request->ajax()) {
        //     $data = DB::table('orders')->get();

        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function ($row) {
        //                 $btn = '<div class="d-flex">
        //                 <button type="button" title="EDIT" class="btn btn-sm btn-biru me-1" data-bs-toggle="modal"
        //                     data-bs-target="#updateData" data-id="' . $row->id . '"
        //                     data-nama="' . $row->nama . '"
        //                     data-harga="' . $row->harga . '"
        //                     data-url="' . route('orders.update', ['id' => $row->id]) . '">
        //                     <i class="bi bi-pen"></i>
        //                 </button>
        //                 <form id="deleteForm" action="' . route('orders.delete', ['id' => $row->id]) . '" method="POST">
        //                 ' . csrf_field() . '
        //                 ' . method_field('DELETE') . '
        //                     <button type="button" title="DELETE" class="btn btn-sm btn-biru btn-delete" onclick="confirmDelete(event)">
        //                         <i class="bi bi-trash"></i>
        //                     </button>
        //                 </form>
        //                 </div>';
        //                 return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        $data = DB::table('orders')->get();
        return view('orders',['data'=>$data]);
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
