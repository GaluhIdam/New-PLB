<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;




class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aircraft = Aircraft::orderBy('updated_at', 'ASC')->get();
        $response = [
            'message'    => 'List Data Aircraft Mutation by Time',
            'data'       => $aircraft
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Setting Validasi
        $validator = Validator::make($request->all(), [
            'operator'  => 'required',
            'reg'       => 'required',
            'type'      => 'required',
            // 'ata'       => 'required',
            // 'atd'       => 'required',
        ]);

        //Respon Error Jika Validasi mengalami error
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $aircraft = Aircraft::create($request->all());
            $response = [
                'message'   => 'Data Aircraft Mutation berhasil ditambahkan',
                'data'      => $aircraft
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal! ', //Menampilkan pesan gagal dengan pesan
                $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aircraft = Aircraft::findOrFail($id);
        $response = [
            'message'   => 'Detail Data Aircraft Mutation',
            'data'      => $aircraft
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function edit(Aircraft $aircraft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cek Data Mutation ada atau tidak
        $aircraft = Aircraft::findOrFail($id);

        //Setting Validasi
        $validator = Validator::make($request->all(), [
            'operator'  => 'required',
            'reg'       => 'required',
            'type'      => 'required',
            'activity_type' => 'required',
            // 'ata'       => 'required',
            // 'atd'       => 'required',
        ]);

        //Respon Error Jika Validasi mengalami error
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $aircraft->update($request->all());
            $response = [
                'message'   => 'Data Aircraft Mutation berhasil diperbarui',
                'data'      => $aircraft
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal! ', //Menampilkan pesan gagal dengan pesan
                $e->errorInfo
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cek Data Mutation ada atau tidak
        $aircraft = Aircraft::findOrFail($id);

        try {
            $aircraft->delete(); //Menghapus Data
            $response = [
                'message'   => 'Data Aircraft Mutation berhasil dihapus',
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal! ', //Menampilkan pesan gagal dengan pesan
                $e->errorInfo
            ]);
        }
    }
}
