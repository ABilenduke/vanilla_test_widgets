<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
}
