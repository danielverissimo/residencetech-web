<?php namespace Mobileinn\People\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class PeopleController extends Controller {

    protected $route = 'frontend.mobileinn.people.people';

	public function index()
	{
		return view('mobileinn/people::people/index');
	}

}
