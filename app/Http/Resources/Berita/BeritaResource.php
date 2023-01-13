<?php

namespace App\Http\Resources\Berita;

use Illuminate\Http\Resources\Json\JsonResource;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => asset('/storage/'. $this->image),
            'deskripsi' => $this->deskripsi,
            'user_id' => $this->user_id,
            'date' => $this->created_at->format('d F Y'),
        ];
    }
}
