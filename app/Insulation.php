<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insulation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'insulations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'name',
        'max_temp',
        'min_temp',
        'location_id',
        'location_text',
        'insulation_mat',
        'insulation_spec',
        'finish_mat',
        'finish_spec',
        'image',
        'chapter',
        'description',
        'explanation',
        'password',
    ];

    /**
     * Get the location record associated with the insulation.
     */
    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location_id');
    }
}
