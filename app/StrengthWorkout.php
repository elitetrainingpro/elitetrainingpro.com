<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StrengthWorkout extends Model
{
	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'strength_workouts';
	/**
	 * [$fillable description]
	 * @var [type]
	 */
	protected $fillable = [
			'user_id','name', 'weight', 'reps', 'sets', 'date'
	];
}