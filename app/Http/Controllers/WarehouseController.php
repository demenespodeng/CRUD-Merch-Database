<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Merch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WarehouseController extends Controller
{
    public function index() {
        $datas = DB::select('select * from warehouse');

        return view('merch.index')
            ->with('datas', $datas);
    }

    public function create() {
        $merch = Merch::all();
        return view('warehouse.add',compact('merch'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_warehouse' => 'required',
            'stok_merch' => 'required',
            'id_merch' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO warehouse(id_warehouse, stok_merch,id_merch ) VALUES (:id_warehouse, :stok_merch, :id_merch)',
        [
            'id_warehouse' => $request->id_warehouse,
            'stok_merch' => $request->stok_merch,
            'id_merch' => $request->id_merch,
            
       
        ]
        );

        // Menggunakan laravel eloquent
        // departement::create([
        //     'id_departement' => $request->id_departement,
        //     'nama_departement' => $request->nama_departement,
        //     'alamat' => $request->alamat,
        //     'no_telfon' => $request->no_telfon,
        //     'jenis_kelamin' => Hash::make($request->jenis_kelamin),
        // ]);

        return redirect()->route('merch.index')->with('success', 'Data warehouse berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('warehouse')->where('id_warehouse', $id)->first();
        $merch = Merch::all();
        return view('warehouse.edit')->with('data', $data,compact('merch'));
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_warehouse' => 'required',
            'stok_merch' => 'required',
            'id_merch' => 'required',
            

        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE warehouse SET id_warehouse = :id_warehouse, stok_merch = :stok_merch, id_merch = :id_merch WHERE id_warehouse = :id',
        [
            'id' => $id,
            'id_warehouse' => $request->id_warehouse,
            'stok_merch' => $request->stok_merch,
            'id_merch' => $request->id_merch,

        ]
        );

        // Menggunakan laravel eloquent
        // departement::where('id_departement', $id)->update([
        //     'id_departement' => $request->id_departement,
        //     'nama_departement' => $request->nama_departement,
        //     'alamat' => $request->alamat,
        //     'no_telfon' => $request->no_telfon,
        //     'jenis_kelamin' => Hash::make($request->jenis_kelamin),
        // ]);

        return redirect()->route('merch.index')->with('success', 'Data warehouse berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM warehouse WHERE id_warehouse = :id_warehouse', ['id_warehouse' => $id]);

        // Menggunakan laravel eloquent
        // Ikan::where('id_ikan', $id)->delete();

        return redirect()->route('merch.index')->with('success', 'Data warehouse berhasil dihapus');
    }
}
