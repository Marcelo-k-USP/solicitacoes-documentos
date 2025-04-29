<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('perfiladmin');
        \UspTheme::activeUrl('admin');

        $file_upload_max_size = self::file_upload_max_size();

        $oauth_files = Storage::files('debug/oauth');
        //dd($oauth_files);

        return view('admin/index', compact('file_upload_max_size', 'oauth_files'));
    }

    public function getOauthFile($filename)
    {
        $this->authorize('perfiladmin');
        return Storage::get('debug/oauth/'.$filename);
    }

    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
    // https://stackoverflow.com/questions/13076480/php-get-actual-maximum-upload-size
    protected static function file_upload_max_size()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = self::parse_size(ini_get('post_max_size'));
            if ($post_max_size > 0)
                $max_size = $post_max_size;

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = self::parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size)
                $max_size = $upload_max;
        }
        return $max_size;
    }

    protected static function parse_size($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size);      // Remove the non-numeric characters from the size.
        if ($unit)
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));    // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        else
            return round($size);
    }
}
