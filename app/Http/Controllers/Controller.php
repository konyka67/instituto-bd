<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function refreshDB($tableName)
    {
        $max = DB::table($tableName)->max('id') + 1;
        DB::statement("ALTER TABLE ".$tableName." AUTO_INCREMENT =  $max");
    }

}
