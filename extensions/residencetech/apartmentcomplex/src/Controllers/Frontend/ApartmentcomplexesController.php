<?php namespace Residencetech\Apartmentcomplex\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class ApartmentcomplexesController extends Controller {

    protected $route = 'frontend.residencetech.apartmentcomplex.apartmentcomplexes';

	public function index()
	{
		return view('residencetech/apartmentcomplex::apartmentcomplexes/index');
	}

}
