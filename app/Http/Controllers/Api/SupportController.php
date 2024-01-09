<?php

namespace App\Http\Controllers\Api;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected SupportService $service)
    {

    }

    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request->filter
        );

        return SupportResource::collection($supports->items())->additional([
            'meta' => [
                'total' => $supports->total(),
                'isFirstPage' => $supports->isFirstPage(),
                'isLastPage' => $supports->isLastPage(),
                'currentPage' => $supports->currentPage(),
                'getNumberNextPage' => $supports->getNumberNextPage(),
                'getNumberPreviosPage' => $supports->getNumberPreviosPage(),
            ]
        ]);
    }

    public function store(StoreUpdateSupport $request)
    {
        $support = $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return new SupportResource($support);
    }

    public function update(StoreUpdateSupport $request, string $id)
    {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request, $id));

        if (!$support) {
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    public function show(string $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    public function destroy(string $id)
    {
        if (!$this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
