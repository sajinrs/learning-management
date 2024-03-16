<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Center;
use App\Models\CenterManager;
use Illuminate\Support\Facades\Hash;
use DataTables;

class AdminBatchController extends AdminBaseController
{
    public function __construct() {	
		parent::__construct();

		$this->middleware('role:admin');		
		
	}


    public function index(Request $request)
    {
        if ($request->ajax()) 
		{
            $data = Batch::with('center')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->editColumn('center', function ($row) {
                        return $row->center->center_name;
					})
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group table-action">
									<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">Action</button>
									<div class="dropdown-menu">';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="editBatch('.$row->id.')">Edit</a>';
										    $btn .= '<a class="dropdown-item" href="javascript:;" onclick="deleteBatch('.$row->id.')">Delete</a>';

							$btn .= '</div>
								</div>';      
                        return $btn;
                    })					                  
                    ->rawColumns(['action'])
                    ->make(true);
        }       

        return view('admin.batch.index');  
    }  

    public function create()
    {
        $this->batch_num    = $this->generateBatchNumber();
        $this->centers      = Center::get();
        return view('admin.batch.add-edit-batch', $this->data);
    }

    public function generateBatchNumber()
    {
        $lastBatchNumber = Batch::orderBy('id', 'DESC')->value('batch_num');        
        if(empty($lastBatchNumber)) {
            $batchNum = '001';
        } else {
            $batchNum = str_pad(intval($lastBatchNumber) + 1, strlen($lastBatchNumber), '0', STR_PAD_LEFT);
        }

        return $batchNum;
    }

    
    public function store(Request $request)
    { 
        $this->validate($request, [
            'name'      => 'required|unique:batches,name',
            'center_id' => 'required'
        ]);

        $batch = new Batch();
        $batch->center_id = $request->center_id;
        $batch->author_id = $this->user->id;
        $batch->batch_num = $request->batch_num;		
        $batch->name      = $request->name;		
        $batch->save();

		return response()->json(['status'  => true, 'message' => 'Batch Created!']);
    }

    /**
     * Edit Employee
     */

    public function edit($id)
	{
		$this->batch   = Batch::findOrFail($id);
        $this->centers = Center::get();       
        return view('admin.batch.add-edit-batch', $this->data);
	}

    
    public function update(Request $request, $id)
    {      
        $this->validate($request, [
            'name'      => 'required',
            'center_id' => 'required'
        ]);
		
        $batch = Batch::findOrFail($id);
        $batch->center_id = $request->center_id;
        $batch->author_id = $this->user->id;
        $batch->name      = $request->name;			
        $batch->save();       

		return response()->json(['status' => true, 'message' => 'Batch updated!']);
	}
    
    public function destroy($id)
    {
        $center = Batch::find($id);
        $center->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully!']);
    }


}
