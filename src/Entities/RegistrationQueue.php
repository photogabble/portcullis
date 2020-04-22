<?php

namespace Photogabble\Portcullis\Entities;

use Illuminate\Database\Eloquent\Model;

class RegistrationQueue extends Model
{
    protected $table = 'registration_queue';

    protected $fillable = ['display_name', 'email', 'is_supporter'];
}
