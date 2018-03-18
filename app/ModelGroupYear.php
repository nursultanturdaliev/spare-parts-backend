<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string href
 * @property mixed id
 * @property string content
 * @property int model_group_id
 * @property array sparePartCategories
 * @property ModelGroup modelGroup
 */
class ModelGroupYear extends Model
{
    protected $table = 'tetik_model_group_years';

    public $timestamps = false;

    protected $fillable = ['name', 'content', 'href', 'model_group_id'];

    public function sparePartCategories()
    {
        return $this->hasMany(SparePartCategory::class);
    }

    public function modelGroup()
    {
        return $this->belongsTo(ModelGroup::class);
    }
}