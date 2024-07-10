<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        $content = $request->content;

        //kiểm tra xem có ảnh base64 trong nội dung không
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->length > 0) {
            foreach ($images as $k => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = 'uploads/' . time() . $k . '.png';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', asset($image_name));
            }

            $content = $dom->saveHTML();
        } else {
            $content = $request->content;
        }

        $subscribers = Subscriber::pluck('email')->toArray();
        Mail::to($subscribers)->send(new Newsletter($request->subject, $content));

        toast('Đã gửi email đến tất cả người đăng ký thành công', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();

        toast('Đã xoá email đăng ký thành công', 'success');
        return response()->json([
            'status' => 'success',
        ]);
    }
}