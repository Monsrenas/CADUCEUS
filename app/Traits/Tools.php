<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Mail;

trait Tools
{

    public $postToEdit="", $xOpen=false;

    public function ResetPassword($postId)
    {
        $this->edit($postId);

        $this->xOpen = false; 
        $this->tmpPassword=Str::random(8);
        $this->postToEdit->password=Hash::make($this->tmpPassword);
        $this->postToEdit->save();
        $this->SendMail(1); 
         
        $this->dispatchBrowserEvent('message', [
            'body' => 'Password successfully reseted.',
            'timeout' => 4000 ]);

        $this->render();
    }

    public function activation($id)
    {
         
        $user=User::find($id);
        $active=$user->active;
        $user->update(['active' => !$active]);
        $active=($active)? 'deactivated.':'activated.';
        $this->dispatchBrowserEvent('message', [
            'body' => 'User, '.$user->name.', successfully '.$active,
            'timeout' => 4000 ]);
    }
    
    public function edit($postId){
        $this->postToEdit = User::find($postId);
       
        if ($this->postToEdit) {
            $this->typeJob=$this->postToEdit->role;
            $this->name=$this->postToEdit->name;
            $this->email=$this->postToEdit->email;
            $this->xAccess=json_decode($this->postToEdit->access, true);
        }
        
        $this->xOpen = true; 
    }

    public function SendMail($tIn)
    {
        $type=[['You have been registered as a new user in the CADUCEUS system',' We are pleased to inform you that you have been registered as a user in the CADUCEUS system. 
        To continue, ','New user Mail'],
               ['Your password has been reset successfully', 'As a measure to make it possible for you to access the CADUCEUS system, Your password has been reset,','Password reset Mail']];
        Mail::send('emails.new-user-mail',
        array(
            'name' => $this->name,
            'email' => $this->email,
           // 'attachment' => $this->attachment,
           // 'comment' => $this->comment,
             'Password'=>$this->tmpPassword,
             'Text'=>$type[$tIn][1],
             'Title'=>$type[$tIn][2],
            ),
            function($message) use ($type, $tIn){ 
                $message->from('references@tcihospital.tc','InterHealthCanada');
                $message->to($this->email, $this->name )->subject($type[$tIn][0]);
            }
        );

        $this->reset();
    }
}