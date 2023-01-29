<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisSyarat\StoreJenisSyaratRequest;
use App\Http\Requests\JenisSyarat\UpdateJenisSyaratRequest;
use App\Models\JenisSyarat;
use Illuminate\Http\Request;

class JenisSyaratController extends Controller
{
    public function index()
    {
        $jenissyarat = JenisSyarat::latest()->paginate(10);
        return view('jenis_syarat.jenis_syarat', compact('jenissyarat'));
    }

    public function edit(JenisSyarat $jenissyarat)
    {
        return view('update', compact('jenissyarat'));
    }
    public function store(StoreJenisSyaratRequest $request)
    {
        $jenissyarat = JenisSyarat::create([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Data JenisSyarat Berhasil Ditambahkan');
    }
    public function update(
        UpdateJenisSyaratRequest $request,
        JenisSyarat $jenissyarat
    ) {
        $jenissyarat->update([
            'name' => $request->name,
        ]);
        return redirect()
            ->route('jenissyarat.index')
            ->with('success', 'Data JenisSyarat Berhasil Diubah');
    }

    public function destroy(JenisSyarat $jenissyarat)
    {
        $jenissyarat->delete();
        return back()->with('success', 'Data JenisSyarat Berhasil Dihapus');
    }
}