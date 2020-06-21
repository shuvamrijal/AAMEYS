<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
      use Notifiable;
      protected $primaryKey='staff_id';
}
