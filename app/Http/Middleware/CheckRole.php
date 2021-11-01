<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next)
    {
        $roles = $this->getRoles();

        if (session()->has('role')){

        if (in_array(session('role'), $roles, true)) {
//            if (session('role') === 2) {
//
//                return response()->view('livewire.admin.admin-index');
//            }
//


            if (session('role') === 2) {
                return redirect()->route('teacher.dashboard');
            }

            if (session('role') === 1) {
                return redirect()->route('admin.dashboard');
            }
        }



        }


        return $next($request);
    }

    public function getRoles(): array
    {
        $ids = Roles::all('id');
        foreach ($ids as $id) {
            $roles[] = $id['id'];
        }
        return $roles;
    }

}
