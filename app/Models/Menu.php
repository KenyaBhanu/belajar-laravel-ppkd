<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        'url',
        'sort_order',
        'is_active'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order', 'asc');
    }
}
