<?php

namespace App;

use App\Events\GoalAchieved;
use App\Traits\HasTransactions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon due_date
 */
class Goal extends Model
{
    use HasTransactions;

    protected $guarded = [];

    protected $attributes = [
        'currency' => Currency::USD,
    ];

    protected $dates = ['due_date'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $goal) {
            $goal->suggestDueDate();
        });
    }

    public function suggestDueDate()
    {
        if (! $this->due_date) {
            $periods = Plan::find(1)->expectedPeriods($this->total);
            $this->due_date = Carbon::today()->addMonths($periods);
        }
    }

    public function addTransaction($data)
    {
        $transaction = $this->deposit($data);

        if ($this->isAchieved()) {
            event(new GoalAchieved($this));
        }

        return $transaction;
    }

    public function isAchieved()
    {
        return $this->total <= $this->balance();
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value);
    }
}
