<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function user_chart() {

        $user = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $labels = [];
        $data = [];
        $colors = ['#ff3562', '#1b1b3a', '#ff3562'];

        for($i=1; $i < 12; $i++){
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;
            foreach ($user as $item) { 
                if ($item->month == $i) {
                    $count = $item->count;
                    break;
                }
            }
            
            array_push($labels,$month);
            array_push($data, $count);
        }
        $datasets = [
            [
                'label' => 'Users',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];


        return view('admin.user_chart', compact('datasets', 'labels'));
    }
}
