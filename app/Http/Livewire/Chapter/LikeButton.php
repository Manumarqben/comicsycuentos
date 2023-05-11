<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Livewire\Component;

class LikeButton extends Component
{
    public Chapter $chapter;
    public $like;

    public function mount($chapter)
    {
        $this->fill([
            $this->chapter = $chapter,
            $this->like = $this->vote == null ? $this->vote : $this->vote->like ,
        ]);
    }

    public function getVoteProperty()
    {
        return $this->chapter->votes()->where('user_id', auth()->user()->id)->select('like')->first();

    }

    public function voted($vote = null)
    {
        if ($vote === null) {
            $this->chapter->votes()->detach(auth()->user()->id);
            $this->like = null;
            $this->dispatchBrowserEvent('alert', ['message' => 'The vote has been withdrawn with success.']);
        } else {
            $this->chapter->votes()->sync([auth()->user()->id => ['like' => $vote]], false);
            if ($vote === true) {
                $this->like = true;
                $this->dispatchBrowserEvent('alert', ['message' => "I'm glad you like the chapter."]);
            }
            if ($vote === false) {
                $this->like = false;
                $this->dispatchBrowserEvent('alert', ['message' => 'I will strive more the next time.']);
            }
        }
    }
    public function render()
    {
        return view('livewire.chapter.like-button');
    }
}
