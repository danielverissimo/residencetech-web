<?php namespace Mobileinn\Users\Repositories;
/**
 * Part of the Platform Users extension.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Platform Users extension
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Cartalyst\Sentinel\Users\UserInterface;
use Platform\Users\Repositories\UserRepository as BaseDbUserRepository;

class UserRepository extends BaseDbUserRepository
{
    public function findByToken($token)
    {
        return $this->createModel()
            ->select('users.*', 'persistences.code')
            ->join('persistences', function($join)
            {
                $join->on('users'.'.id', '=', 'persistences.user_id');
            })
            ->where('persistences.code', $token)
            ->first();
    }
}