<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,Notifiable,HasRoles,HasFactory,InteractsWithMedia ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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


    public function get_roles(){
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }


    public function role(){
         $roles =$this->getRoleNames()->toArray();
        $role = '';
        if($roles){
            $role = implode(' , ', $roles);
        }

        return $role;
    }


    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder').'160.png')
            ->useFallbackPath(config('app.placeholder').'160.png')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(160)
                    ->height(160);
            });
    }


    public function profile()
    {
        return $this->hasOne(User::class);
    }
}
