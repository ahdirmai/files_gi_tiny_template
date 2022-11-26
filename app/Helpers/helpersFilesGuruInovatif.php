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
                if ($basefolder != "") {
                    if (auth()->user()->id == $folder->baseFolder->owner_id) {
                        return true;
                    }
                    if (auth()->user()->id == $folder->owner_id) {
                        return true;
                    }
                } else {
                    if ($access_folder) {
                        foreach ($folder->accesses as $access) {
                            if (auth()->user()->id == $access->user_id && $access->status == 'accept') {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }
}
