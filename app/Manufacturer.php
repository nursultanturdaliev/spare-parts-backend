<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property mixed href
 * @property string content
 * @property mixed id
 * @property int name
 * @property Collection models
 */
class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $fillable = ['name', 'href'];

    public function models()
    {
        return $this->hasMany(ManufacturerModel::class);
    }
}