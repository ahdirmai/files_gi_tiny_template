<?php

use App\Models\BaseFolders;
use App\Models\Content;
use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('hello')) {
    function hello()
    {
        return 'Hello World';
    }
}

if (!function_exists('getFolder')) {
    function getFolder($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            // return $folder;
        }
        return $folder;
    }
}

if (!function_exists('checkAccessEnterFolder')) {
    function checkAccessEnterFolder($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();
        $basefolder = "";
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
            $basefolder = BaseFolders::find($folder->basefolder_id);
            $access_folder = $folder->accesses;
        } else {
            $access_folder = $folder->accesses;
        };

        if (auth()->user()->getRoleNames()->first() == "admin") {
            return true;
        } else {
            if ($folder->access_type == "public") {
                return true;
            } else {
                if (auth()->user()->id == $folder->owner_id) {
                    return true;
                } else {
                    // dd($basefolder);
                    if ($basefolder != "") {
                        if ($basefolder->owner_id == auth()->user()->id) {
                            return true;
                        }
                    }

                    if ($access_folder) {
                        foreach ($access_folder as $access) {
                            if (auth()->user()->id == $access->user_id && $access->status == 'accept') {
                                return true;
                            }
                        }
                    }
                }
            }
            return false;
        }
    }
}

if (!function_exists('checkCreateContent')) {
    function checkCreateContent($slug)
    {
        $folder = getFolder($slug);


        if ($folder->owner_id == auth()->user()->id) {
            return true;
        } else {
            if ($folder->access_type == "public") {
                return true;
            } else {
                if ($folder->accesses) {
                    foreach ($folder->accesses as $access) {
                        if (auth()->user()->id == $access->user_id && $access->permission_id == 2 && $access->status == "accept") {
                            return true;
                        }
                    }
                } else {
                    return false;
                }
            }
        }
    }
}
