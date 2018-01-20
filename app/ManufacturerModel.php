<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/16/18
 * Time: 7:27 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string manufactured_years
 * @property mixed href
 * @property string content
 */
class ManufacturerModel extends Model
{

    protected $table = 'models';

    protected $fillable = ['name', 'code', 'thumbnail', 'href', 'manufactured_years', 'manufacturer_id', 'model_designation_id'];

    public $timestamps = false;

    public function designations()
    {
        return $this->hasMany(ModelDesignation::class,'model_id');
    }
}