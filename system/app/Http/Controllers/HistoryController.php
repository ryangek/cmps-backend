<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_source($what)
    {
        $data = [];


        /* Daily Data History */
        if ($what == "Daily") {
            for ($i=0; $i < 24; $i++) { 
                if ($i < 10){
                    $date = date("Y-m-d ")."0".$i.":";
                    $data[] = ['name' => "0".$i.":00", 'count' => History::where('created_at', 'like', $date.'%')->count()];
                }
                else{
                    $date = date("Y-m-d ").$i.":";
                    $data[] = ['name' => $i.":00", 'count' => History::where('created_at', 'like', $date.'%')->count()];
                }
                
            }
        }

        /* Weekly Data History */
        if ($what == "Weekly") {
            $name = ['จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส', 'อา']; $j = 0;
            $startOfWeek = date("Y-m-d", strtotime("Monday this week"));
            $day = date("d", strtotime($startOfWeek . " + 1 day"));
            for ($i=1; $i <= $day+7; $i++) {
                if (($i >= $day) && (($i-$day)<7)) {
                    if ($i < 10)
                        $date = date("Y-m-")."0".$i;
                    else
                        $date = date("Y-m-").$i;
                    $data[] = ['name' => $name[$j++], 'count' => History::where('created_at', 'like', $date.'%')->count()];
                }       
            }
        }

        /* Monthly Data History */
        if ($what == "Monthly") {
            for ($i=1; $i <= 30; $i++) { 
                if ($i < 10)
                    $date = date("Y-m-")."0".$i;
                else
                    $date = date("Y-m-").$i;
                $data[] = ['name' => $i, 'count' => History::where('created_at', 'like', $date.'%')->count()];
            }
        }

        /* Yearly Data History */
        if ($what == "Yearly") {
            $name = [
                'ม.ค.',
                'ก.พ.',
                'มี.ค.',
                'เม.ย.',
                'พ.ค.',
                'มิ.ย.',
                'ก.ค.',
                'ส.ค.',
                'ก.ย.',
                'ต.ค.',
                'พ.ย.',
                'ธ.ค.',
            ];
            for ($i=1; $i <= 12; $i++) { 
                if ($i < 10)
                    $date = date("Y-")."0".$i;
                else
                    $date = date("Y-").$i;
                $data[] = ['name' => $name[$i-1], 'count' => History::where('created_at', 'like', $date.'%')->count()];
            }
        }

        /* Yearly Data History */
        if ($what == "Galaxy") {
            for ($i=1; $i <= 3000; $i++) { 
                if ($i < 10)
                    $date = "000".$i;
                if ($i < 100)
                    $date = "00".$i;
                if ($i < 1000)
                    $date = "0".$i;
                else
                    $date = $i;
                $data[] = ['id' => $i, 'count' => History::where('created_at', 'like', $date.'%')->count()];
            }
        }

        return response()->json(["data" => $data], 200);
        
        //return response()->json(['daily' => $data], 200);
        //return response()->json(['weekly' => $data], 200);
        //return response()->json(['monthly' => $data], 200);

        // $year = date("Y"); // Year 2010
        // $week = "01"; // Week 1

        // $date1 = date( "l, M jS, Y", strtotime($year."W".$week."1") ); // First day of week
        // $date2 = date( "l, M jS, Y", strtotime($year."W".$week."7") ); // Last day of week
        // echo $date1 . " - " . $date2;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
