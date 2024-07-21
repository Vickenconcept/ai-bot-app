<?php

namespace App\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use App\Models\User;
use App\Notifications\AppointmentNotification;
use App\Notifications\NewNotification;

class TemplateSeven extends Component
{

    public
        $body,
        $conversationTitle;

    public
        $name,
        $email,
        $start_date,
        $end_date,
        $comments = 'Your comment..';

    public $page = 1;


    public function mount($body, $conversationTitle)
    {
        $this->body = $body;
        $this->conversationTitle = $conversationTitle;
    }


    public function moveToPage($pageNum)
    {

        $this->page = $pageNum;
    }

    public function submitAppointment()
    {

        $data = $this->validate([
            'name' => 'sometimes',
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'sometimes',
            'comments' => 'sometimes',
        ]);

        $data['conversation_id'] = $this->conversationTitle->id;

        Appointment::create($data);



        // $user = User::find(1);
        // $user->notify(new AppointmentNotification());

        $this->name = null;
        $this->email = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->comments = 'Your comment..';

        $this->page = 2;



        return back()->with('success', 'Successfully Booked');
    }
    public function render()
    {

        return view('livewire.template-seven');
    }
}
