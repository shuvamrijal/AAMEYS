<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
  use Notifiable;
  protected $primaryKey='courses_id';
}
