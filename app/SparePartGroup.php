<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property  integer id
 * @property  string name
 * @property  string description
 * @property  string content
 * @property  string href
 * @property  string thumbnail
 * @property  string thumbnail_src
 * @property  string image
 * @property  string image_html
 * @property  string image_src
 * @property  array spareParts
 * @property  SparePartCategory sparePartCategory
 */
class SparePartGroup extends Model
{
    protected $table = 'tetik_spare_part_groups';

    protected $fillable = ['name', 'description', 'content', 'href', 'thumbnail', 'thumbnail_src', 'image', 'image_html', 'image_src', 'spare_part_category_id'];
    public $timestamps = false;

    public function spareParts()
    {
        return $this->hasMany(SparePart::class);
    }

    public function sparePartCategory()
    {
        return $this->belongsTo(SparePartCategory::class);
    }
}