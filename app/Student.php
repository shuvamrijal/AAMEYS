<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use Notifiable;
  protected $primaryKey='studentId';
}
