<?php

use App\Models\User;
use Carbon\Carbon;

if (!function_exists('bmi')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function bmi($weight, $height)
    {
        $height = $height / 100;
        $bmi = 0.00;
        //  if ($unit == "Metric") {
        //BMI = weight (kg) ÷/ ( height * height  ) in Meter
        $bmi = ($weight / ($height * $height));
        //    }
//        if ($unit == "Imperial") {
//            //BMI = weight (lb) x (height inch  * height inch ) x 703
//            $bmi = ($mass / ($height * $height)) * 703;
//        }
        return $bmi;
    }

    function bmi_weight($bmi)
    {
        $output = "";
        /*
         Less than 15	Very severely underweight
         Between 15 and 16	Severely underweight
         Between 16 and 18.5	Underweight
         Between 18.5 and 25	Normal (healthy weight)
         Between 25 and 30	Overweight
         Between 30 and 35	Moderately obese
         Between 35 and 40	Severely obese
         Over 40	Very severely obese
         */
        if ($bmi < 15) {
            $output = "Very severely underweight";
        } else if ($bmi >= 15 && $bmi < 16) {
            $output = "	Severely underweight";
        } else if ($bmi >= 16 && $bmi < 18.5) {
            $output = "	Underweight";
        } else if ($bmi >= 18.5 && $bmi < 25) {
            $output = "Normal (healthy weight)";
        } else if ($bmi >= 25 && $bmi < 30) {
            $output = "Overweight";
        } else if ($bmi >= 30 && $bmi < 35) {
            $output = "Moderately obese";
        } else if ($bmi >= 35 && $bmi < 40) {
            $output = "Severely obese";
        } else {
            $output = "Very severely obese";
        }
        return $output;
    }


    function body_fat($age, $bmi)
    {
////        Body Fat Formula for Men
//
////        Factor 1    (Total body weight x 1.082) +94.42
//        $f1= ($weight * 1.082) + 94.42;
////Factor 2	Waist measurement x 4.15
//        $f2 = $waist * 4.15;
////Lean Body Mass	Factor 1 - Factor 2
//        $lbm = $f1 - $f2;
////Body Fat Weight	Total bodyweight - Lean Body Mass
//        $bfw = $weight - $lbm;
////Body Fat Percentage(Body Fat Weight x 100) / total bodyweight
//        $bfp = ($bfw * 100) / $weight;
//
//        return $bfp;


        //        Body Fat Formula for adult men (BMI method)
        $bfp = 1.20 * $bmi + 0.23 * $age - 16.2;
        return $bfp;


    }


    function pindex($weight, $height)
    {
//        pondreal index Formula in metric  KG
        $height = $height / 100;

        $pi = $weight / pow($height, 3);


        return $pi;


    }

//    Basal Metabolic Rate (BMR)
    function bmr($weight, $height,$age)
    {
//        BMR: (Katch-McArdle Formula)  in metric  KG
      //  $bmr = 370 + 21.6 * (1 - $bodyfat) * $weight;

//        Mifflin-St Jeor Equation for male:
        $bmr = 10*$weight + 6.25*$height - 5*$age + 5;

        return $bmr;

    }

//        Body Surface Area:(Mosteller formula:)
    function bsa($weight, $height)
    {
//        Body Surface Area:(Mosteller formula:)
        $bsa =  0.016667 * pow($weight, 0.5) *pow($height, 0.5);

        return $bsa;

    }

    function sum($post_id,$table)
    {
        $data = [];
        $calories = 0;
        $fat = 0;
        $protein = 0;
        $carbohydrate = 0;
        $sugars = 0;

        foreach ($table as $row) {
            $calories = $calories +  DB::table('food')
                    ->where('id', $row->food_id)->sum('calories');

            $fat = $fat +  DB::table('food')
                    ->where('id', $row->food_id)->sum('fat');

            $protein = $protein +  DB::table('food')
                    ->where('id', $row->food_id)->sum('protein');

            $carbohydrate = $carbohydrate +  DB::table('food')
                    ->where('id', $row->food_id)->sum('carbohydrate');

            $sugars = $sugars +  DB::table('food')
                    ->where('id', $row->food_id)->sum('sugars');
            $data['calories'] = $calories;
            $data['fat'] =$fat;
            $data['protein'] = $protein;
            $data['carbohydrate'] = $carbohydrate;
            $data['sugars'] =$sugars;

        }
     return $data;
    }




    function user_this_month(){
        $today = Carbon::now();
        return User::whereBetween('created_at', [$today->startOfMonth()->startOfDay()->format('Y-m-d H:i:s'), $today->endOfMonth()->endOfDay()->format('Y-m-d H:i:s')])->count();
    }

    function user_last_month(){
        $start = Carbon::now()->subMonth()->startOfMonth()->startOfMonth()->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::now()->subMonth()->startOfMonth()->endOfMonth()->endOfDay()->format('Y-m-d H:i:s');
        return User::whereBetween('created_at', [$start, $end])->count();
    }



    function cm_to_feet($cm)
    {

        $data = [];
// convert centimetres to inches
        $inches = round($cm/2.54);

// now find the number of feet...
        $feet = floor($inches/12);

// ..and then inches
        $inches = ($inches%12);

// you now have feet and inches, and can display it however you wish
        $data['feet'] =$feet;
        $data['inches'] =$inches;
        $data['cm'] =$cm;

        return $data;
    }
}
