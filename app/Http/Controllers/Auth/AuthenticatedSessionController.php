<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

            
             
        $request->authenticate();

        $request->session()->regenerate();

      
      
        $rolname = "";// inicializa el arreglo de nombres vacío

        foreach (auth()->user()->roles as $role) {
           $rolname = $role->name; // agrega el nombre del usuario al arreglo de nombres
             }


      

        //condicion de supervisor
         if ($rolname == 'Supervisor' && str_contains($request->url(), env('APP_URL_WEB'))) {
            $request->authenticate();

            $request->session()->regenerate();
            return redirect()->route('enviar_supervisor.index');
        } 
        else if ($rolname == 'Supervisor' && str_contains($request->url(), env('APP_URL_VPN'))) {
            $request->authenticate();

            $request->session()->regenerate();
            return redirect()->route('enviar_supervisor.index');
         }
       else  if ($rolname == 'Admin' && str_contains($request->url(), env('APP_URL_WEB'))) {
        $request->authenticate();

        $request->session()->regenerate();
        return to_route('enviar_admin.index');

             }
             else  if ($rolname == 'Admin' && str_contains($request->url(), env('APP_URL_VPN'))) {
                $request->authenticate();

            $request->session()->regenerate();
            return to_route('enviar_admin.index');
    
                 }
                 else  if ($rolname == 'Customer' && str_contains($request->url(), env('APP_URL_WEB'))) {
                    $request->authenticate();
    
                   $request->session()->regenerate();
                   return redirect('/productos');
        
                     }
                     else  if ($rolname == 'Customer' && str_contains($request->url(), env('APP_URL_VPN'))) {
                        $request->session()->invalidate();

                        $request->session()->regenerateToken();
                        return redirect('/');
                         }

        else {
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');


        } 
 


       /* 

         
           if ($rolname == "Supervisor") {
            return to_route('enviar_supervisor.index');
        } else{
            if($rolname == "Admin")
            {
                return to_route('enviar_admin.index');
            }
            else {
                if($rolname == 'Customer'){
                    return redirect('/productos');
                }else{
                    return redirect('/login'); 
                }
            }
        }  */
        //return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::user()->revokePermissionTo(['/dashboard.edit','/Dashboard/User/status.status']);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
