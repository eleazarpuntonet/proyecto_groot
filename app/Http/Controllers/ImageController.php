<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;
// use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function textOnImage()  
        {  
           $img = Image::make(public_path('/images/firma1sps.png'));  
           // $img->text('Hello coderMen', 300, 300);
           $img->text('ELEAZAR', 500, 200, function($font) {  
              // $font->file(public_path('/fonts/OpenSans-Regular')); 
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size('25');  
              $font->color('#4285F4');  
              $font->align('center');  
              $font->valign('bottom');  
              $font->angle(0);  
          });  

        	// $img = Image::make(public_path('/images/Otracosa.png'))->resize(300, 200);

        	// return phpinfo();


           // $intervention = new ImageManager(array('driver' => 'imagick'));
           // $image = $intervention->make(public_path('images/firma1sps.png'));
           // $image->resize(500, 400);
           $img->save(public_path('images/algo_nuevo.png'));  
        }
}
