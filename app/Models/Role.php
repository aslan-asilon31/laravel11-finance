<?php

namespace App\Models;

use App\Models\Common\Contact;
use App\Models\Core\Department;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Role extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'guard_name'
    ];


    public function getRolesWithPermissions()
    {
        $this->roles = Role::with(['permissions' => function($q) {
            $q->select([
                'id',
                'name',
                'guard_name',
            ]);
        }])
        ->orderBy('id') // Mengurutkan berdasarkan ID role
        ->get();
    }


    public function role_has_permissions(): HasMany
    {
        return $this->hasMany(RoleHasPermission::class, 'id');
    }


    public function model_has_roles(): HasMany
    {
        return $this->hasMany(RoleHasPermission::class, 'id');
    }
}
