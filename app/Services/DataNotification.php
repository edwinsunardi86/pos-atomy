<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataNotification 
{
    private $data = [];

    public function fillNotificationFollowUp(array $data){
        // $this->data = DB::table('aging_a_r_progress')
        // ->select('invoice_number','next_follow_up_date')
        // ->where('created_by', Auth::id())
        // ->where('next_follow_up_date','>', date('Y-m-d'))->get();
        $this->data = $data;
    }

    public function getNotificationFollowUp(){
        return $this->data;
    }
}
?>