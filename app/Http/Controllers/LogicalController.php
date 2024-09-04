<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logical;
use Log;
class LogicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logicals = Logical::all();
        return view('backendviews.logicals.logicals',compact('logicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backendviews.logicals.add_logical');
    }

    // function getReserveString($param, ){

        
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


      /**
 * @OA\Post(
 *     path="/api/logicals",
 *     summary="Store Queue",
 *     description="Store Queue",
 *     operationId="store Queue",
 *     tags={"Queue"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Queue",
 *         @OA\JsonContent(
 *             required={"type"},
 *                @OA\Property(property="type ", type="boolean", example="2"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Validation failed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Queue Updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Queue")
 *         )
 *     )
 * )
 */

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $logical = new Logical;
        if($request->type == 1){
            $blogTitle = $request->title;
            $reversed_string = ""; 
            for($i=strlen($blogTitle)-1; $i>=0; $i--)
            $reversed_string .= $blogTitle[$i];
            $logical->title =  $reversed_string;
            $logical->type = $request->type;
            $logical->save();
        }
        elseif($request->type == 2){
            $check_if_palindrome = "";
            // palindrome string
            $blogDescription = $request->title;
            $logical->type = $request->type;
            
            for($j=strlen($blogDescription)-1; $j>=0; $j--){
            $check_if_palindrome .= $blogDescription[$j];
            }
            if($blogDescription == $check_if_palindrome)
            $logical->title = $blogDescription;
            else
            $logical->title = "not a palindrome";
            $logical->save();
        }
        elseif($request->type == 3){
            // "a12b123c10a1"
            $logical->type = $request->type;
            $blogSeoTitle = $request->title;
            $count = 0;
            for($i=strlen($blogSeoTitle)-1; $i>=0; $i--){
                if($blogSeoTitle[$i] == "1" || $blogSeoTitle[$i] == "2" || $blogSeoTitle[$i] == "3" || $blogSeoTitle[$i] == "4" || $blogSeoTitle[$i] == "5" || $blogSeoTitle[$i] == "6" || $blogSeoTitle[$i] == "7" || $blogSeoTitle[$i] == "8" || $blogSeoTitle[$i] == "9" || $blogSeoTitle[$i] == "0")
                $count++; 
            }
            $logical->title = $count;
            $logical->save();
        }
        elseif($request->type == 4){
            $logical->type = $request->type;
        $char = $request->char;
        $blogSeoDescription = $request->title;


        $char_count = 0;
        for($k=strlen($blogSeoDescription)-1; $k>=0; $k--){
            if($char == $blogSeoDescription[$k]){
            $char_count++;
            }
        }
        $char = $char_count;
        $logical->title = $char_count;
        $logical->save();
        }
        elseif($request->type == 6){
         
            $asc = $request->title;
            // $integerArray[] = array($request->title);
            // return $integerArray;
            for($m=0; $m<strlen($request->title)-1; $m++){
                for($n=$m+1; $n<strlen($request->title); $n++){
                  if($asc[$m] > $asc[$n]){
                    $temp = $asc[$m];
                    $asc[$m] = $asc[$n];
                    $asc[$n] = $temp;
                  }
                }
            }
            $logical->title = $asc;
        }
        elseif($request->type == 7){
            $no1 = 0;
            $no2 = 1;
            $result = "";
            for($i=0; $i<$request->title; $i++){
                $result .= $no1;
                $no3 = $no1 + $no2;
                $no1 = $no2;
                $no2 = $no3;

            }
            $logical->title = $result;
            $logical->save();
        }
        elseif($request->type == 5){
            $logical->type = $request->type;

            $booleanArray1 = array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false);
            $result = "";
            $str1 = $request->title;
            $str2 = $request->char;

            for($i=0; $i<strlen($str1); $i++){
                for($j=0; $j<strlen($str2); $j++){
                    $found = false;
                    if($str1[$i] == $str2[$j]){
                        $found = true;
                        break;
                    }
                }

                if(!$found && !$booleanArray1[ord($str1[$i]) - ord('a')]){
                    $booleanArray1[ord($str1[$i]) - ord('a')] = true;
                    $result .= $str1[$i];
                    Log::info("result1");
                    Log::info($result);
                }
            }

            for($i=0; $i<strlen($str2); $i++){
                for($j=0; $j<strlen($str1); $j++){
                    $found = false;
                    if($str2[$i] == $str1[$j]){
                        $found = true;
                        break;
                    }
                }

                if(!$found && !$booleanArray1[ord($str2[$i]) - ord('a')]){
                    $booleanArray1[ord($str2[$i]) - ord('a')] = true;
                    $result .= $str2[$i];
                    Log::info("result2");
                    Log::info($result);
                }
            }

            $logical->title = $result;
            $logical->save();
            
        }
        return redirect('/logicals');

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

    public function list(){
        $logicals = Logical::all();
        return response()->json(['logicals'=> $logicals,'status' => 'success'],200);
        
    }
}