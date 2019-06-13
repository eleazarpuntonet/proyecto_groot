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
      $horizontal = 90;
      // $horizontal = 135;
      $usuario  = User::with('departamento')->find($objeto->id);
      if (empty($usuario->email) && !empty($objeto->email)){
        $usuario->email = strtolower($objeto->email);
        $usuario->save();
      };
      $fontSizeH1   = 40;
      $fontSizeH2   = 25;
      $departamento = $usuario->departamento->disp_name;
      $telefono     = '+1 786.405.1112';
      $fileonsave   = 'images/'.$usuario->name.$usuario->last_name.'.png';
      $nameFile     = $usuario->name.$usuario->last_name.'.png';
      $model1       = '/images/firma1sps.png';
      $model2       = '/images/firmaspslegal.png';
      $model3       = '/images/FIRR.png';

      $img          = Image::make(public_path($model3));
      $skypeicon    = Image::make(public_path('/images/skype.png'));
      $phone        = Image::make(public_path('/images/phone.png'));
      $mail         = Image::make(public_path('/images/email.png'));
      $marker       = Image::make(public_path('/images/marker.png'));
      $cargo        = $objeto->cargo;
      $string       = $cargo;

      foreach ($objeto as $key=>$value) {
        switch ($key){
          case 'name':
            $img->text($objeto->$key, $vertical, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Bold.ttf'); 
              $font->size(18);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
            });  
            $horizontal+=5; 
          break;
          case 'cargo':
            if (strlen($objeto->$key)>25) {
              $print = explode("-",wordwrap($string,25,"-",true));
              foreach($print as $i => $item) {
                $horizontal+=18;
                $img->text($print[$i], $vertical, $horizontal, function($font) {  
                  $font->file('fonts/OpenSans-Regular.ttf'); 
                  $font->size(14);
                  $font->color('#6D6E70');
                  $font->align('left');
                  $font->valign('bottom');
                  $font->angle(0);
                });
              }
            } else {
              $horizontal+=18;
              $img->text($objeto->$key, $vertical, $horizontal+6, function($font) {  
                $font->file('fonts/OpenSans-Regular.ttf'); 
                $font->size(14);
                $font->color('#6D6E70');
                $font->align('left');
                $font->valign('bottom');
                $font->angle(0);
              });
            }
          break;
          case 'tlf':
            $img->insert($phone, 'top-left',$vertical-5, $horizontal+4);
            $horizontal+=20;
            $img->text($objeto->$key, $vertical+20, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
            });  
          break;
          case 'skype':
            $img->insert($skypeicon, 'top-left',$vertical-5, $horizontal+4);
            $horizontal+=20;
            $img->text($objeto->$key, $vertical+20, $horizontal+4, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
            });  
          break;
          case 'mail':
            $img->insert($mail, 'top-left',$vertical-5, $horizontal+4);
            $horizontal+=20;
            $img->text($objeto->$key, $vertical+20, $horizontal+4, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
            });  
          break;
          case 'ubicacion':
            $img->insert($marker, 'top-left',$vertical-5, $horizontal+4);
            $horizontal+=20;
            $img->text($objeto->$key, $vertical+20, $horizontal, function($font) {  
              $font->file('fonts/OpenSans-Regular.ttf'); 
              $font->size(14);  
              $font->color('#6D6E70');  
              $font->align('left');  
              $font->valign('bottom');  
              $font->angle(0);  
            });  
          break;
        }
      }
      $filepath = public_path($fileonsave);
      $img->save($filepath);
      $headers = array('Content-Type: image/png',$nameFile);
      return response()->download('/Users/ladmin/Desktop/SpsApps/proyecto_groot/public/'.$fileonsave,'namebanner.png',$headers);
    }
}
