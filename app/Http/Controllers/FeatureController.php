<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureStoreRequest;
use App\Http\Resources\FeatureResource;
use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Feature/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureStoreRequest $request)
    {
        $validated = $request->validated();

        $this->featureRepository->create($validated);

        return to_route('feature.index')->with('success', 'Feature created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return Inertia::render('Feature/Show', [
            'feature' => new FeatureResource($feature),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return Inertia::render('Feature/Edit', [
            'feature' => new FeatureResource($feature),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $feature->update($data);

        return to_route('feature.index')->with('success', 'Feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return to_route('feature.index')->with('success', 'Feature deleted successfully');
    }
}
