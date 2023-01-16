<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Galeri\StoreGaleriRequest;
use App\Http\Requests\Galeri\UpdateGaleriRequest;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(10);
        return view('welcome', compact('galeri'));
    }
    public function show(Galeri $galeri)
    {
        // return response()->success(true, new GaleriResource($galeri));
    }
    public function edit(Galeri $galeri)
    {
        return view('update', compact('galeri'));
    }
    public function store(StoreGaleriRequest $request)
    {
        $file = $request->file('image');
        $fileUrl = Storage::disk('public')->putFile('galeri', $file);
        $galeri = Galeri::create([
            'title' => $request->title,
            'image' => $fileUrl,
            'type' => $request->type == 1 ? 'video' : 'image',
            'link' => $request->link,
            'deskripsi' => $request->deskripsi,
        ]);
        return back()->with('success', 'Data Galeri Berhasil Ditambahkan');
    }
    public function update(UpdateGaleriRequest $request, Galeri $galeri)
    {
        if ($request->file('image')) {
            Storage::disk('public')->delete('galeri', $galeri->image);

            $image = $request->file('image');
            $imageUrl = Storage::disk('public')->putFile('galeri', $image);
        } else {
            $imageUrl = $galeri->image;
        }
        $galeri->update([
            'title' => $request->title,
            'image' => $imageUrl,
            'type' => $request->type == 1 ? 'video' : 'image',
            'link' => $request->link,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()
            ->route('galeri.index')
            ->with('success', 'Data Galeri Berhasil Diubah');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete('galeri', $galeri->image);
        $galeri->delete();
        return back()->with('success', 'Data Galeri Berhasil Dihapus');
    }
}