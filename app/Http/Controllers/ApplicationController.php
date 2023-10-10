<?php

namespace App\Http\Controllers;

use App\Enums\StatusesEnum;
use App\Http\Requests\Applications\StoreRequest;
use App\Http\Requests\Applications\UpdateRequest;
use App\Models\Application;
use App\Models\User;
use App\Repositories\Interfaces\ApplicationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $applicationRepository;
    public function __construct(ApplicationInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.pages.applications.index');
    }

    public function load(Request $request)
    {
        try {
            $applications = $this->applicationRepository->search($request);
            $showBtn = count($applications) === 10;
            $view = view('website.pages.partials.application-items', [
                'data' => $applications,
                'showBtn' => $showBtn
            ])->render();
            return response()->json([
                'success' => true,
                'view' => $view
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong'
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            return response()->json([
                'success' => true,
                'application' => $this->applicationRepository->create($request->validated())
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        if ($application = Application::query()->find($id)) {
            return response()->json([
                'success' => true,
                'data' => $application
            ], 200);
        }
        return response()->json([
            'success' => false,
            'error' => 'Not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
