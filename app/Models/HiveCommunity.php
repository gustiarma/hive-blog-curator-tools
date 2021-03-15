<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiveCommunity extends Model
{
    use HasFactory;
    protected $table = 'hive_communities';
    protected $fillable = [
        'uuid',
        'name',
        'id',
        'title',
        'about',
        'lang',
        'type_id',
        'is_nsfw',
        'subscribers',
        'sum_pending',
        'num_pending',
        'num_authors',
        'community_created_at',
        'avatar_url',
        'admins',
    ];
    protected $primaryKey = 'uuid';
    public $incrementing = false;
}
