<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'sub_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ];
        $pesan = [
            'sub_kriteria.required' => 'Sub Kriseria Tidak Boleh Kosong',
            'atribut.required' => 'Atribut Tidak Boleh Kosong',
            'bobot.required' => 'Bobot Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'kriteria_uuid' => $request->kriteria_uuid,
                'sub_kriteria' => $request->sub_kriteria,
                'atribut' => $request->atribut,
                'bobot' => $request->bobot,
            ];
            SubKriteria::create($data);
            return response()->json(['success' => "Sub Kategori berhasil di tanbahkan"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubKriteria $subKriteria, Request $request)
    {
        $query = SubKriteria::where('uuid', $request->uuid)->first();
        return response()->json(['data' => $query]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        $rules = [
            'sub_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ];
        $pesan = [
            'sub_kriteria.required' => 'Sub Kriseria Tidak Boleh Kosong',
            'atribut.required' => 'Atribut Tidak Boleh Kosong',
            'bobot.required' => 'Bobot Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'sub_kriteria' => $request->sub_kriteria,
                'atribut' => $request->atribut,
                'bobot' => $request->bobot,
            ];
            SubKriteria::where('uuid', $request->current_uuid)->update($data);
            return response()->json(['success' => "Sub Kategori berhasil di tanbahkan"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SubKriteria $subKriteria)
    {
        SubKriteria::where('uuid', $request->uuid)->delete();
        return response()->json(['success' => "Data Berhaswi Di hapus"]);
    }
}
