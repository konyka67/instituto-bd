<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Email
{

    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct()
    {

    }
    public function send($subject,$for,$data){
        Mail::send('email',$data, function($msj) use($subject,$for){
            $msj->from("nuevojuanchaco67@gmail.com","instituto");
            $msj->subject($subject);
            $msj->to($for);
        });
    }
}
