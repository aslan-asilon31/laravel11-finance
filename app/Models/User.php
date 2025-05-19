<?php

namespace App\Models;

use App\Models\Common\Contact;
use App\Models\Core\Department;
// use Filament\Models\Contracts\FilamentUser;
// use Filament\Models\Contracts\HasAvatar;
// use Filament\Models\Contracts\HasDefaultTenant;
// use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
// use Wallo\FilamentCompanies\HasCompanies;
// use Wallo\FilamentCompanies\HasConnectedAccounts;
// use Wallo\FilamentCompanies\HasProfilePhoto;
// use Wallo\FilamentCompanies\SetsProfilePhotoFromUrl;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use Notifiable;


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function latestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    public function oldestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->oldestOfMany();
    }

    public function bestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->ofMany('likes', 'max');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getUserPermissions()
{
    return $this->getAllPermissions()->mapWithKeys(fn($permission) => [$permission['name'] => true]);
}

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getTenants(Panel $panel): array | Collection
    {
        return $this->allCompanies();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->belongsToCompany($tenant);
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->personalCompany();
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->profile_photo_url;
    }

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function managerOf(): HasMany
    {
        return $this->hasMany(Department::class, 'manager_id');
    }

    public function switchCompany(mixed $company): bool
    {
        if (! $this->belongsToCompany($company)) {
            return false;
        }

        $this->forceFill([
            'current_company_id' => $company->id,
        ])->save();

        $this->setRelation('currentCompany', $company);

        session(['current_company_id' => $company->id]);

        return true;
    }
}
