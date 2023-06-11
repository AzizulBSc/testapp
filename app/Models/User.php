<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use App\Models\Post;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
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
    ];
    public function posts()
    {
        return $this->HasMany(Post::class);
    }
    public static function roleHasPermissions($role,$permissions,$group_name){
        if($group_name=="all"){
        foreach ($permissions as $permission){
             if(!$role->hasPermissionTo($permission->name)){
                return false;
            }
        }
        }
        else{
            foreach ($permissions as $permission){
                if($permission->group_name==$group_name) {
                    if (!$role->hasPermissionTo($permission->name)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
