<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Http\Resources\FeatureResource;
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
            'features' => FeatureResource::collection($data),
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

        return Inertia::render('Feature/Show', [
            'feature' => new FeatureResource($feature),
        ]);
    }

    public function edit(Feature $feature)
    {
        return Inertia::render('Feature/Edit', [
            'feature' => new FeatureResource($feature),
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
