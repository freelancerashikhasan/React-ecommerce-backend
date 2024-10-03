<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Constant;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'refer',
        'agent',
        'email',
        'image',
        'nid_no',
        'gender',
        'birthday',
        'blood_group',
        'qualification',
        'country',
        'states',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'address',
        'village_id',
        'nid_front',
        'nid_back',
        'certificate',
        'chairman_certificate',
        'nominee_img',
        'nominee_nid_front',
        'nominee_nid_back',
        'nominee_phone',
        'guardian_img',
        'guardian_nid_front',
        'guardian_nid_back',
        'guardian_phone',
        'otp',
        'password',
        'show_password',
        'status',
        'email_verified_at',
        'type',
        'pharmacy_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function referrals()
    {
        return $this->hasMany(User::class, 'refer', 'username')->where('status', Constant::USER_STATUS['active']);
    }
    public function refferrer()
    {
        return $this->belongsTo(User::class, 'refer', 'username');
    }
    public function referralsRecursive()
    {
        return $this->referrals()->with('referralsRecursive')->limit(10);
    }

    public function purchase()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id')
            ->where(function ($query) {
                $query->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['product_sell'], Constant::TRANSACTION_TYPE['package_sell']]);
            });
    }
    public function rank()
    {
        return $this->hasOne(Rank2::class, 'username', 'username')->latest();
    }
    public function countryInfo()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    public function stateInfo()
    {
        return $this->belongsTo(State::class, 'states', 'id');
    }
}
