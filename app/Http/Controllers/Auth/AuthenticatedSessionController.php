<?php
//
//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Http\Requests\Auth\LoginRequest;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Route;
//use Inertia\Inertia;
//use Inertia\Response;
//
//class AuthenticatedSessionController extends Controller
//{
//    /**
//     * Display the login view.
//     */
//    public function create(): Response
//    {
//        return Inertia::render('Auth/Login', [
//            'canResetPassword' => Route::has('password.request'),
//            'status' => session('status'),
//        ]);
//    }
//
//    /**
//     * Handle an incoming authentication request.
//     */
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        return redirect()->intended(route('dashboard', absolute: false));
//    }
//
//    /**
//     * Destroy an authenticated session.
//     */
//    public function destroy(Request $request): RedirectResponse
//    {
//        Auth::guard('web')->logout();
//
//        $request->session()->invalidate();
//
//        $request->session()->regenerateToken();
//
//        return redirect('/');
//    }
//}
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Ldap\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use LdapRecord\Auth\BindException;
use LdapRecord\Container;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthenticatedSessionController extends Controller
{
    use AuthenticatesWithLdap;

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     * case 1 :normal user
     * case 2 : freeIPA user
     * use_ldap is set the case if tru or false
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if ($request->boolean('use_ldap')) {
            if ($this->attemptLdapLogin($request)) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard', absolute: false));
            }
            else{
                return back()->withErrors([
                    'email' => 'The provided credentials are invalids.',
                ]);
            }
        } else {
            $request->authenticate();
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', absolute: false));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * process login with freeIPA , get the connection default and set the credentials and check if connecting success use authLdap function to check user if exist in system or not ( add it) and login in with this user
     */
    protected function attemptLdapLogin(Request $request)
    {
        try {
            $connection = Container::getConnection('default');
            $username = $request->email;
            $password = $request->password;
            $dn = "uid={$username},cn=users,cn=accounts,dc=demo1,dc=freeipa,dc=org";
            if ($connection->auth()->attempt($dn, $password)){
                $request->authLdap($username,$password);
                return true;
            }else{
                return  false;
            }
        } catch (BindException $e) {
            Log::error('Failed to bind to LDAP server: ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return false;
        }
    }
}
