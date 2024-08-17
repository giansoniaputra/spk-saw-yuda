<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kriteria'
        ];
        return view('kriteria.index', $data);
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
            'kode' => 'required|unique:kriterias',
            'kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ];
        $pesan = [
            'kode.required' => "Kode tidak boleh kosong",
            'kode.unique' => "Kode sudah ada",
            'kriteria.required' => "Kriteria tidak boleh kosong",
            'atribut.required' => "Atribut tidak boleh kosong",
            'bobot.required' => "Bobot tidak boleh kosong",
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'kode' => $request->kode,
                'kriteria' => $request->kriteria,
                'atribut' => $request->atribut,
                'bobot' => $request->bobot,
            ];
            Kriteria::create($data);
            return response()->json(['success' => 'Kriteria Berhasil Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria, Request $request)
    {
        $data = Kriteria::where('uuid', $request->uuid)->first();
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $rules = [
            'kriteria' => 'required',
            'bobot' => 'required',
            'atribut' => 'required',
        ];
        $pesan = [
            'kriteria.required' => "Kriteria tidak boleh kosong",
            'atribut.required' => "Atribut tidak boleh kosong",
            'bobot.required' => "Bobot tidak boleh kosong",
        ];
        $cek = Kriteria::where('uuid', $request->uuid)->first();
        if ($cek->kode == $request->kode) {
            $rules['kode'] = 'required';
            $pesan['kode.required'] = 'Kode tidak boleh kosong';
        } else {
            $rules['kode'] = 'required|unique:kriterias';
            $pesan['kode.unique'] = 'Kode sudah ada';
            $pesan['kode.required'] = 'Kode tidak boleh kosong';
        }

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'kode' => strtoupper($request->kode),
                'kriteria' => $request->kriteria,
                'atribut' => $request->atribut,
                'bobot' => $request->bobot,
            ];
            Kriteria::where('uuid', $request->uuid)->update($data);
            return response()->json(['success' => 'Kriteria Berhasil Disimpan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria, Request $request)
    {
        Kriteria::where('uuid', $request->uuid)->delete();
        SubKriteria::where('kriteria_uuid', $request->uuid)->delete();
        // $perhitungan = Perhitungan::where('kriteria_uuid', $request->uuid);
        // if ($perhitungan->first()) {
        //     $perhitungan->delete();
        // }
        return response()->json(['success' => 'Data Kriteria Berhasil Dihapus']);
    }

    public function dataTablesKriteria(Request $request)
    {
        $query = Kriteria::all();
        foreach ($query as $row) {
            $row->kode = 'C' . $row->kode;
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-success text-white sub-button" title="Sub Kriteria" data-uuid="' . $row->uuid . '" data-judul="' . $row->kriteria . '"><i class="ri-add-box-line"></i></button>
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="ri-edit-2-line"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class=" ri-delete-bin-6-fill"></i></i></button>';
            return $actionBtn;
        })->make(true);
    }

    public function dataTablesSubKriteria(Request $request)
    {
        $query = SubKriteria::where('kriteria_uuid', $request->kriteria_uuid)->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="ri-edit-2-line"></i></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class=" ri-delete-bin-6-fill"></i></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
