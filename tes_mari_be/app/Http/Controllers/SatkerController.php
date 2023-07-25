<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribut;
use App\Models\Rekrutmen;
use App\Models\Satker;
use Illuminate\Support\Facades\URL;

class SatkerController extends Controller
{
    /**
     * Show the profile for a given Satker.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $data = Satker::select('id', 'parent_id', 'nama', 'nama_panjang', 'order', 'gambar')
            ->orderBy('order')
            // ->limit(1)
            ->get();

        foreach ($data as $key => $value) {
            $data[$key]['id'] = (int) $value['id'];
            $data[$key]['parent_id'] = (int) $value['parent_id'];
            $data[$key]['order'] = (int) $value['order'];
            $data[$key]['gambar'] = URL::to('/') . config('var.pengadilan_gambar_path') . $value['gambar'];
        }

        $result['status'] = 200;
        $result['message'] = "Success";
        $result['data'] = $data;
        return response()->json($result);
    }

    public function show($id)
    {
        $data = Satker::find($id);
        // dd($data);
        if ($data) {
            $data['id'] = (int) $data['id'];
            $data['parent_id'] = (int) $data['parent_id'];
            $data['order'] = (int) $data['order'];
            $data['gambar'] = URL::to('/') . config('var.pengadilan_gambar_path') . $data['gambar'];
            $data['logo'] = URL::to('/') . config('var.pengadilan_logo_path') . $data['logo'];
            $data['cap'] = URL::to('/') . config('var.pengadilan_cap_path') . $data['cap'];
            $code = 200;
            $result['status'] = $code;
            $result['message'] = "Success";
        } else {
            $code = 418;
            $result['status'] = $code;
            $result['message'] = "No Result";
        }

        $result['data'] = $data;
        return response()->json($result, $code);
    }

    public function rekrutmen()
    {
        $data = Rekrutmen::select('id', 'nip', 'token')
            // ->limit(1)
            ->get();

        foreach ($data as $key => $value) {
            $data[$key]['id'] = (int) $value['id'];
            // $data[$key]['gambar'] = URL::to('/') . config('var.pegawai_foto_path') . $value['gambar'];
        }

        $result['status'] = 200;
        $result['message'] = "Success";
        $result['data'] = $data;
        return response()->json($result);
    }

    public function rekrutmenshow($nip)
    {
        $data = Rekrutmen::where('nip',$nip)->get()[0];
        // dd($data);
        if ($data) {
            $code = 200;
            $result['status'] = $code;
            $result['message'] = "Success";
        } else {
            $code = 418;
            $result['status'] = $code;
            $result['message'] = "No Result";
        }

        $result['data'] = $data;
        return response()->json($result, $code);
    }

    public function attribut()
    {
        $data = Attribut::select('id', 'nip', 'nama_lengkap','satker','alamat','foto')
        // ->limit(1)
        ->get();

        foreach ($data as $key => $value) {
            $data[$key]['id'] = (int) $value['id'];
            $data[$key]['foto'] = URL::to('/') . config('var.pegawai_foto_path') . $value['foto'];
        }

        $result['status'] = 200;
        $result['message'] = "Success";
        $result['data'] = $data;
        return response()->json($result);
    }

    public function attributshow($nip)
    {
        // $data = Attribut::find($id);
        $data = Attribut::where('nip',$nip)->get()[0];
        // dd($data);
        if ($data) {
            $data['foto'] = URL::to('/') . config('var.pegawai_foto_path') . $data['foto'];
            $code = 200;
            $result['status'] = $code;
            $result['message'] = "Success";
        } else {
            $code = 418;
            $result['status'] = $code;
            $result['message'] = "No Result";
        }

        $result['data'] = $data;
        return response()->json($result, $code);
    }
}
