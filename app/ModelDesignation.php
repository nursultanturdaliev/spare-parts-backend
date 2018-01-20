<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/18/18
 * Time: 9:48 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string modification
 * @property string transmission
 * @property string wheel_drive
 * @property string engine_power
 * @property string engine_volume
 * @property string engine_model
 * @property string engine_type
 * @property string code
 * @property string number_of_doors
 * @property string release_date
 * @property string lifting_capacity
 * @property string chassis_configuration
 */
class ModelDesignation extends Model
{
    protected $table = 'model_designations';

    protected $fillable = ['model_id', 'href'];

    public $timestamps = false;
}