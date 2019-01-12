<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HQController extends Controller
{
    public function phpinfo()
    {
        phpinfo();
    }

    public function whoAmI()
    {
        $email = session('email');
        $lead = \App\Lead::findByEmailOrId($email);

        echo "Email from session: $email<br />";
        echo "<br />Lead details:<br />";
        dd($lead);
    }

    public function sessionDestroy()
    {
        Session::flush();
        echo "Session destroyed.<br />output of session()->all():<br />";
        dump(session()->all());
    }

    public function session()
    {
        dump(session()->all());
    }

    public function test()
    {
        echo "<br />TEST";
//        $file = base_path('desktop.ini');
//
////        $result = S3::uploadResume($externalFilePath, $externalFilePath);
//        $result = S3::readResume($file);
//
//        dump("FINISHED writing to `$file` with result=$result");
    }
}
