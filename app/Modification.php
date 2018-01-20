<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 10:57 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string code
 * @property string engine_type
 * @property string engine_model
 * @property string engine_volume
 * @property string capacity
 * @property string transmission
 * @property string dates_of_issue
 * @property string content
 */
class Modification extends Model
{

    public $timestamps = false;

    protected $table = 'modifications';
    protected $fillable = [
        'name',
        'modification_type_id',
        'model_designation_id'
    ];
}
