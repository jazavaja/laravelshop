<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index(Request $request){
        $currentUrl = url()->current().'?container='.$request->container;
        if ($request->container == 0){
            $galleries = Gallery::latest()->latest()->paginate(40)->setPath($currentUrl);
        }elseif ($request->container == 1){
            $galleries = Gallery::latest()->whereIn('type', ['gif','webp','jpeg','jpg','png','svg','tif','jfif'])->paginate(40)->setPath($currentUrl);
        }elseif($request->container == 2){
            $galleries = Gallery::latest()->whereIn('type', ['rar','zip'])->paginate(40)->setPath($currentUrl);
        }elseif($request->container == 3){
            $galleries = Gallery::latest()->whereIn('type', ['mp4','mkv'])->paginate(40)->setPath($currentUrl);
        }else{
            $galleries = Gallery::latest()->where('status' , 2)->paginate(40)->setPath($currentUrl);
        }
        $count1 = Gallery::latest()->count();
        $count2 = Gallery::latest()->whereIn('type', ['gif','jpeg','jpg','webp','png','svg','tif','jfif'])->count();
        $count3 = Gallery::latest()->whereIn('type', ['rar','zip'])->count();
        $count4 = Gallery::latest()->whereIn('type', ['mp4','mkv'])->count();
        $percent1 = $count1 ? round(($count1 * '100') / $count1) : 0;
        $percent2 = $count1 ? round(($count2 * '100') / $count1) : 0;
        $percent3 = $count1 ? round(($count3 * '100') / $count1) : 0;
        $percent4 = $count1 ? round(($count4 * '100') / $count1) : 0;
        return view('admin.gallery.index' , compact(
            'count1',
            'count2',
            'count3',
            'count4',
            'percent1',
            'percent2',
            'percent3',
            'percent4',
            'galleries'
        ));
    }

    public function upload(Request $request){
        $year = Carbon::now()->year;
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year;
        if (!file_exists($folder)){
            mkdir($folder , 0755 , true);
        }
        $file = $request->image;
        $type = $file->getClientOriginalExtension();
        $name = time().'.'.$type;
        $sizefile = $file->getsize()/1000;
        if( $sizefile > 1000){
            $size=round($sizefile/1000 ,2) . 'mb';
        }else{
            $size=round($sizefile) . 'kb';
        }
        if ($type == "jpg" or $type == "JPG" or $type == "png" or $type == "PNG" or $type == "webp" or $type == "jpeg" or $type == "svg" or $type == "webp" or $type == "tif" or $type == "gif" or $type == "jfif"){
            $url = "/upload/image/" . $year;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            if(!$type == "gif"){
                $img = Image::make($_SERVER['DOCUMENT_ROOT'] . $url . '/' . $name);
                $img->insert($_SERVER['DOCUMENT_ROOT'] . $url . '/' . 'watermark.png', 'bottom-right', 10, 10);
                $img->save($_SERVER['DOCUMENT_ROOT'] . $url . '/' . $name , 70);
            }
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "rar" or $type == "zip"){
            $url = "/upload/file/" . $year;
            $path = $file->move(storage_path($url) , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "mp3"){
            $url = "/upload/music/" . $year;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'type' => $type,
                'user_id' => auth()->user()->id,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        elseif ($type == "mp4" or $type == "mkv"){
            $url = "/upload/movie/" . $year;
            $path = $file->move($_SERVER['DOCUMENT_ROOT'] .$url , $name);
            $img = Gallery::create([
                'name' => $name,
                'size' => $size,
                'user_id' => auth()->user()->id,
                'type' => $type,
                'url' => $url . '/' . $name ,
                'path' => $path->getRealPath(),
            ]);
        }
        return $img;
    }
    public function getImage(){
        return Gallery::latest()->paginate(20);
    }
    public function deleteImage(Gallery $gallery){
        $gallery->delete();
        return redirect()->back()->with([
            'message' => 'تصویر با موفقیت حذف شد'
        ]);
    }
}
