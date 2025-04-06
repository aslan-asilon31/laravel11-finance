<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Admin\Role\Forms\RoleForm;
use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleCrud extends Component
{

    public function render()
    {
        return view('livewire.admin.role.role-crud')->title($this->title);
    }



  use \Livewire\WithFileUploads;
//   use \App\Helpers\ImageUpload\Traits\WithImageUpload;
//   use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;


  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'role';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Role';

  #[\Livewire\Attributes\Locked]
  public string $url = '/role';

  public $roles = [];
  public $rolePermissions = [];

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];


  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Role::class;

    public $isLoading = false;
    public  $permissions = [];
    public  $selectedPermissions = [];
    public  $groupedPermissions = [];
    public bool $checkAll = false;



  public RoleForm $masterForm;

  public function mount()
  {


    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } elseif ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }
    $this->initialize();
  }

  public function initialize()
  {
  }

  public function create()
  {
    // dd($this->masterForm);
    $this->masterForm->reset();
  }

  public function store()
  {
    // $this->permission($this->basePageName.'-create');

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['id'] = str($validatedForm['name'])->slug('_');

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();


      $pageId = str($validatedForm['name'])->slug('_');
      \Log::info('Inserting permission with page_id: ' . $pageId);

      $actions = Action::all();

      $permissionsData = $actions->map(function ($action) use ($pageId) {
          return [
              'id' => strtolower($pageId . '-' . $action->name),
              'page_id' => $pageId,
              'action_id' => $action->id,
              'name' => strtolower($pageId . '-' . $action->name),
              'created_at' => now(),
              'updated_at' => now(),
          ];
      })->toArray();

      Permission::insert($permissionsData);
      \Illuminate\Support\Facades\DB::commit();

          // $positionPermissionsData = $actions->map(function ($action) use ($pageId) {
          //     return [
          //         'id' => strtolower(auth()->user()->employee->position_id . '-' . $pageId . '-' . $action->name),
          //         'position_id' => auth()->user()->employee->position_id,
          //         'permission_id' => strtolower($pageId . '-' . $action->name),
          //     ];
          // })->toArray();

          // PositionPermission::insert($positionPermissionsData);
          // \Illuminate\Support\Facades\DB::commit();

          $this->create();
          $this->success('Data has been stored');
        } catch (\Throwable $th) {
          \Illuminate\Support\Facades\DB::rollBack();
          \Log::error('Data failed to store: ' . $th->getMessage());
          $this->error('Data failed to store');
      }


  }

  public function show()
  {
    $this->permission($this->basePageName.'-show');

    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {

    $this->permissions = DB::table('permissions')->select('id', 'name')->get();

    $this->rolePermissions = DB::table('roles')
        ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('permissions.id as permission_id', 'permissions.name as permission_name')
        ->where('role_has_permissions.role_id', $this->id)
        ->get();


        $this->groupedPermissions = [];
        foreach ($this->permissions as $permission) {
            // Split the permission name by dash
            $parts = explode('-', $permission->name);
            if (count($parts) > 2) {
                // Use the second part as the key for grouping
                $groupKey = $parts[1]; // e.g., 'post' from 'developer-post-create'
                $this->groupedPermissions[$groupKey][] = $permission;
            }
        }



    $this->selectedPermissions = $this->rolePermissions->pluck('permission_id')->toArray();
  }

  public function toggleCheckAll()
  {
      if ($this->checkAll) {
          // If "Check All" is checked, select all permissions
          $this->selectedPermissions = $this->permissions->pluck('id')->toArray();
      } else {
          // If "Check All" is unchecked, clear all selections
          $this->selectedPermissions = [];
      }
  }


  public function refreshData()
  {
    $this->isLoading = true;
    $this->edit();
    $this->isLoading = false;
  }

  public function update()
  {
      // Validate the selected permissions
      $validatedForm = $this->validate([
          'selectedPermissions' => 'array',
          'selectedPermissions.*' => 'exists:permissions,id',
      ]);

      $validatedForm['selectedPermissions'] = array_map('intval', $validatedForm['selectedPermissions']);

    //   dd($validatedForm);

      \Illuminate\Support\Facades\DB::beginTransaction();
      try {
          // Assuming you have the role ID stored in $this->id
          $roleId = $this->id;

          // First, delete existing permissions for the role
          DB::table('role_has_permissions')
              ->where('role_id', $roleId)
              ->delete();

          // Insert the new permissions
          $permissionsToInsert = array_map(function ($permissionId) use ($roleId) {
              return [
                  'role_id' => $roleId,
                  'permission_id' => $permissionId,
              ];
          }, array_unique($validatedForm['selectedPermissions']));

          // Insert the new permissions into the role_has_permissions table
          DB::table('role_has_permissions')->insert($permissionsToInsert);

          \Illuminate\Support\Facades\DB::commit();

          // Optionally, you can add a success message or redirect
          $this->success('Permissions updated successfully.');
      } catch (\Throwable $th) {
          \Illuminate\Support\Facades\DB::rollBack();
          // Handle the error, log it, or show an error message
          \Log::error('Failed to update permissions: ' . $th->getMessage());
          $this->error('Failed to update permissions.');
      }
  }


  public function delete()
  {
    $this->permission($this->basePageName.'-delete');

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }


}
