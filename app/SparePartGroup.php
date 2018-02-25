<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property  string name
 * @property  string description
 * @property  string content
 * @property  string href
 * @property  string thumbnail
 * @property  string thumbnail_src
 * @property  string image
 * @property  string image_html
 * @property integer id
 */
class SparePartGroup extends Model
{
    protected $table = 'tetik_spare_part_groups';

    protected $fillable = ['name', 'description', 'content', 'href', 'thumbnail', 'thumbnail_src', 'image', 'image_html','spare_part_category_id'];
    public $timestamps = false;
}