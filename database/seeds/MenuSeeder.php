<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MenuSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$menuRepository = app('platform.menus');

		$admin = $menuRepository->findWhere('slug', 'admin');
		$platform = $menuRepository->createModel();
		$platform->name = 'Plataforma';
		$platform->slug = 'admin-platform';
		$platform->class = 'fa fa-bolt';
		$platform->uri = 'platform';
		$platform->makeFirstChildOf($admin);

		$extensions = [
			'admin-locations',
			'admin-mobileinn-people',
			'admin-platform',
		];

		foreach ($admin->findChildren() as $menu)
		{
			if (in_array($menu->slug, $extensions)) continue;

			$menu->makeLastChildOf($platform);
		}
	}
}