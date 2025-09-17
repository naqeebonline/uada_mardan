<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Session;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use File;
use DB;
use URL;
use PDF;
use Mail;

class LoginControllor extends Controller
{
	
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
	

	
    public function logout(Request $request) {
        $request->session()->flush();
        //$request->session()->regenerate();
        return redirect('/login');
    }
	

}
