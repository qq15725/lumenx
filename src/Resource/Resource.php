<?php

namespace Lumenx\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * Resource constructor.
     *
     * @param array|\Illuminate\Database\Eloquent\Model $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);

        if ($resource instanceof \Illuminate\Database\Eloquent\Model) {
            $resource->loadMissing(self::getRequestIncludes());
        }
    }

    /**
     * @param mixed $resource
     *
     * @return AnonymousResourceCollection
     */
    public static function collection($resource)
    {
        if ($resource instanceof \Illuminate\Database\Eloquent\Model) {
            $resource->loadMissing(self::getRequestIncludes());
        } else if ($resource instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            if (method_exists($resource->getCollection(), 'loadMissing')) {
                $resource->getCollection()->loadMissing(self::getRequestIncludes());
            }
        }

        return new AnonymousResourceCollection($resource, get_called_class());
    }

    /**
     * @return array
     */
    public static function getRequestIncludes()
    {
        if (config('lumenx.resource.open_include')) {
            /** @var Request $request */
            $request = app('request');

            if ($request->has('include')) {
                return array_map(
                    'trim',
                    explode(',', trim($request->get('include'), ','))
                );
            }
        }

        return [];
    }
}