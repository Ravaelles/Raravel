<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent; // Jenssegers MongoDB v. 3+

//use Jenssegers\Mongodb\Model as Moloquent; // Jenssegers MongoDB v. < 3.0

class Eloquent extends Moloquent
{

    /**
     * Auxiliary constant that allows to static access.
     */
    const PRIMARY_KEY_NAME = '_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Fields that aren't allowed to be changed by mass assignment.
     */
    protected $guarded = [
        Eloquent::PRIMARY_KEY_NAME,
        'created_at', 'updated_at',
    ];

    // === Static ===========================================================

    /**
     * Returns name of the primary key.
     * @return string 
     */
    public static function primaryKey()
    {
        return self::PRIMARY_KEY_NAME;
    }

    /**
     * Works exactly like 'findOrFail', but takes field name as a param.
     *  */
    public static function findByFieldOrFail($fieldName, $fieldValue)
    {
        return self::where($fieldName, '=', $fieldValue)->firstOrFail();
    }

    /**
     * Searches for object that has either 'email' or '_id' equal to given value.
     * Fails (exception) otherwise.
     */
    public static function findByEmailOrIdOrFail($emailOrId)
    {
        return self::where('email', '=', $emailOrId)
                ->orWhere('_id', '=', $emailOrId)
                ->firstOrFail();
    }

    /**
     * Searches for object that has either 'email' or '_id' equal to given value.
     * Returns null on not found.
     */
    public static function findByEmailOrId($emailOrId)
    {
        return self::where('email', '=', $emailOrId)
                ->orWhere('_id', '=', $emailOrId)
                ->orderBy('_id', 'DESC')
                ->first();
    }

    // === Non-static ===========================================================

    /**
     * Returns ID value. 
     */
    public function getId()
    {
        return $this->{self::primaryKey()};
    }

    /** Alias for <b>getAttributes()</b>. Also removes _id, updated_at and created_at fields. */
    public function a()
    {
        $attributes = $this->getAttributes();
        unset($attributes['_id']);
        unset($attributes['created_at']);
        unset($attributes['updated_at']);
        return $attributes;
    }

    public function textIfEmpty($message = "Empty")
    {
        return "<span style='color:rgba(200,200,200,0.8);font-weight:bold;'>$message</span>";
    }

}
