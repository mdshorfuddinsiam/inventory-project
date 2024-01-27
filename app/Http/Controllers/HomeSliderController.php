<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    
	public function homeSliderEdit(){
		// dd(5);
		$homeSlider = HomeSlider::latest()->first();
		return view('admin.home-slider.edit', compact('homeSlider'));
	}

	public function homeSliderUpdate(Request $request, $id){
		// dd($request->all());
		// dd($id);
		
		$homeSlider = HomeSlider::find($id);

		if($request->file('image')){
			if(file_exists($homeSlider->image)){
				unlink($homeSlider->image);
			}
			$file = $request->file('image');
			$imageName = 'image-'.time().'.'.$file->getClientOriginalExtension();
			$directory = 'upload/homeslider-images/';
			// $file->move($directory, $imageName);
			Image::make($file)->resize(636, 852)->save($directory.$imageName);
			$imgPath['image'] = $directory.$imageName;
			// dd($imgPath);

			$data = array_merge($request->all(), $imgPath);
			$homeSlider->update($data);

			$notification = [
	            'message' => 'Profile upadeted with image successfully!!',
	            'alert-type' => 'success'
	        ];
	    	return redirect()->back()->with($notification);
		}else{
			$imgPath['image'] = $homeSlider->image;

			$data = array_merge($request->all(), $imgPath);
			$homeSlider->update($data);

			$notification = [
	            'message' => 'Profile upadeted without image successfully!!',
	            'alert-type' => 'success'
	        ];
	    	return redirect()->back()->with($notification);
		}

		
	}

}
