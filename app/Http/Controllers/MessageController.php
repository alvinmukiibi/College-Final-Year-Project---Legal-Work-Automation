<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firm;
use App\Message;
use App\User;
class MessageController extends Controller
{
    public function showMailbox(Request $request){

        // fetch the prospective recipients
        $firm = new Firm;
        $firm->firm_id = auth()->user()->firm_id;
        $recipients = $firm->user()->where('id','!=',auth()->user()->id)->get();

        // fetch all the current user's conversations
        $message = new Message;
        $message->user_id = auth()->user()->id;
        $conversations = $message->getConversations();

        return view("firm.mailbox")->with(["recipients" => $recipients, "conversations" => $conversations]);

    }
    public function sendMessage(Request $request){

        $data  = $this->validate($request, [
            'recipient' => 'required|numeric',
            'message' => 'required|max:255',
            'attachment' => 'mimes:pdf,doc,docx,xlsx,xls,ppt,pptx,jpeg,jpg,png,webp,bmp,txt|max:10240|nullable'
        ]);

        // check for attachment and process it
        $attachment = null;
        if($request->hasFile('attachment') && $request->file('attachment')->isValid()){
            $file = $request->file('attachment');
            $savedTo = 'public'.DIRECTORY_SEPARATOR;
            $originalName = $file->getClientOriginalName();
            $arr = explode('.',$originalName); // $name = pathinfo($originalName, PATHINFO_FILENAME)
            $replaced = \str_replace(' ', '_', $arr[0]);
            $newName = $replaced . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($savedTo, $newName);
            $attachment = $newName;
        }


        //check if the uve ever sent the recipient a message before

        $message = new Message;
        $message->sender = auth()->user()->id;
        $message->recipient = $data['recipient'];
        $message->attachment = $attachment;
        $message->message = $data['message'];

        $check1 = $message->checkIfSenderSentRecipientBefore();

        if($check1){
            $message->message_id = $check1;
            $message->recordMessage();
            return redirect()->back()->with("success", "Message Sent");

        }else{
            $check2 = $message->checkIfRecipientSentSenderBefore();
            if($check2){
                $message->message_id = $check2;
                $message->recordMessage();
                return redirect()->back()->with("success", "Message Sent");
            }else{
                //start a new conversation in the message table
                $messageID = $message->startNewConversation();
                $message->message_id = $messageID;
                $message->recordMessage();
                return redirect()->back()->with('success', 'Message Sent');
            }
        }
    }
    public function showChat(Request $request){

        $message = new Message;
        $message->id = $request->segment(4);
        $message->markAsRead();


        $messages = $message->getMessages();

        // make incoming messages as read


        $user = User::find($request->segment(5));

        return view('firm.directchat')->with(['messages' => $messages, 'user' => $user]);

    }
    public function downloadAttachment(Request $request){

        $file = storage_path().DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR. $request->segment(4);

        return response()->download($file);

    }
    public function deleteConversation(Request $request){

       $message = new Message;
       $message->id = $request->input('conv');

       $message->deleteConversation();

    }
    public function getUnreadMessages(Request $request){

        $message = new Message;
        $message->id = $request->input('user');
        $count = $message->countUnread();
        return response()->json(['noOfUnread' => $count]);

    }
}
