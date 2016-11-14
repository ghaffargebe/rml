<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Auth;

class Dataset extends Eloquent
{
    protected $collection = 'datasets';

    public static function boot(){
    	parent::boot();
    	static::creating(function($model)
    	{
    		$user = Auth::user();
    		$model->created_by = $user->id;
    	});
    	static::updating(function($model)
    	{
    		$user = Auth::user();
    		$model->updated_by = $user->id;
    	});
    }
}
