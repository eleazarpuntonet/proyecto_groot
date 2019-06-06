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
      $vertical = 410;
      $horizontal = 135;
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
      $nameFile = $usuario->name.$usuario->last_name.'.png';
      $model1= '/images/firma1sps.png';
      $model2= '/images/firmaspslegal.png';

      $img = Image::make(public_path($model2));  
      $skypeicon = Image::make(public_path('/images/skype.png')); 
      $cellphone = Image::make(public_path('/images/cellphone.png'));  
      $mail = Image::make(public_path('/images/email.png'));  
      $marker = Image::make(public_path('/images/marker.png'));  
      $cargo = $objeto->cargo;
      $string = $cargo;
      // $string = substr($string, 0, strpos($string, ' '));


      // $img->text('VALERIE SANDERS', $vertical, $horizontal, function($font) {  
      $img->text($objeto->name, $vertical, $horizontal, function($font) {  
        $font->file('fonts/OpenSans-Bold.ttf'); 
        $font->size(18);  
        $font->color('#6D6E70');  
        $font->align('left');  
        $font->valign('bottom');  
        $font->angle(0);  
      });  
      $horizontal+=24; 

      if (strlen($cargo)>25) {
        $text = '';
        $print = explode(" ",$string);
        $cont = 0;
        for ($i=0; $i <=(count($print)-1); $i++) { 
          if (strlen($text)<20) {
            $text.=' '.$print[$i];
          } else {
            $img->text($text, $vertical-4, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);
              $font->color('#6D6E70');
              $font->align('left');
              $font->valign('bottom');
              $font->angle(0);
            });
            $horizontal+=18;
            $text='';
          }

          if ($i == (count($print)-1)) {
            dd($text);
            $text.=' '.$print[$i];
            $img->text($text, $vertical-4, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);
              $font->color('#6D6E70');
              $font->align('left');
              $font->valign('bottom');
              $font->angle(0);
            });
            $horizontal+=18;
            $text='';
          }
        }
      } else {
        $img->text($cargo, $vertical, $horizontal+5, function($font) {  
          $font->file('fonts/OpenSans-Regular.ttf'); 
          $font->size(14);
          $font->color('#6D6E70');
          $font->align('left');
          $font->valign('bottom');
          $font->angle(0);
        });
        $horizontal+=18;
      }
      // $img->insert($cellphone, 'top-left',$vertical-5, $horizontal+5);
      // $horizontal+=23;
      // // $img->text($objeto->cargo, $vertical, $horizontal+26, function($font) {  
      // $img->text('+59-3989092275', $vertical+20, $horizontal, function($font) {  
      //   $font->file('fonts/OpenSans-Regular.ttf'); 
      //   $font->size(14);  
      //   $font->color('#6D6E70');  
      //   $font->align('left');  
      //   $font->valign('bottom');  
      //   $font->angle(0);  
      // });  

      // $img->insert($skypeicon, 'top-left',$vertical-5, $horizontal+5);
      // $horizontal+=25;
      // $img->text('jpatino1925', $vertical+23, $horizontal, function($font) {  
      //   $font->file('fonts/OpenSans-Regular.ttf'); 
      //   $font->size(14);  
      //   $font->color('#6D6E70');  
      //   $font->align('left');  
      //   $font->valign('bottom');  
      //   $font->angle(0);  
      // });  

      // $img->insert($mail, 'top-left',$vertical-5, $horizontal+1 );
      // $horizontal+=21;
      // $img->text('josem@spservicesinc.com', $vertical+22, $horizontal, function($font) {  
      //   $font->file('fonts/OpenSans-Regular.ttf'); 
      //   $font->size(14);  
      //   $font->color('#6D6E70');  
      //   $font->align('left');  
      //   $font->valign('bottom');  
      //   $font->angle(0);  
      // });   
       
      // $img->insert($marker, 'top-left',$vertical-5, $horizontal+1 );
      // $horizontal+=18;
      // $img->text('Quito - Ecuador', $vertical+22, $horizontal, function($font) {  
      //  $font->file('fonts/OpenSans-Regular.ttf'); 
      //  $font->size(14);  
      //  $font->color('#6D6E70');  
      //  $font->align('left');  
      //  $font->valign('bottom');  
      //  $font->angle(0);  
      // });   
      $filepath = public_path($fileonsave);
      $img->save($filepath);
      $headers = array('Content-Type: image/png',$nameFile);
      return response()->download('/Users/ladmin/Desktop/SpsApps/proyecto_groot/public/'.$fileonsave,'namebanner.png',$headers);
    }
}
