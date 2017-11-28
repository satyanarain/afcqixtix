<?php
namespace App\Models;
//use Fenos\Notifynder\Notifable;
use Fenos\Notifynder\Traits\NotifableLaravel53 as NotifableTrait;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['salutation', 'group_company_id', 'name', 'middle_name', 'last_name', 'email', 'password', 'address', 'contact_number', 'telephone_number', 'alternate_contact_number', 'calling_code_contact', 'calling_code_telephone', 'calling_code_alternate', 'country', 'city', 'pin', 'calling_code_fax', 'fax', 'image_path', 'business_card', 'date_of_birth', 'national_id_document', 'passport_number', 'passport_document', 'national_id', 'beneficiary_name',  'beneficiary_country', 'bank_name', 'branch_name', 'branch_address', 'account_type', 'account_number', 'swift_code', 'ifsc_code', 'remember_token', 'set_password_token', 'user_type', 'client_id', 'associate_id', 'status', 'beneficiary_address', 'beneficiary_pin_code', 'bank_country', 'bank_pin_code', 'routing_code','dob'];

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
    public function tasksCreated()
    {
        return $this->hasMany(Tasks::class, 'fk_user_id_created', 'id')->limit(10);
    }

    public function tasksCompleted()
    {
        return $this->hasMany(Tasks::class, 'fk_user_id_assign', 'id')->where('status', 2);
    }
    
    public function tasksAll()
    {
        return $this->hasMany(Tasks::class, 'fk_user_id_assign', 'id')->whereIn('status', [1, 2]);
    }
    public function leadsAll()
    {
        return $this->hasMany(Leads::class, 'fk_user_id', 'id');
    }
    public function settings()
    {
        return $this->belongsTo(Settings::class);
    }

    public function clientsAssign()
    {
        return $this->hasMany(Client::class, 'fk_user_id', 'id');
    }

    public function userRole()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }
    public function department()
    {
        return $this->belongsToMany(Department::class, 'department_user');
    }
    public function departmentOne()
    {
        return $this->belongsToMany(Department::class, 'department_user')->withPivot('Department_id');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function associate()
    {
        return $this->belongsTo('App\Models\Associate');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
