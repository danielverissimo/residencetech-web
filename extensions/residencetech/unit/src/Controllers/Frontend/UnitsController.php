<?php namespace Residencetech\Unit\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class UnitsController extends Controller {

    protected $route = 'frontend.residencetech.unit.units';

	public function index()
	{
		return view('residencetech/unit::units/index');
	}

}
