<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $guarded = [];

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
            'role' => 'string',
        ];
    }
    // **Aggiungi questa relazione**
    public function workoutPlans()
    {
        // Un utente (trainer) può avere molti workout plans
        return $this->hasMany(WorkoutPlan::class, 'trainer_id');
    }

    // Se vuoi anche la relazione come client (se ti serve)
    public function workoutPlansAsClient()
    {
        return $this->hasMany(WorkoutPlan::class, 'client_id');
    }
    public function clients()
    {
        return $this->hasMany(User::class, 'nutritionist_id');
        // oppure la relazione corretta che avete in DB
    }
}
