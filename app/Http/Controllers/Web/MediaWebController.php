<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreMediaRequest;
use App\Http\Requests\Media\UpdateMediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaWebController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(10);
        return view('media.media', compact('media'));
    }

    public function edit(Media $media)
    {
        return view('update', compact('media'));
    }
    public function store(StoreMediaRequest $request)
    {
        $file = $request->file('image');
        $fileUrl = Storage::disk('public')->putFile('Media', $file);
        $media = Media::create([
            'title' => $request->title,
            'image' => $fileUrl,
            'link' => $request->link,
            'color' => $request->color,
        ]);
        return back()->with('success', 'Data Media Berhasil Ditambahkan');
    }
    public function update(UpdateMediaRequest $request, Media $media)
    {
        if ($request->file('image')) {
            Storage::disk('public')->delete('Media', $media->image);

            $image = $request->file('image');
            $imageUrl = Storage::disk('public')->putFile('Media', $image);
        } else {
            $imageUrl = $media->image;
        }
        $media->update([
            'title' => $request->title,
            'image' => $imageUrl,
            'link' => $request->link,
            'color' => $request->color,
        ]);
        return redirect()
            ->route('media.index')
            ->with('success', 'Data Media Berhasil Diubah');
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete('Media', $media->image);
        $media->delete();
        return back()->with('success', 'Data Media Berhasil Dihapus');
    }
}