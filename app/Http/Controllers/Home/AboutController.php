<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
//use Image;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function AboutPage()
    {

        $aboutpage = About::query()->find(1);
        // return view('admin.about_page.about_page_all',compact('aboutpage'));
        return view('admin.about_page.about_page_all', ['aboutpage' => $aboutpage]);

    } // End Method


    public function UpdateAbout(Request $request)
    {
        $about_id = 1;
        if (!empty($request->id))
            $about_id =  $request->id;
        $about = About::query()->find($about_id);

        $save_url = null;
        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(523, 605)->save('upload/home_about/' . $name_gen);
            $save_url = 'upload/home_about/' . $name_gen;

            //            About::findOrFail($about_id)->update([
            //                'title' => $request->title,
            //                'short_title' => $request->short_title,
            //                'short_description' => $request->short_description,
            //                'long_description' => $request->long_description,
            //                'about_image' => $save_url,
            //
            //            ]);

            //            $notification = array(
            //                'message' => 'About Page Updated with Image Successfully',
            //                'alert-type' => 'success'
            //            );

            // return redirect()->back()->with($notification);

        }
        //        else {
        //
        //            About::findOrFail($about_id)->update([
        //                'title' => $request->title,
        //                'short_title' => $request->short_title,
        //                'short_description' => $request->short_description,
        //                'long_description' => $request->long_description,
        //
        //            ]);
        //            $notification = array(
        //                'message' => 'About Page Updated without Image Successfully',
        //                'alert-type' => 'success'
        //            );
        //
        //            return redirect()->back()->with($notification);
        //
        //        } // end Else


        if ($about) {
            About::query()->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'About Page Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            About::query()->create([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'About Page Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

    } // End Method


    public function HomeAbout()
    {

        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));

    }// End Method


    public function AboutMultiImage()
    {

        return view('admin.about_page.multimage');


    }// End Method


    public function StoreMultiImage(Request $request)
    {

        $image = $request->file('multi_image');

        foreach ($image as $multi_image) {

            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($multi_image)->resize(220, 220)->save('upload/multi/' . $name_gen);
            $save_url = 'upload/multi/' . $name_gen;

            MultiImage::insert([

                'multi_image' => $save_url,
                'created_at' => Carbon::now()

            ]);

        } // End of the froeach


        $notification = array(
            'message' => 'Multi Image Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);


    }// End Method


    public function AllMultiImage()
    {

        $allMultiImage = MultiImage::all();
        // return view('admin.about_page.all_multiimage', compact('allMultiImage'));
        return view('admin.about_page.all_multiimage', ['allMultiImage' => $allMultiImage]);

    }// End Method


    public function EditMultiImage($id)
    {

        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));

    }// End Method


    public function UpdateMultiImage(Request $request)
    {

        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(220, 220)->save('upload/multi/' . $name_gen);
            $save_url = 'upload/multi/' . $name_gen;

            MultiImage::query()->findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.multi.image')->with($notification);

        }

    }// End Method


    public function DeleteMultiImage($id): RedirectResponse
    {
        $id = decrypt($id);
        $multi = MultiImage::query()->findOrFail($id);

        $img = $multi->multi_image;
        unlink($img);

        MultiImage::query()->findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method


}
