<?php

namespace Lumenx\Resource;

use \Illuminate\Http\Resources\Json\AnonymousResourceCollection as ResourceCollection;
use Illuminate\Support\Arr;

class AnonymousResourceCollection extends ResourceCollection
{
    protected $hidden = [];

    /**
     * Transform the resource into a JSON array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map->toArray($request)->map(function ($item) {
            return Arr::except($item, $this->hidden);
        })->all();
    }

    /**
     * Add hidden attributes for the resource collection.
     *
     * @param $keys
     */
    public function addHidden($keys)
    {
        $this->hidden = $keys;

        return $this;
    }
}
