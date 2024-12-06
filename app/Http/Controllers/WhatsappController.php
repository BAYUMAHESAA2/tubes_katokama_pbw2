<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function send(Request $request)
    {
        $menuItems = $request->input('menu_items');

        if (!$menuItems) {
            return redirect()->back()->with('error', 'Tidak ada menu yang dipilih.');
        }

        $message = 'Saya ingin memesan:\n' . implode("\n", $menuItems);
        $whatsappNumber = '6282141676046'; // Ganti dengan nomor WhatsApp yang sesuai
        $url = "https://api.whatsapp.com/send?phone={{$whatsappNumber}}&text=" . urlencode($message);

        return redirect()->away($url);
    }
}