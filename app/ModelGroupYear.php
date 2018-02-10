<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string href;
 * @property mixed id
 */
class ModelGroupYear extends Model
{
    protected $table = 'tetik_model_group_years';

    public $timestamps = false;

    protected $fillable = ['name', 'content', 'href', 'model_group_id'];
}