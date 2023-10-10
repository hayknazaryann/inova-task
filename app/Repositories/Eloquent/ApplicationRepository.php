<?php

namespace App\Repositories\Eloquent;

use App\Models\Application;
use App\Models\User;
use App\Repositories\Interfaces\ApplicationInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationRepository extends EloquentRepository implements ApplicationInterface
{
    /**
     * ApplicationRepository constructor.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->model = $application;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $data['user_id'] = Auth::id();
        return $this->getModel()->create($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $user = User::find(Auth::id());
        $applications = $user->applications()->orderByDesc('id');

        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $applications = $applications->where('text', 'like', '%' . $keyword . '%');
        }

        $status = $request->input('status');
        if (!is_null($status)) {
            $applications = $applications->where(['status' => $status]);
        }

        return $applications->offset(0)->limit(10)->get();
    }

}
