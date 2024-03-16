<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Employee\StoreRequest;
use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Models\User;
use App\Models\Roles;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use DataTables;

class AdminUserController extends AdminBaseController
{
    public function __construct() {	
		parent::__construct();

		$this->middleware('role:admin');		
		
	}


    public function index(Request $request)
    {
        if ($request->ajax()) 
		{
            $data = User::where('id', '!=', 1)->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group table-action">
									<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">Action</button>
									<div class="dropdown-menu">';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="editEmp('.$row->id.')">Edit</a>';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="deleteEmp('.$row->id.')">Delete</a>';

							$btn .= '</div>
								</div>';      
                        return $btn;
                    })
					->editColumn('role', function ($row) {
                        return ucfirst($row->roles[0]->name);
					})                    

                    ->rawColumns(['action'])
                    ->make(true);
        }       

        return view('admin.employee.index');  
    }  

    public function create()
    {
        $this->roles = Roles::whereNotIn('name', ['super-admin', 'customer'])->get();
        return view('admin.employee.add-edit-employee', $this->data);
    }

    /**
     * Save Employee
     */
    public function store(StoreRequest $request)
    { 
        $employee = new User();
        $employee->name = $request->name;
		$employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->password = Hash::make($request->password);
        $employee->save();

        //Set Role
        $role = new RoleUser();
        $role->roles_id = $request->role;
        $role->users_id = $employee->id;
        $role->save();

		return response()->json(['status'  => true, 'message' => 'Employee created!']);
    }

    /**
     * Edit Employee
     */

    public function edit($id)
	{
		$this->employee = User::findOrFail($id);
        $this->roles    = Roles::whereNotIn('name', ['super-admin', 'customer'])->get();
        return view('admin.employee.add-edit-employee', $this->data);
	}


    /**
     * Update Employee
     */

    public function update(UpdateRequest $request, $id)
    {
        $employee = User::findOrFail($id);

        if(!empty($request->password))
        {
            $this->validate($request, [
                'password'  => 'required|min:6',
                'cpassword' => 'required_with:password|same:password|min:6'
            ]);

            $employee->password = Hash::make($request->password);
        }
		
        $employee->name = $request->name;
		$employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        //Update Role
        $role = RoleUser::firstOrCreate(['users_id' => $id]);
        $role->roles_id = $request->role;
        $role->save();

		return response()->json(['status' => true, 'message' => 'Employee updated!']);
	}


    /**
     * Delete Employee
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully!']);
    }


}
