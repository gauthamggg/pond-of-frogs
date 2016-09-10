<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frog extends Model
{
	 protected $table = 'frogs';
    protected $fillable = ['name', 'gender', 'is_dead'];
}