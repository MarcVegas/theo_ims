<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;

class BackupController extends Controller
{
    public function backup(){
        /* $databaseName = 'theo_ims';
        $userName = 'root';

        try {
            MySql::create()
            ->setDbName($databaseName)
            ->setUserName($userName)
            ->setPassword('')
            ->dumpToFile('dump.sql');
        } catch (\Exception $e) {
            return redirect('/settings')->with('error', $e->getMessage());
        } */

        return redirect('/settings')->with('success', 'Feature currently unavailable');
    }
}
