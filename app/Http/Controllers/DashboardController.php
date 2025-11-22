<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTables;
use App\Models\DashboardModel;
use App\Models\LocationModel;
use Illuminate\Support\Facades\Auth;
use PDO;
use App\Services\ConnectionSqlServer_ERP;
class DashboardController extends Controller
{
    public function dashboard_v1(){
        return view('dashboard.dashboard_v1',[
            'title'     =>  'Dashboard V1',
            'active_gm' =>  'Dashboard',
            'active_m'  =>  'dashboard_v1',
            
        ]);
    }
}
