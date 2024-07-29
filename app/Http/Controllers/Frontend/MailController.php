<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Models\History;

class MailController extends Controller
{
    public function index()
    {
        $giohang = session('cart-product') ?? [];   
        $data = [
            'subject' => "Minh Hưng",
            'body' => "Hello, this is my email",
            'cart-product' => $giohang,       
        ];
    
        try {
            Mail::to('minhhung.dx1805@gmail.com
            ')->send(new MailNotify($data));
            return response()->json(['Great! Check your mailbox']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
}
