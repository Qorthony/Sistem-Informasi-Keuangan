<?php namespace App\Controllers;

class Laporan extends BaseController
{
	public function index()
	{	
		$filter = [
			"laporan"=>"",
			"mata_uang"=>""
		];
		if ($this->request->getVar("kategori")) {
			$filter = [
				"laporan"=>$this->request->getVar("kategori"),
				"mata_uang"=>$this->request->getVar("mata_uang")
			]; 
		}
		return view('laporan',$filter);
	}



	//--------------------------------------------------------------------

}
