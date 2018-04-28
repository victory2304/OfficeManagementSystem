<?php

namespace App\Oms\User\Models;

use App\Oms\Core\Traits\NameAccessor;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, NameAccessor;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    const EMPLOYEE = 'Employee';
    const ADMIN = 'Administrator';
    const DESIGNATIONS = [
      self::EMPLOYEE,
      self::ADMIN
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'designation',
        'username',
        'email',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function notice()
    {
        return $this->hasMany('App\Notice');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'user_task', 'user_id', 'task_id');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function leaves()
    {
        return $this->hasMany('App\Leave', 'user_id');
    }

}

