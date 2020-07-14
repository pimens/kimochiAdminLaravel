<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    function index()
    {
        return View('login');
    }
    function beranda()
    {
        return View('beranda');
    }
    public function loginPost(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        $data = User::where('email', $email)->first();
        if ($data) { //apakah email tersebut ada atau tidak
            if ($password == $data->password) {
                session(['name' => $data->username]);
                // Session::put('name',$data->name);
                return redirect('/makanan')->with('alert', 'Berhasil Login');
                // Session::put('name',$data->name);
                // Session::put('email',$data->email);
                // Session::put('login',TRUE);
                // return redirect('home_user');
            } else {
                echo "not login";
                return redirect('/')->with('alert', 'Password atau Email, Salah !');
            }
        } else {
            return redirect('/')->with('alert', 'Password atau Email, Salah!');
        }
    }
    function logout()
    {
        Session()->flush();
        return redirect('/')->with('alert', 'Logout Success');
    }
}
