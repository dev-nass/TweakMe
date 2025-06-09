<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    //
    public function destroy(Attachment $attachment)
    {

        // deletes the file from the disk
        Storage::disk('public')->delete($attachment->dir);

        $attachment->delete();

        return redirect()->back();
    }
}
