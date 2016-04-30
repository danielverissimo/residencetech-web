<?php namespace Residencetech\Apartmenttype\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class ApartmenttypesController extends Controller {

    protected $route = 'frontend.residencetech.apartmenttype.apartmenttypes';

	public function index()
	{
		return view('residencetech/apartmenttype::apartmenttypes/index');
	}

}
