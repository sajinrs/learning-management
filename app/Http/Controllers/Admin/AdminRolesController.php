<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Module;
use App\Models\ModulePermission;

class AdminRolesController extends AdminBaseController
{
    public function __construct() {	
		parent::__construct();

		$this->middleware('role:admin');		
		$this->middleware(function ($request, $next) {
            return $next($request);
        });
	}

    public function index()
    {
        $this->roles = Roles::whereNotIn('name', ['admin'])->get();
        return view('admin.role.index', $this->data);
    }

    public function create()
    {
        return view('admin.role.add-edit-role');
    }

    public function store(Request $request)
    {        
        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);

		$role = new Roles();
        $role->name = $request->name;
        $role->save();

        $request->session()->flash('success_msg', 'Role Created!');
		return response()->json(['status'  => true, 'message' => 'Role created!']);
    }


    public function edit($id)
    {
        $this->role = Roles::findOrFail($id);
        return view('admin.role.add-edit-role', $this->data);
    }


    public function update(Request $request, $id)
    {
		$this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
        ]);

		$role = Roles::findOrFail($id);
		$role->name = $request->name;		
		$role->save();

        $request->session()->flash('success_msg', 'Role Updated!');
		return response()->json(['status' => true, 'message' => 'Role updated!']);
	}

    public function destroy($id)
    {
        $role = Roles::find($id);
        $role->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully!']);
    }

    /**
     * Permission
     */

    public function modules($id)
    {
        $this->role        = Roles::find($id);
        $this->modules     = Module::all();
        $permissions       = ModulePermission::where('roles_id', $id)->value('modules');
        $this->permissions = explode(',',$permissions);        

        return view('admin.role.module-permission', $this->data);
    }

    public function updatePermission(Request $request, $id)
    {
        if(!empty($request->module)) {
            $modules = implode(',', $request->module);

            ModulePermission::updateOrCreate(
                [
                   'roles_id' => $id,
                ],
                [
                    'roles_id' => $id,
                    'modules'  => $modules,
                ],
            );  
        } else {
            ModulePermission::updateOrCreate(
                [
                   'roles_id' => $id,
                ],
                [
                    'roles_id' => $id,
                    'modules'  => '',
                ],
            ); 
        }

        return response()->json(['status' => true, 'message' => 'Permission Updated!']);
    }

}
