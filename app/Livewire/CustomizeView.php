<?php

namespace App\Livewire;

use Livewire\Component;

class CustomizeView extends Component
{
    public $selected,
        $guestChat,
        $navColor = '#1d98f7',
        $textColor,
        $title = 'hello',
        $subTitle = 'ask me something',
        $size = '15px 20px',
        $position = 'right',
        $launcherIcon = 'bx-bot',
        $launcherColor = '#1d98f7',
        $message ;
    public function mount($guestChat)
    {
        $this->guestChat = $guestChat;
    }


    public function selectedCustom()
    {

        $user = auth()->user();
        $customizeUpdate = $user->conversations()->find($this->guestChat->id);


        if (!$customizeUpdate) {
            return redirect()->back()->with('error', 'Conversation not found.');
        }

        $data = [
            'layout' => $this->selected,
            'nav_bg_color' => $this->navColor,
            'nav_col' => $this->textColor,
            'head_title' => $this->title,
            'head_subtitle' => $this->subTitle,
            'position' => $this->position,
            'launcher_size' => $this->size,
            'launcher_color' => $this->launcherColor,
            'launcher_icon' => $this->launcherIcon
        ];

        $customizeUpdate->update($data);
    }

    public function render()
    {
        return view('livewire.customize-view');
    }
}
