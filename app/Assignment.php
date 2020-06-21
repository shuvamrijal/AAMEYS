<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Assignment extends Model
{
  use Notifiable;
  protected $primaryKey='id';
}
