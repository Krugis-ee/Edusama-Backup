<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class AssignmentExport implements FromView
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
  
	public function __construct($data) {
    $this->data = $data;
	}

	public function view(): View
	{
		//dd($this->data);   
		return view('partials.view_assignment_export',$this->data);
	}
}
