<?php namespace Residencetech\Ocurrence\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class OcurrencesController extends Controller {

    protected $route = 'frontend.residencetech.ocurrence.ocurrences';

	public function index()
	{
		return view('residencetech/ocurrence::ocurrences/index');
	}

}
