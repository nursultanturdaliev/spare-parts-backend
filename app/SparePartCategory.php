<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 7:11 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string content
 * @property string href
 * @property string
 * @property int model_group_year_id
 * @property ModelGroupYear modelGroupYear
 */
class SparePartCategory extends Model
{
    protected $table = 'tetik_spare_part_categories';

    protected $fillable = ['name', 'thumbnail', 'href', 'content', 'model_group_year_id'];

    public $timestamps = false;

    public function sparePartGroups()
    {
        return $this->hasMany(SparePartGroup::class);
    }

    public function modelGroupYear()
    {
        return $this->belongsTo(ModelGroupYear::class);
    }
}