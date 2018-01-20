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

    public function modificationType()
    {
        return $this->belongsTo(ModificationType::class);
    }
}
