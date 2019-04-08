<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Message extends Model
{

    protected $fillable = [
        'sender_id','recipient_id','date'
    ];

    protected $table = "messages";

    public function checkIfSenderSentRecipientBefore(){

        $check = DB::table($this->table)->where(["sender_id" => $this->sender, "recipient_id" => $this->recipient])->get();
        $count = $check->count();

        if($count > 0){
            $messageID = DB::table($this->table)->where(["sender_id" => $this->sender, "recipient_id" => $this->recipient])->value("id");
            return $messageID;
        }else{
            return false;
        }
    }
    public function checkIfRecipientSentSenderBefore(){
        $check = DB::table($this->table)->where(["sender_id" => $this->recipient, "recipient_id" => $this->sender])->get();
        $count = $check->count();

        if($count > 0){
            $messageID = DB::table($this->table)->where(["sender_id" => $this->recipient, "recipient_id" => $this->sender])->value("id");
            return $messageID;
        }else{
            return false;
        }
    }
    public function startNewConversation(){

        $start = DB::table($this->table)->insert(["sender_id" => $this->sender, "recipient_id" => $this->recipient]);

        return DB::getPdo()->lastInsertId();


    }
    public function recordMessage(){
        $record = DB::table('replies')->insert(["message_id" => $this->message_id, "message" => $this->message, "attachment" => $this->attachment, "recipient_id" => $this->recipient]);

        return $record;
    }

    public function getConversations(){

        $coll = array();
        $convs = DB::table($this->table)->where(["sender_id" => $this->user_id])->orWhere(["recipient_id" => $this->user_id])->orderBy('date','asc')->get();

        foreach($convs as $conv){
            $msg = DB::table('replies')->where(['message_id' => $conv->id, 'id' => DB::table('replies')->where('message_id', $conv->id)->max('id')])->get();

            if($conv->sender_id !== $this->user_id){
                $convst = DB::table('users')->where(['id' => $conv->sender_id])->get();
                $obj = ['conv' => $conv, 'msg' => $msg, 'otherUser' => $convst];
            }else if($conv->recipient_id !== $this->user_id){
                $convst = DB::table('users')->where(['id' => $conv->recipient_id])->get();
                $obj = ['conv' => $conv, 'msg' => $msg, 'otherUser' => $convst];
            }
            $coll[] = $obj;
        }

        return $coll;




    }
    public function countUnread(){
        $unread = DB::table('replies')->where(['recipient_id' => $this->id, 'status' => 'unread'])->get();

        return $unread->count();
    }
    public function markAsRead(){
        $mark = DB::table('replies')->where(['message_id' => $this->id, 'status' => 'unread', 'recipient_id' => auth()->user()->id])->update(['status' => 'read']);

        return $mark;
    }

    public function getMessages(){

        $msgs = DB::table('replies')->where('message_id', $this->id)->orderBy('date', 'asc')->get();

        return $msgs;

    }

}
