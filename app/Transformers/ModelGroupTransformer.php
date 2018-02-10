<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 6:26 AM
 */

namespace App\Transformers;


use App\ManufacturerModel;
use App\ModelGroup;
use App\ModelGroupYear;
use League\Fractal\TransformerAbstract;

class ModelGroupTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['modelGroupYears'];

    public function transform(ModelGroup $modelGroup)
    {
        return [
            'id'         => $modelGroup->id,
            'name'       => $modelGroup->name,
            'code'       => $modelGroup->code,
            'period'     => $modelGroup->period,
            'production' => $modelGroup->production
        ];
    }

    public function includeModelGroupYears(ModelGroup $modelGroup)
    {
        return $this->collection($modelGroup->modelGroupYears, new ModelGroupYearTransformer(), 'modelGroupYears');
    }
}