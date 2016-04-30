<?php namespace Residencetech\Admin\Widgets;

use Exception;
use Platform\Menus\Repositories\MenuRepositoryInterface;
use Platform\Permissions\Repositories\PermissionsRepositoryInterface;
use Route;
use Sentinel;
use URL;
use View;
use Log;

class Nav {

	/**
	 * Menus repository.
	 *
	 * @var \Platform\Menus\Repositories\MenuRepositoryInterface
	 */
	protected $menus;

	/**
	 * Permissions repository.
	 *
	 * @var \Platform\Users\Repositories\PermissionsRepositoryInterface
	 */
	protected $permissions;

	/**
	 * Holds the current request path information.
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * Holds all registered routes.
	 *
	 * @var array
	 */
	protected $allRoutes;

	/**
	 * Holds all available permissions.
	 *
	 * @var array
	 */
	protected $allPermissions;

	/**
	 * Constructor.
	 *
	 * @param  \Platform\Menus\Repositories\MenuRepositoryInterface
	 * @return void
	 */
	public function __construct(MenuRepositoryInterface $menus, PermissionsRepositoryInterface $permissions)
	{
		$this->menus = $menus;
		$this->permissions = $permissions;

		$this->path = URL::current();
		$this->allRoutes = Route::getRoutes()->getRoutes();

		$this->getPermissions($this->permissions);
		// Log::info("--- ALL PERMISSIONS --- ");
		// Log::info($this->allPermissions);
//		dd($this->allPermissions);

		/*
		foreach ($this->permissions->findAll() as $extension)
		{
			foreach ($extension as $permission)
			{
				if (strpos($permission['permission'], ',') === false)
				{
					$this->allPermissions[] = $permission['permission'];
				}
				elseif (strpos($permission['permission'], '@') !== false)
				{
					list($class, $methods) = explode('@', $permission['permission']);

					$methods = explode(',', $methods);

					foreach ($methods as $method)
					{
						$this->allPermissions[] = $class.'@'.$method;
					}
				}
			}
		}
		*/
	}

	protected function getPermissions($permissions){


		foreach ($permissions->findAll() as $group)
		{
			foreach ($group->all() as $permission){

				$controller = $permission->get('controller');

				$methods = $permission->get('methods');
				if ( $methods ){
					foreach ($methods as $method) {
						$this->allPermissions[] = $controller . '@' . $method;
					}
				}
			}

		}
	}

	/**
	 * Returns navigation HTML based off the current active menu.
	 *
	 * @param  string  $slug
	 * @param  string  $depth
	 * @param  string  $cssClass
	 * @param  string  $beforeUri
	 * @param  string  $view
	 * @return \View
	 */
	public function show($slug, $depth = 0, $cssClass = null, $beforeUri = null, $view = null)
	{
		try
		{
			// Get the menu children
			$children = $this->getChildrenForSlug($slug, $depth);

			// Loop through and prepare the child for display
			foreach ($children as $key => $child)
			{

				$this->prepareChildRecursively($child, $beforeUri);

				if (($child->hasChildren && ! $child->children) || ( ! $child->hasChildren && ! $this->checkChildPermission($child)))
				{
					unset($children[$key]);
				}
			}

			$view = $view ?: 'platform/menus::widgets/nav';

			return View::make($view, compact('children', 'cssClass'));
		}
		catch (Exception $e)
		{
			return;
		}
	}

	/**
	 * Returns the children for a menu with the given slug.
	 *
	 * @param  string  $slug
	 * @param  int	 $depth
	 * @return array
	 */
	protected function getChildrenForSlug($slug, $depth = 0)
	{
		if ($menu = $this->menus->find($slug))
		{
			$loggedIn = Sentinel::check();

			$visibilities = [
				'always',
				$loggedIn ? 'logged_in' : 'logged_out',
			];

			$groups = $loggedIn ? Sentinel::getRoles()->lists('id') : null;

			if ($loggedIn and Sentinel::hasAccess('admin')) $visibilities[] = 'admin';

			return $menu->findDisplayableChildren($visibilities, $groups, $depth);
		}

		return [];
	}

	/**
	 * Recursively prepares a child for presentation within the nav widget.
	 *
	 * @param  \Platform\Menus\Models\Menu  $child
	 * @param  string  $beforeUri
	 * @return void
	 */
	protected function prepareChildRecursively($child, $beforeUri = null)
	{
		// Prepare the options array
		$options = [
			'before_uri' => $beforeUri,
		];

		// Get this item children
		$child->children = $child->getChildren();

		// Prepare the target
		$child->target = "_{$child->target}";

		// Prepare the uri
		$child->uri = $child->getUrl($options);

		// Do we have a regular expression for this item?
		if ($regex = $child->regex)
		{
			// Make sure that the regular expression is valid
			if (@preg_match($regex, $this->path))
			{
				$child->isActive = true;
			}
		}

		// Check if the uri of the item matches the current request path
		elseif ($child->uri === $this->path)
		{
			$child->isActive = true;
		}

		// Check if this item has sub items
		$child->hasSubItems = ($child->children and $child->depth > 1);

		// Recursive!
		$children = $child->children;

		foreach ($child->children as $key => $grandChild)
		{
			$this->prepareChildRecursively($grandChild, $beforeUri);

			if (($grandChild->hasChildren && ! $grandChild->children) || ( ! $grandChild->hasChildren && ! $this->checkChildPermission($grandChild)))
			{
				unset($children[$key]);
			}
		}

		$child->hasChildren = $child->children ? true : false;
		$child->children = $children;
	}

	public function checkChildPermission($child)
	{
		if (Sentinel::hasAccess('superuser')) return true;

		foreach ($this->allRoutes as $route)
		{

			if (URL::to($route->getUri()) !== $child->uri) continue;

			if ( in_array($route->getActionName(), $this->allPermissions) ) return true;

			//return Sentinel::hasAccess($route->getActionName());
		}

		return false;
	}

}
