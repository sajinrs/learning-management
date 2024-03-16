<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Center;
use App\Models\CenterManager;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use DataTables;

class AdminCenterController extends AdminBaseController
{
    public function __construct() {	
		parent::__construct();

		$this->middleware('role:admin');		
		
	}


    public function index(Request $request)
    {
        if ($request->ajax()) 
		{
            $data = Center::get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('manager', function($row){
                        $ManagerData = '<ul>';
                        foreach($row->managers as $manager){
                            $user = Helper::userDetails($manager->manager_id);
                            $ManagerData .= '<li>'.$user->name.'</li>';
                        }
                        $ManagerData .= '</ul>';   

                        return $ManagerData;
                    })	
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group table-action">
									<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">Action</button>
									<div class="dropdown-menu">';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="editCenter('.$row->id.')">Edit</a>';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="deleteCenter('.$row->id.')">Delete</a>';

							$btn .= '</div>
								</div>';      
                        return $btn;
                    })
					                  

                    ->rawColumns(['action', 'manager'])
                    ->make(true);
        }       

        return view('admin.center.index');  
    }  

    public function create()
    {
        $this->managers = User::whereHas('roles', function($q){
                                $q->where('name', 'Center Manager');
                            })->get();
        return view('admin.center.add-edit-center', $this->data);
    }

    
    public function store(Request $request)
    { 
        $this->validate($request, [
            'center_name' => 'required|unique:centers,center_name'
        ]);

        $center = new Center();
        $center->center_name = $request->center_name;		
        $center->save();

        if($request->managers) {
            foreach($request->managers as $manager) 
            {
                $centerManager = new CenterManager();
                $centerManager->manager_id = $manager;
                $centerManager->center_id  = $center->id;
                $centerManager->save();
            }            
        }

		return response()->json(['status'  => true, 'message' => 'Employee created!']);
    }

    /**
     * Edit Employee
     */

    public function edit($id)
	{
        $this->managers = User::whereHas('roles', function($q){
                                $q->where('name', 'Center Manager');
                            })->get();
		$this->center   = Center::with('managers')->findOrFail($id);

        if($this->center->managers) 
        {
            $mnagerIDs = [];
            foreach($this->center->managers as $manager) {
                $mnagerIDs[] = $manager->manager_id;
            }

            $this->mnagerIDs = $mnagerIDs;            
        }

        return view('admin.center.add-edit-center', $this->data);
	}

    
    public function update(Request $request, $id)
    {
        $center = Center::findOrFail($id);

        $this->validate($request, [
            'center_name'   => 'required',
            'managers'      => 'required'
        ]);
		
        $center->center_name = $request->center_name;		
        $center->save();        

        if($request->managers) 
        {
            CenterManager::where('center_id', $id)->delete();
            
            foreach($request->managers as $manager) 
            {                
                $centerManager = new CenterManager();
                $centerManager->manager_id = $manager;
                $centerManager->center_id  = $id;
                $centerManager->save();
            }            
        }

		return response()->json(['status' => true, 'message' => 'Center updated!']);
	}
    
    public function destroy($id)
    {
        $center = Center::find($id);
        $center->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully!']);
    }


}
