<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeType;

class BadgeTypeController extends Controller
{
    	public function badgeType()
    	{
    		$BadgeTypes = BadgeType::all();
    		// dd($BadgeType);
    		return view('user.admin.badge-type',compact('BadgeTypes'));
    	}

    	public function getBadgeType(Request $request)
    	{
    		$getBadgeType = BadgeType::find($request->id);
    		return response()->json(['getBadgeType' => $getBadgeType]);

    	}
    	 public function updateBadgeType(Request $request)
    {
    	$updateBadgeTypeRecord = BadgeType::find($request->id);
    	$updateBadgeTypeRecord->title = $request->title; 
		$updateBadgeTypeRecord->price = $request->price;
        $updateBadgeTypeRecord->double_side_price = $request->ds_price;
        $updateBadgeTypeRecord->available = $request->available;
		$updateBadgeTypeRecord->save();
    	return response()->json(['msg' => 'data updated successfully']);
		
    }

    }
