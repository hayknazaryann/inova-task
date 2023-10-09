<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'accepted_by', 'text', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list($limit = 10, $offset = 0)
    {
        return $this->query()
            ->offset($offset)->limit($limit)->orderByDesc('id')->get();
    }
}
