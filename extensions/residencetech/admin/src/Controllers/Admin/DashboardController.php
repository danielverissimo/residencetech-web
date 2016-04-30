<?php namespace Residencetech\Admin\Controllers\Admin;
/**
 * Part of the Platform Admin extension.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Platform Admin extension
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Platform\Access\Controllers\AdminController as ParentController;

use View;
use Asset;
use URL;
use File;

class DashboardController extends ParentController {

	protected $settings;

	public function __construct()
	{
		parent::__construct();


	}

	/**
	 * Returns the index view for the admin theme.
	 *
	 * @return mixed
	 */
	public function index()
	{

		return View::make('mobileinn/admin::index' , compact('files', 'logo'));
	}

}
