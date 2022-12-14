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
            $datas = DB::select('select * from merch where is_deleted=0');
        }
        // if (strlen($katakunci)) {
        //     $Produsen = DB::table('produsen')
        //         ->where('nama_produsen', 'like', "%$katakunci%")
        //         ->orWhere('domisili', 'like', "%$katakunci%")
        //         ->paginate(5);
        // } else {
        //     $Produsen = DB::select('select * from produsen');
        // }
        // if (strlen($katakunci)) {
        //     $Warehouse = DB::table('warehouse')
        //         ->where('id_warehouse', 'like', "%$katakunci%")
        //         ->orWhere('stok_merch', 'like', "%$katakunci%")
        //         ->paginate(5);
        // } else {
        //     $Warehouse = DB::select('select * from warehouse');
        // }
        $joins = DB::table('merch')
            ->join('produsen', 'merch.id_merch', '=', 'produsen.id_merch')
            ->join('warehouse','merch.id_merch','=','warehouse.id_merch')
            ->select('produsen.*', 'warehouse.*', 'merch.nama_merch','merch.keyword', 'merch.harga_merch')
            ->where('merch.is_deleted', '0')
            ->get();
        //  $register = DB::table('registrations')
        //     ->join('questions', 'registrations.registration_id', '=', 'questions.question_id')
        //     ->join('ssi_tracks','registrations.registration_id','=','ssi_tracks.registration_id')
        //     ->select('address', 'model', 'chassis', 'delivery_date','ssi_tracks.track_first_status')
        //     ->where([["questions.question_schedul", "=", $drops elected] and ['ssi_tracks.track_first_status',0]])
        //     ->get();

        return view('merch.index')
            ->with('datas', $datas)
            ->with('joins',$joins);
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

    public function softDelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE merch SET is_deleted = 1
        WHERE id_merch = :id_merch', ['id_merch' => $id]);
        return redirect()->route('merch.index')->with('success', 'Data Merch berhasil dihapus');
    }

    public function restore()
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('merch')
        ->update(['is_deleted' => 0]);
        return redirect()->route('merch.index')->with('success', 'Data Merch berhasil direstore');
    }

}
