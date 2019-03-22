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
          $vertical = 1365;
          $horizontal = 365;
          $usuario  = User::with('departamento')->find($user);
          $fontSizeH1 = 40;
          $fontSizeH2 = 25;
          // $nombre   = $usuario->name." ".$usuario->last_name;
          $nombre   = $usuario->name;
          $correo   = 'example@spservicesltd.uk';
          $cargo    = $usuario->departamento->disp_name;
          $telefono = '+1 786.405.1112';
          $web      = 'www.spservicesltd.uk';

           $img = Image::make(public_path('/images/firma1sps.png'));  
           // $img->text(strtoupper($nombre), $vertical, $horizontal, function($font) {  
           $img->text('Kike Santander', $vertical, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(40);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
          });  
            // $img->text($cargo, $vertical, $horizontal+40, function($font) {  
            $img->text('Desarrollo de Negocios Paraguay', $vertical, $horizontal+45, function($font) {  
               $font->file('fonts/OpenSans-Regular.ttf'); 
               $font->size(35);  
               $font->color('#6D6E70');  
               $font->align('left');  
               $font->valign('bottom');  
               $font->angle(0);  
           });  

             // $img->text($telefono, $vertical, $horizontal+105, function($font) {  
             $img->text('+1 (305) 332-5655', $vertical, $horizontal+105, function($font) {  
                $font->file('fonts/OpenSans-Regular.ttf'); 
                $font->size(35);  
                $font->color('#6D6E70');  
                $font->align('left');  
                $font->valign('bottom');  
                $font->angle(0);  
            });  

              // $img->text($correo, $vertical, $horizontal+154, function($font) {  
              $img->text('ks@spservicesltd.uk', $vertical, $horizontal+154, function($font) {  
                 $font->file('fonts/OpenSans-Regular.ttf'); 
                 $font->size(35);  
                 $font->color('#6D6E70');  
                 $font->align('left');  
                 $font->valign('bottom');  
                 $font->angle(0);  
             });  

          //  $img->text($web, $vertical, $horizontal+197, function($font) {  
          //     $font->file('fonts/OpenSans-Regular.ttf'); 
          //     $font->size($fontSizeH2);  
          //     $font->color('#6D6E70');  
          //     $font->align('left');  
          //     $font->valign('bottom');  
          //     $font->angle(0);  
          // }); 


          $filepath = public_path('images/algo_nuevo.png');
          $img->save($filepath);  

           
           return response()->download('/Users/ladmin/Desktop/SpsApps/proyecto_groot/public/images/algo_nuevo.png');

        }
}
