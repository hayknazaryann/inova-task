<?php

namespace App\Repositories\Eloquent;

use App\Models\Application;
use App\Repositories\Interfaces\ApplicationInterface;
use Illuminate\Database\Eloquent\Model;
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

}
