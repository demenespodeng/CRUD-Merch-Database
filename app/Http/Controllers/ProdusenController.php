<?php

namespace App\Http\Controllers;

use App\Models\Produsen;
use App\Models\Merch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdusenController extends Controller
{
    public function index() {
        $datas = DB::select('select * from produsen');

        return view('merch.index')
            ->with('datas', $datas);
    }

    public function create() {
        $merch = Merch::all();
        return view('produsen.add',compact('merch'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_produsen' => 'required',
            'nama_produsen' => 'required',
            'domisili' => 'required',
            'id_merch' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO produsen(id_produsen, nama_produsen, domisili,id_merch ) VALUES (:id_produsen, :nama_produsen, :domisili, :id_merch)',
        [
            'id_produsen' => $request->id_produsen,
            'nama_produsen' => $request->nama_produsen,
            'domisili' => $request->domisili,
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

        return redirect()->route('merch.index')->with('success', 'Data produsen berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('produsen')->where('id_produsen', $id)->first();
        $merch = Merch::all();
        return view('produsen.edit')->with('data', $data,compact('merch'));
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_produsen' => 'required',
            'nama_produsen' => 'required',
            'domisili' => 'required',
            'id_merch' => 'required',

        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE produsen SET id_produsen = :id_produsen, nama_produsen = :nama_produsen, domisili = :domisili, id_merch = :id_merch WHERE id_produsen = :id',
        [
            'id' => $id,
            'id_produsen' => $request->id_produsen,
            'nama_produsen' => $request->nama_produsen,
            'domisili' => $request->domisili,
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

        return redirect()->route('merch.index')->with('success', 'Data produsen berhasil diubah');
    }

    public function delete($id_produsen) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM produsen WHERE id_produsen = :id_produsen', ['id_produsen' => $id_produsen]);

        // Menggunakan laravel eloquent
        // Ikan::where('id_produsen', $id)->delete();

        return redirect()->route('merch.index')->with('success', 'Data produsen berhasil dihapus');
    }
}