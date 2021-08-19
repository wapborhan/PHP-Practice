<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Models\Cart;
use App\Notifications\EmailVerificationNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'postal_code', 'phone', 'country', 'provider_id', 'email_verified_at', 'verification_code'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlists()
    {
    return $this->hasMany(Wishlist::class);
    }

    public function customer()
    {
    return $this->hasOne(Customer::class);
    }

    public function affiliate_user()
    {
    return $this->hasOne(AffiliateUser::class);
    }

    public function affiliate_withdraw_request()
    {
    return $this->hasMany(AffiliateWithdrawRequest::class);
    }
    public function staff()
    {
    return $this->hasOne(Staff::class);
    }

    public function orders()
    {
    return $this->hasMany(Order::class);
    }

    public function wallets()
    {
    return $this->hasMany(Wallet::class)->orderBy('created_at', 'desc');
    }

    public function club_point()
    {
    return $this->hasOne(ClubPoint::class);
    }

    public function customer_package()
    {
        return $this->belongsTo(CustomerPackage::class);
    }

    public function customer_package_payments()
    {
        return $this->hasMany(CustomerPackagePayment::class);
    }

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    public function routeNotificationForEbernate()
    {
        return $this->phone;
    }

    public function userClient(){
		return $this->hasOne('App\UserClient', 'user_id' , 'id');
	}

    public function userCaptain(){
		return $this->hasOne('App\UserCaptain', 'user_id' , 'id');
	}

    public function userBranch(){
		return $this->hasOne('App\UserBranch', 'user_id' , 'id');
	}

}
