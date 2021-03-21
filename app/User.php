<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Passport\HasApiTokens;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class User extends Authenticatable
{
    use Notifiable,Sortable,HasApiTokens,Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes

    public $sortable = ['id', 'first_name', 'email','number','created_at', 'updated_at','status','is_kyc'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_ip', 'api_token','notification','device_token','online','last_login_at','device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' .ucfirst($this->last_name);
    }
     /**
     * @param  Email
     * @return User
     * @return Type|Object
     *
     * Get User data by Email
     */
    public function userbyEmail($email)
    {
        $data = $this->where('email', $email)->firstOrFail();
        return $data;
    }

    public function AauthAcessToken(){
        return $this->hasMany(OauthAccessToken::class);
    }


    /**
     * Get the post record associated with the page.
     * @bind hasMany
     */
    public function permission()
    {
    	return $this->belongsToMany('App\Module');
    }

    /**
     * user to UserProfile
     */
    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * user to UserProfile
     */
    public function wallet() {
        return $this->hasOne(wallet::class, 'user_id')->orderBy('id','desc');
    }

     

     



}
