<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ampere;
use App\Models\Charge;
use App\Models\Range;

class UserController extends Controller
{
    public function index(){
        //$resulta['a_unit']= DB::table('a_unit')->get();
        $resulta['a_unit']= Ampere::all();
        //$x = new Ampere();
        //dd($x);
        $resulta['unit']=null;
        $resulta['ampere_id']=0;
        //$resulta['ampere_id']=null;
        return view('name',$resulta);


        
    }
    public function process(Request $req){
        $mincharge=0;
        $result=0;
        //dd('hello');
        //$resulta=[];     
        
        $aid = $req->input('amp');
        $resulta['ampere_id']=$aid;
        //dd($resulta);
        //$data= DB::table('amount')->where('a_id',$aid)->get();
         $data= Charge::where('a_id',$aid)->get();
         //dd($data);
         $c_aRange= Range::get();
         //dd($c_aRange);
         //dd($data);
        $resulta['data2']=$data;
        $resulta['c_aRange']=$c_aRange;
        //dd($c_aRange);
        $unit = $req->input('tarea');
        // $resultOfA['unit']=$unit;
        $resulta['unit']=$unit;
        //$showdata=[];
        
        // dd($data);



        foreach($data as $d)
        {
            $c_range=DB::table('c_unit')->find($d->c_id);
            $range=explode("-", $c_range->kw_hr);
            //dd($range);
            $unit=(float)$unit;
            $amp=DB::table('a_unit')->find($d->a_id);
            // dd($c_range);
            if($range[0]<=$unit && $range[1]>=$unit){
                $resulta['range']=$c_range;
                $resulta['ampere']=$amp;
                $resulta['data']=$d;
                $result+=$d->minimum;
                $mincharge+=$d->minimum;
                $runit=$unit-(int)$range[0];
                $resulta['runit']=$runit;
                $ch=$runit*$d->rate;
                $result+=$ch;
                //dd($result);
               

                $resulta['message']="you have selected ".$amp->ampere." ampere";
                
            }
            elseif($range[0]<=$unit && $range[1]<=$unit){
                $result+=$d->minimum;
                $mincharge+=$d->minimum;
            }
         
       

        }
      
        
        $resulta['result']=$result;
        //dd($mincharge);
        $resulta['mincharge']=$mincharge;
        $resulta['a_unit']= DB::table('a_unit')->get();

        return view('name',$resulta);
        //return $result;

       
        
    }
    
}
