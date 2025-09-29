<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        'uri',
        'permission',
        'sort',
        'status',
        'is_show',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_show' => 'boolean',
    ];

    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }
}
