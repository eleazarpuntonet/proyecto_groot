<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;
use App\User;
use App\Departamentos;

class ImageController extends Controller
{
    public function textOnImage($user)  
    {  
      $objeto = json_decode($user);
      $vertical = 1365;
      $horizontal = 365;
      $usuario  = User::with('departamento')->find($objeto->id);
      if (empty($usuario->email) && !empty($objeto->email)){
        $usuario->email = strtolower($objeto->email);
        $usuario->save();
      };
      $fontSizeH1 = 40;
      $fontSizeH2 = 25;
      $departamento= $usuario->departamento->disp_name;
      $telefono = '+1 786.405.1112';
      $fileonsave = 'images/'.$usuario->name.$usuario->last_name.'.png';
      $model1= '/images/firma1sps.png';
      $model2= '/images/firma2sps.png';
      $model3= '/images/firma3sps.png';

      $img = Image::make(public_path($model1));  
      $img->text($objeto->name, $vertical, 373, function($font) {  
        $font->file('fonts/OpenSans-Regular.ttf'); 
        $font->size(40);  
        $font->color('#6D6E70');  
        $font->align('left');  
        $font->valign('bottom');  
        $font->angle(0);  
      });  
      $img->text($objeto->cargo, $vertical, $horizontal+45, function($font) {  
         $font->file('fonts/OpenSans-Regular.ttf'); 
         $font->size(35);  
         $font->color('#6D6E70');  
         $font->align('left');  
         $font->valign('bottom');  
         $font->angle(0);  
      });  
      if (empty($objeto->tlf)) {
         $img->text($departamento, $vertical, $horizontal+105, function($font) {  
            $font->file('fonts/OpenSans-Regular.ttf'); 
            $font->size(35);  
            $font->color('#6D6E70');  
            $font->align('left');  
            $font->valign('bottom');  
            $font->angle(0);  
        });                  
      } else {
         $img->text($objeto->tlf, $vertical, $horizontal+105, function($font) {  
            $font->file('fonts/OpenSans-Regular.ttf'); 
            $font->size(35);  
            $font->color('#6D6E70');  
            $font->align('left');  
            $font->valign('bottom');  
            $font->angle(0);  
        });  
      }
      $img->text($objeto->email, $vertical, $horizontal+155, function($font) {  
         $font->file('fonts/OpenSans-Regular.ttf'); 
         $font->size(35);  
         $font->color('#6D6E70');  
         $font->align('left');  
         $font->valign('bottom');  
         $font->angle(0);  
      });  
      $filepath = public_path($fileonsave);
      $img->save($filepath);  
      $headers = array(
                        'Content-Type: image/png'
                    );
      return response()->download('/Users/ladmin/Desktop/SpsApps/proyecto_groot/public/'.$fileonsave,'namebanner.png',$headers);
    }
}
