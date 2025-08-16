<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function cleanings()
    {
        return $this->belongsToMany(Cleaning::class, 'cleaning_user');
    }
    
    public function dailyCleaningPoints()
    {
        return $this->hasMany(DailyCleaningPoint::class);
    }

    public function checks()
    {
        return $this->hasMany(Checks::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function assignRole($roleName)
    {
        $role = Role::firstOrCreate(['name' => $roleName]);
        $this->roles()->syncWithoutDetaching([$role->id]);
    }

    public function assignSkill($skillName)
    {
        $skill = Skill::firstOrCreate(['name' => $skillName]);
        $this->skills()->syncWithoutDetaching([$skill->id]);
    }
}
