<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['valid_from_formated'];

    protected $fillable = [
        'person_id',
        'group_id',
        'name',
        'content',
        'valid_from',
        'is_active',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'person_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function getValidFromFormatedAttribute()
    {
        return Carbon::parse($this->valid_from)->format('Y-m-d');
    }

    public function scopeValid($query)
    {
        return $query->where('valid_from', '<=', Carbon::today());
    }
}
