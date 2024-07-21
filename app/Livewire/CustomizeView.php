<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class CustomizeView extends Component
{
    // use WithFileUploads;

    public $logo;

    public $selected,
        $guestChat,
        $navColor = '#8600b3',
        $textColor,
        $title = 'hello',
        $subTitle = 'ask me something',
        $size = '15px 20px',
        $position = 'right',
        $launcherIcon = 'bx-bot',
        $launcherColor = '#8600b3',
        $message;
    public function mount($guestChat)
    {
        $this->guestChat = $guestChat;
    }

    public function saveLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|mimes:jpg,png|max:2048',
        ]);


        if ($request->file('logo')) {
            $cloudinary = new Cloudinary();
            $cloudinaryResponse = $cloudinary->uploadApi()->upload($request->file('logo')->getRealPath());

            $imageUrl = $cloudinaryResponse['secure_url'];

            $user = auth()->user();
            $customizeUpdate = $user->conversations()->find($request->guestId);
            $data = [
                'logo' => $imageUrl,
            ];

            $customizeUpdate->update($data);
            session()->flash('message', 'Logo uploaded successfully.');
        } else {
            session()->flash('message', 'Upload  failed.');
        }

        return back();



        // Save $path to the database or perform other operations

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
