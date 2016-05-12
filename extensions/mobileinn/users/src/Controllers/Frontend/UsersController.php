<?php namespace Mobileinn\Users\Controllers\Frontend;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Container\Container;
use Platform\Foundation\Controllers\Controller;
use Platform\Users\Repositories\UserRepositoryInterface;

use Session;

class UsersController extends Controller {

    /**
     * The Users repository.
     *
     * @var \Platform\Users\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Constructor.
     *
     * @param  \Platform\Users\Repositories\UserRepositoryInterface  $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->users = $users;

        $this->beforeFilter('guest', [ 'except' => 'logout' ]);
    }

    /**
     * Show the form for logging the user in.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        $connections = $this->users->auth()->getSocialConnections();

        return view('platform/users::auth/login', compact('connections'));
    }

    /**
     * Handle posting of the form for logging the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin()
    {
        // Register the user
        list($messages) = $this->users->auth()->login(request()->all());

        // Do we have any errors?
        if ( ! $messages)
        {
            $this->alerts->success(
                trans('platform/users::auth/message.success.login')
            );

            $user = Sentinel::getUser();

            $currentApartmentComplex = eloquent_get($user, 'person.apartmentComplexes');

            if ($currentApartmentComplex->count() > 0)
            {
                Session::put('current_apartmentcomplex', [
                    'id' => $currentApartmentComplex->first()->id,
                    'name' => $currentApartmentComplex->first()->name
                ]);
            }

            return redirect()->intended('/');
        }

        $this->alerts->error($messages);

        return redirect()->back();
    }

    /**
     * User logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->users->auth()->logout();

        return redirect('/');
    }

}
