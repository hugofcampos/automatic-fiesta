<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Event extends Model implements ContractsAuditable
{
    use HasFactory, Uuid, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventDates()
    {
        return $this->HasMany(EventDate::class);
    }

    public function publish()
    {
        $this->published = true;

        return $this;
    }
}
