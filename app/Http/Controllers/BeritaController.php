<?php

namespace App\Http\Controllers;

use App\Http\Requests\Berita\StoreBeritaRequest;
use App\Http\Requests\Berita\UpdateBeritaRequest;
use App\Http\Resources\Berita\BeritaResource;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        return BeritaResource::collection($berita);
    }
    public function show(Berita $berita)
    {
        return response()->success(true, new BeritaResource($berita));
    }
    public function store(StoreBeritaRequest $request)
    {
        $file = $request->file('image');
        $fileUrl = Storage::disk('public')->putFile('Berita', $file);
        $berita = Berita::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'image' => $fileUrl,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->success(
            'Data Berita Telah Ditambahkan',
            new BeritaResource($berita)
        );
    }
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        if ($request->file('image')) {
            Storage::disk('public')->delete('Berita', $berita->image);

            $image = $request->file('image');
            $imageUrl = Storage::disk('public')->putFile('Berita', $image);
        } else {
            $imageUrl = $berita->image;
        }
        $berita->update([
            'title' => $request->title,
            'image' => $imageUrl,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->success(
            'Data Berita Telah Dirubah',
            new BeritaResource($berita)
        );
    }

    public function destroy(Berita $berita)
    {
        $old = $berita;
        $berita->delete();
        return response()->success(
            'Data Berita Telah Dihapus',
            new BeritaResource($old)
        );
    }
}
