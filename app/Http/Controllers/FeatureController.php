<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Http\Resources\FeatureListResource;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\UserResource;
use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FeatureController extends Controller
{
    public function __construct(private FeatureRepositoryInterface $featureRepository)
    {
        
    }

    public function index()
    {
        $data = $this->featureRepository->getAll();

        return Inertia::render('Feature/Index', [
            'features' => FeatureListResource::collection($data),
        ]);
    }

    public function create()
    {
        return Inertia::render('Feature/Create');
    }

    public function store(FeatureStoreRequest $request)
    {
        $validated = $request->validated();

        $this->featureRepository->create($validated);

        return to_route('feature.index')->with('success', 'Feature created successfully');
    }

    public function show(Feature $feature)
    {
        $feature = $this->featureRepository->show($feature);
        // $resoruce = new FeatureResource($feature);
        // dd($feature,$resoruce);
        return Inertia::render('Feature/Show', [
            'feature'   => new FeatureResource($feature),
            'comments'  => Inertia::defer(function () use ($feature) {
                return $feature->comments->map(function ($comment) {
                    return [
                        'id'            => $comment->id,
                        'comment'       => $comment->comment,
                        'created_at'    => $comment->created_at->format('Y-m-d H:i:s'),
                        'user'          => new UserResource($comment->user)
                    ];
                })->values();
            })
        ]);
    }

    public function edit(Feature $feature)
    {
        return Inertia::render('Feature/Edit', [
            'feature' => new FeatureResource($feature),
            // 'comments' => Inertia::defer(function () use ($feature) {
            //     return $feature->comments->where('user_id', auth()->id())->map(function ($comment) {
            //         return [
            //             'id'            => $comment->id,
            //             'comment'       => $comment->comment,
            //             'created_at'    => $comment->created_at,
            //             'user'          => new UserResource($comment->user)
            //         ];
            //     });
            // })
        ]);
    }

    public function update(FeatureUpdateRequest $request, Feature $feature)
    {
        $validated = $request->validated();

        $this->featureRepository->update($feature, $validated);

        return to_route('feature.index')->with('success', 'Feature updated successfully');
    }

    public function destroy(Feature $feature)
    {
        $this->featureRepository->delete($feature);

        return to_route('feature.index')->with('success', 'Feature deleted successfully');
    }
}
