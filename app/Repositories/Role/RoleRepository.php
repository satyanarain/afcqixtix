<?php
namespace App\Repositories\Role;

use App\Models\Role;


class RoleRepository implements RoleRepositoryContract
{

    public function listAllRoles()
    {
        return Role::pluck('display_name', 'id');
    }

    public function allRoles()
    {
        return Roles::all();
    }


    public function permissionsUpdate($requestData)
    {
        $allowed_permissions = [];

        if ($requestData->input('permissions') != null) {
            foreach ($requestData->input('permissions')
            as $permissionId => $permission) {
                if ($permission === '1') {
                    $allowed_permissions[] = (int)$permissionId;
                }
            }
        } else {
            $allowed_permissions = [];
        }
       
        $role = Role::find($requestData->input('role_id'));

        $role->permissions()->sync($allowed_permissions);
        $role->save();
    }

    public function create($requestData)
    {
        
        
        $input= $request->all();
            $user_id=  Auth::id();
            $input['user_id'] = $user_id;
            $input['users'] = implode(',', $request->users);
            $input['changepasswords'] = implode(',', $request->changepasswords);
            $input['permissions'] = implode(',', $request->permissions);
            $input['depots'] = implode(',', $request->depots);
            $input['bus_types'] = implode(',', $request->bus_types);
            $input['services'] = implode(',', $request->services);
            $input['vehicles'] = implode(',', $request->vehicles);
            $input['shifts'] = implode(',', $request->shifts);
            $input['stops'] = implode(',', $request->stops);
            $input['routes'] = implode(',', $request->routes);
            $input['duties'] = implode(',', $request->duties);
            $input['targets'] = implode(',', $request->targets);
            $input['fares'] = implode(',', $request->fares);
            $input['concession_fare_slabs'] = implode(',', $request->concession_fare_slabs);
            $input['concessions'] = implode(',', $request->concessions);
            $input['trip_cancellation_reasons'] = implode(',', $request->trip_cancellation_reasons);
            $input['inspector_remarks'] = implode(',', $request->inspector_remarks);
            $input['payout_reasons'] = implode(',', $request->payout_reasons);
            $input['denominations'] = implode(',', $request->denominations);
            $input['pass_types'] = implode(',', $request->pass_types);
            $input['crew'] = implode(',', $request->crew);
            $input['etm_details'] = implode(',', $request->etm_details);
           $roles= Role::create($input);
            
             Session::flash('flash_message', "Role Created Successfully."); //Snippet in Master.blade.php
       return $roles;
            
            
    }

    public function destroy($id)
    {
        $permission = Role::findorFail($id);
        if ($permission->id !== 1) {
            $permission->delete();
        } else {
            Session()->flash('flash_message_warning', 'Can not delete Administrator permission');
        }
    }
}
