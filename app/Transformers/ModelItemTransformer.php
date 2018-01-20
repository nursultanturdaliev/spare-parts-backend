<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 6:26 AM
 */

namespace App\Transformers;


use App\ManufacturerModel;
use League\Fractal\TransformerAbstract;

class ModelItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['designations'];

    public function transform(ManufacturerModel $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'manufactured_years' => $model->manufactured_years
        ];
    }

    /**
     * @param ManufacturerModel $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeDesignations(ManufacturerModel $model)
    {
        return $this->collection($model->designations, new DesignationTransformer(), 'designations');
    }
}