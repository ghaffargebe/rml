<?php

namespace RML;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Auth;

class Organisasi extends Eloquent
{
    protected $collection;

    public static function boot(){
    	parent::boot();
    	static::creating(function($model)
    	{
    		$user = Auth::user();
    		$model->created_by = $user->username;
    	});
    	static::updating(function($model)
    	{
    		$user = Auth::user();
    		$model->updated_by = $user->username;
    	});
    }
}
