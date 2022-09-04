<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeBledSize;
use App\BadgeSize;

class BadgeBledsizeController extends Controller
{
    public function badgeBledsize()
    {
    	$BadgeBledSizeShow = BadgeBledSize::all();
    	// dd($BadgeBledSizeShow);
    	return view('user.admin.badge-bled-size',compact('BadgeBledSizeShow'));
    }
    public function insertBadgeBledSize(Request $request)
    {
    	$badgeBledSize = new BadgeBledSize;	
        $badgeBledSize->title = $request->bbs_title;
    	$badgeBledSize->price = $request->bb_price;
    	$badgeBledSize->save();

    	
    	return redirect()->back();
    }

    public function getBadgeBledRecord(Request $request)
    {
    	$getBadgeBledRecord = BadgeBledSize::find($request->id);

    	return response()->json(['getBadgeBledRecord' => $getBadgeBledRecord]);
    	
    }
    public function updateBadgeBledRecord(Request $request)
    {
    	$updateBadgeBledRecord = BadgeBledSize::find($request->id);
    	$updateBadgeBledRecord->title = $request->title; 
		$updateBadgeBledRecord->price = $request->price;
        $updateBadgeBledRecord->double_side_price = $request->ds_price;
		$updateBadgeBledRecord->save();
    	return response()->json(['msg' => 'data updated successfully']);
		
    }
    public function deleteBadgeBled(Request $request)
	{
      	// dd($id);
		$deleteBadgeBled = BadgeBledSize::find($request->id);
		$deleteBadgeBled->delete();
		// dd($deleteBadgeBled);

		return response()->json(['success' => true]);
	}

    public function getBadgesSizeImage(Request $request)
    {
        // dd($request->all());
        $badge_size = BadgeSize::where('id' , $request->badge_size_id)->first();
        // dd($badge_size);
        return  response()->json([
        'badge_size'=>$badge_size,
        ]);
    }

}
