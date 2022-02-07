<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Spaceship
 *
 * @property int                             $id
 * @property string                          $name
 * @property string                          $class
 * @property int                             $crew
 * @property string                          $image
 * @property float                           $value
 * @property string                          $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Spaceship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'class',
        'crew',
        'image',
        'value',
        'status',
    ];


    /**
     * Spaceships - Armaments Relationship
     */
    public function armaments()
    {
        return $this->belongsToMany(Armament::class,'spaceships_armaments')->withPivot('qty');
    }

    /**
     * Scope to Filter Request
     *
     * @param $query
     * @param $request
     *
     * @return mixed
     */
    public function scopeFilterByRequest($query, $request)
    {
        if($request->has('name')){
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if($request->has('class')){
            $query->where('class','LIKE', '%'. $request->input('class') .'%');
        }
        if($request->has('status'))
        {
            $query->where('status', $request->input('status'));
        }

        return $query;

    }


}
