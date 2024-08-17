<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Alternatif',
        ];
        return view('alternatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required|unique:alternatifs',
            'alternatif' => 'required',
        ];
        $pesan = [
            'kode.required' => 'Kode tidak boleh kosong',
            'kode.unique' => 'Kode sudah ada',
            'alternatif.required' => 'Alternatif tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $alternatif = new Alternatif($request->all());
            $alternatif->uuid = Str::orderedUuid();
            $alternatif->save();
            return response()->json(['success' => 'Data Alternatif Berhasil Ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternatif $alternatif)
    {
        return response()->json(['data' => $alternatif]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        $rules = [
            'alternatif' => 'required',
        ];
        $pesan = [
            'alternatif.required' => 'Alternatif tidak boleh kosong',
        ];
        $cek = Alternatif::where("kode", $request->kode)->first();
        if ($cek && $cek->kode == $request->kode) {
            $rules['kode'] = 'required';
            $pesan['kode.required'] = 'Kode tidak boleh kosong';
        } else {
            $rules['kode'] = 'required|unique:alternatifs';
            $pesan['kode.alternatif'] = 'Kode sudah ada';
            $pesan['kode.required'] = 'Kode tidak boleh kosong';
        }
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $alternatif->fill($request->all());
            $alternatif->save();
            return response()->json(['success' => 'Data Alternatif Berhasil Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        Alternatif::destroy($alternatif->id);
        // $perhitungan = Perhitungan::where('alternatif_uuid', $alternatif->uuid);
        // if ($perhitungan->first()) {
        //     $perhitungan->delete();
        // }
        return response()->json(['success' => 'Data Alternatif Berhasil Dihapus!']);
    }

    public function dataTables(Request $request)
    {
        $query = Alternatif::orderBy('kode')->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="ri-edit-2-line"></i></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class=" ri-delete-bin-6-fill"></i></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
