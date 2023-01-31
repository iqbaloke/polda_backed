<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CekUmur\StoreCheckUmurRequest;
use App\Http\Requests\CekUmur\UpdateCheckUmurRequest;
use App\Models\CekUmur;
use App\Models\JenisSyarat;
use Illuminate\Http\Request;

class CekUmurWebController extends Controller
{
    public function index()
    {
        $cekumur = CekUmur::get();
        $jenisSyarat = JenisSyarat::get();
        return view('cekumur.cekumur', compact('cekumur', 'jenisSyarat'));
    }
    public function edit(CekUmur $cekumur)
    {
        return view('update', compact('cekumur'));
    }
    public function store(StoreCheckUmurRequest $request)
    {
        $cekumur = CekUmur::create([
            'title' => $request->title,
            'jenis_syarat_id' => $request->jenis_syarat_id,
            'min_tahun' => $request->min_tahun,
            'max_tahun' => $request->max_tahun,
            'min_bulan' => $request->min_bulan,
            'max_bulan' => $request->max_bulan,
            'min_tanggal' => $request->min_tanggal,
            'max_tanggal' => $request->max_tanggal,
            'tahun_sekarang' => $request->tahun_sekarang,
            'bulan_sekarang' => $request->bulan_sekarang,
            'tanggal_sekarang' => $request->tanggal_sekarang,
        ]);
        return back()->with('success', 'Data CekUmur Berhasil Ditambahkan');
    }
    public function update(UpdateCheckUmurRequest $request, CekUmur $cekumur)
    {
        $cekumur->update([
            'title' => $request->title,
            'jenis_syarat_id' => $request->jenis_syarat_id,
            'min_tahun' => $request->min_tahun,
            'max_tahun' => $request->max_tahun,
            'min_bulan' => $request->min_bulan,
            'max_bulan' => $request->max_bulan,
            'min_tanggal' => $request->min_tanggal,
            'max_tanggal' => $request->max_tanggal,
            'tahun_sekarang' => $request->tahun_sekarang,
            'bulan_sekarang' => $request->bulan_sekarang,
            'tanggal_sekarang' => $request->tanggal_sekarang,
        ]);
        return redirect()
            ->route('cekumur.index')
            ->with('success', 'Data CekUmur Berhasil Diubah');
    }

    public function destroy(CekUmur $cekumur)
    {
        $cekumur->delete();
        return back()->with('success', 'Data CekUmur Berhasil Dihapus');
    }
}