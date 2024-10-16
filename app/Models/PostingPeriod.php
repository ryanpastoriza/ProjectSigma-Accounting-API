<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostingPeriod extends Model
{
    use HasFactory;

	protected $table = 'posting_periods';

	protected $fillable = [
		'period_start',
		'period_end',
		'status',
	];

	public function periods() : HasMany
	{
		return $this->hasMany(Period::class);
	}
}
