<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    
	 public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

	
	public function index()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "";
		$data['sub_module']= "";
        return view('frontend.index', $data);
    }
}
