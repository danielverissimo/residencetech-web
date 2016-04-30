<?php namespace Residencetech\Block\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class BlocksController extends Controller {

    protected $route = 'frontend.residencetech.block.blocks';

	public function index()
	{
		return view('residencetech/block::blocks/index');
	}

}
