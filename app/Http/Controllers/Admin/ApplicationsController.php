<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusesEnum;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationInterface;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
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
        return view('admin.applications.index', [
            'applications' => $this->applicationRepository->paginate()
        ]);
    }

    public function status(Request $request, $id)
    {
        try {
            $status = $request->input('status');
            if (!in_array($status, array_keys(StatusesEnum::all()))) {
                return response()->json([
                    'success' => false,
                    'error' => 'Wrong status'
                ], 404);
            }

            if ($application = Application::query()->find($id)) {
                $application->update([
                    'status' => $status
                ]);

                return response()->json([
                    'success' => true,
                    'error' => 'Status changed'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'error' => 'Application not found'
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong'
            ], 400);
        }
    }
}
