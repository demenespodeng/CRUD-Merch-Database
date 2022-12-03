<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use App\Models\Merch;
use App\Models\Produsen;
use App\Models\Warehouse;

class MerchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $datas = DB::table('merch')
                ->where('nama_merch', 'like', "%$katakunci%")
                ->orWhere('keyword', 'like', "%$katakunci%")
                ->paginate(5);
        } else {
            $datas = DB::select('select * from merch');
        }
        if (strlen($katakunci)) {
            $Produsen = DB::table('produsen')
                ->where('nama_produsen', 'like', "%$katakunci%")
                ->orWhere('domisili', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $Produsen = DB::select('select * from produsen');
        }
        if (strlen($katakunci)) {
            $Warehouse = DB::table('warehouse')
                ->where('id_warehouse', 'like', "%$katakunci%")
                ->orWhere('stok_merch', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $Warehouse = DB::select('select * from warehouse');
        }
        $joins = DB::table('produsen')
            ->join('merch', 'merch.id_merch', '=', 'produsen.id_merch')
            ->select('produsen.*', 'merch.nama_merch','merch.keyword')
            ->get();
        $joins2 = DB::table('warehouse')
            ->join('merch', 'merch.id_merch', '=', 'warehouse.id_merch')
            ->select('warehouse.*', 'merch.nama_merch','merch.keyword')
            ->get();
        return view('merch.index')
            ->with('datas', $datas)
            ->with('Produsen', $Produsen)
            ->with('Warehouse', $Warehouse)
            ->with('joins',$joins)
            ->with('joins2',$joins2);
    }

    public function create() {
        return view('merch.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_merch' => 'required',
            'nama_merch' => 'required',
            'keyword' => 'required',
            'harga_merch' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO merch(id_merch, nama_merch, keyword, harga_merch) VALUES (:id_merch, :nama_merch, :keyword, :harga_merch)',
        [
            'id_merch' => $request->id_merch,
            'nama_merch' => $request->nama_merch,
            'keyword' => $request->keyword,
            'harga_merch' => $request->harga_merch,
        ]
        );

        return redirect()->route('merch.index')->with('success', 'Data merch berhasil disimpan');
    }
    public function edit($id) {
        $data = DB::table('merch')->where('id_merch', $id)->first();

        return view('merch.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_merch' => 'required',
            'nama_merch' => 'required',
            'keyword' => 'required',
            'harga_merch' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE merch SET id_merch = :id_merch, nama_merch = :nama_merch, keyword = :keyword, harga_merch = :harga_merch WHERE id_merch = :id',
        [
            'id' => $id,
            'id_merch' => $request->id_merch,
            'nama_merch' => $request->nama_merch,
            'keyword' => $request->keyword,
            'harga_merch' => $request->harga_merch,
        ]
        );

        return redirect()->route('merch.index')->with('success', 'Data merch berhasil diubah');
    }
    public function delete($id) {
        DB::delete('DELETE FROM merch WHERE id_merch = :id_merch', ['id_merch' => $id]);
        return redirect()->route('merch.index')->with('success', 'Data merch berhasil dihapus');
    }

}
