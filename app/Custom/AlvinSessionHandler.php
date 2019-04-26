<?php

namespace App\Custom;

use Illuminate\Support\Facades\DB;
class AlvinSessionHandler implements \SessionHandlerInterface
{
    public function destroy($sessionId) {

    }
    public function gc($lifetime) {

        DB::table('users')->where('id', auth()->user()->id)->update(['online_status' => 'offline']);

    }
}
