<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;

use App\Mail\Email;

class MailController extends Controller
{
    //
     /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
 
         $mailData = [
 
             'title' => 'Email recordatorio del Ministerio de Hacienda',
 
             'body' => 'Tienes un evento proximo a realizar dentro los 5 dias .'
 
         ];
 
          
 
         Mail::to('licenciadomarcofarfan@gmail.com')->send(new Email($mailData));
 
            
 
         dd("Email is sent successfully.");
 
     }
}
