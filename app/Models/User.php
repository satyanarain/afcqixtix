<?php
namespace App\Models;
//use Fenos\Notifynder\Notifable;
use Fenos\Notifynder\Traits\NotifableLaravel53 as NotifableTrait;
use Illuminate\Database\Eloquent\Model as EloquentModel;
//use Illuminate\Notifications\Notifiable;
use Cache;
use App\Models\Client;
use App\Models\Associate;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use NotifableTrait, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $guarded = ['status'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    protected $hidden = ['password', 'password_confirmation', 'remember_token'];
    protected $primaryKey ='id';
    public function tasksAssign()
    {
        return $this->hasMany(Tasks::class, 'fk_user_id_assign', 'id')
        ->where('status', 1)
        ->orderBy('deadline', 'asc');
    }
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function country()
    {
        return $this->hasMany('App\Models\Category');
    }
    public function depot()
    {
        return $this->hasMany('App\Models\Depot');
    }
    public function shif()
    {
        return $this->hasMany('App\Models\Shif');
    }
    public function service()
    {
        return $this->hasMany('App\Models\Service');
    }
    public function vehicle()
    {
        return $this->hasMany('App\Models\Vehicle');
    }
    public function stop()
    {
        return $this->hasMany('App\Models\Vehicle');
    }
    
//    public function tasksAll()
//    {
//        return $this->hasMany(Tasks::class, 'fk_user_id_assign', 'id')->whereIn('status', [1, 2]);
//    }
//    public function leadsAll()
//    {
//        return $this->hasMany(Leads::class, 'fk_user_id', 'id');
//    }
//    public function settings()
//    {
//        return $this->belongsTo(Settings::class);
//    }
//
//    public function clientsAssign()
//    {
//        return $this->hasMany(Client::class, 'fk_user_id', 'id');
//    }
//
//    public function userRole()
//    {
//        return $this->hasOne(RoleUser::class, 'user_id', 'id');
//    }
//    public function department()
//    {
//        return $this->belongsToMany(Department::class, 'department_user');
//    }
//    public function departmentOne()
//    {
//        return $this->belongsToMany(Department::class, 'department_user')->withPivot('Department_id');
//    }
//    public function isOnline()
//    {
//        return Cache::has('user-is-online-' . $this->id);
//    }
//
//    public function associate()
//    {
//        return $this->belongsTo('App\Models\Associate');
//    }
//
//    public function client()
//    {
//        return $this->belongsTo('App\Models\Client');
//    }
}
