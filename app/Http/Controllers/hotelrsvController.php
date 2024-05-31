<?php

namespace App\Http\Controllers;

use App\Models\hotelrsv;
use App\Models\state;
use Illuminate\Http\Request;
use DateTime;

class hotelrsvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //Postのデータ全て$postsに代入(データ全件取得)
    
        /*  
            hotelrsvとstateテーブル結合
                                        */

        $hotels = hotelrsv::select([
            'h.id',
            'h.date1',
            'h.date2',
            'h.name',
            'h.email',
            'h.adult',
            'h.child',
            'h.senior',
            's.name as state',
            'h.price',
            'h.remarks',
        ])
        ->from('hotelrsv as h')
        ->join('state as s',function($join){
            $join->on('h.stateid','=','s.id');
        })
        ->orderBy('h.date1','DESC')
        ->paginate(5);

        if(isset(\Auth::user()->name)){
            return view('index',compact('hotels'))
                ->with('user_name',\Auth::user()->name)
                ->with('i',(request()->input('page',1)- 1) * 5); 
        }else{
            return view('index',compact('hotels'))
                ->with('i',(request()->input('page',1)- 1) * 5); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create')->with('success', '予約が登録されました。');;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $ad = $request->input(["adult"]);
        $chi = $request->input(["child"]);
        $sen = $request->input(["snior"]);

        $totalUser = $ad+$chi+$sen;
        if($totalUser === 0 || $totalUser > 10){
            return redirect()->route('hotels.index')->with('error', '宿泊者数の変更に不具合がありました。1人以上10人以下で設定してください。');
        }

        $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email',
            'remarks' => 'required|max:50'
        ]);

        
        
        $hotel_data = new hotelrsv;
        $hotel_data->date1 = $request->input(["checkin"]);
        $hotel_data->date2 = $request->input(["checkout"]);
        $hotel_data->name = $request->input(["name"]);
        $hotel_data->email = $request->input(["email"]);
        $hotel_data->adult = $request->input(["adult"]);
        $hotel_data->child = $request->input(["child"]);
        $hotel_data->senior = $request->input(["senior"]);
        $hotel_data->stateid = 1; //登録画面では予約中にする
        $total =  ($ad * 3000) + ($chi * 1000) + ($sen * 2000);
        $hotel_data->price = $total;
        $hotel_data->remarks = $request->input(["remarks"]);
        $hotel_data->save();
    
        return redirect()->route('hotels.index')->with('success', $hotel_data->name.'さんの予約情報が登録されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(hotelrsv $hotelrsv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $states = state::all();
        $hotel = hotelrsv::find($id);
        return view('edit')->with('hotel', $hotel)->with('states',$states);
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, hotelrsv $hotelrsv, $id)
    {
        $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email',
            'remarks' => 'required|max:50'
        ]);

        $ad = $request->adult;
        $chi = $request->child;
        $sen = $request->senior;

        $totalUser = $ad+$chi+$sen;
        if($totalUser === 0 || $totalUser > 10){
            return redirect()->route('hotels.index')->with('error', '宿泊者数の変更に不具合がありました。1人以上10人以下で設定してください。');
        }

        $week = array("日", "月", "火", "水", "木", "金", "土");
        $in = $request->checkin;
        $out = $request->checkout;
        $nfd = (strtotime($out) - strtotime($in)) / 86000;

        dd($request);

        for($i=0; $i < $nfd; $i++){
            if(!($i==0)){
                $date = new DateTime($date);
            }else{
                $date = new DateTime($in);
            }
            //$date->modify('+1 day');
            $w = (int)$date->format('w');
            if($week[$w]===1 || $week[$w]===7){
                /* 土日が含まれた時点でブレイクする */
                $flag = true;
                break;
            }
            $date->addDay();
        }
        $total = ($ad * 3000) + ($chi * 1000) + ($sen * 2000);
        if($flag === true) {
            $total = $total + ($total*extraCharge); 

        }else{

        }
        
        $hotel = hotelrsv::find($id);
        $hotel->date1 = $request->checkin;
        $hotel->date2 = $request->checkout;
        $hotel->name = $request->name;
        $hotel->email = $request->email;
        $hotel->adult = $request->adult;
        $hotel->child = $request->child;
        $hotel->senior = $request->senior;
        $hotel->stateid = $request->state;
        $total =  ($ad * 3000) + ($chi * 1000) + ($sen * 2000);
        $hotel->price = $total;
        $hotel->remarks = $request->remarks;  

        $hotel->save();    
        return redirect()->route('hotels.index')->with('success', $hotel->name.'さんの予約情報が更新されました。');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(hotelrsv $hotelrsv)
    {
        //
    }
}
