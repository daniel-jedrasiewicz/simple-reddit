<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostVotes extends Component
{

    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-votes');
    }

    public function vote($vote)
    {
        if (!PostVote::where('post_id', $this->post->id)->where('user_id', auth()->id())->count()
            && in_array($vote, [-1, 1]) && $this->post->user_id != auth()->id()) {
            PostVote::create([
                'post_id' => $this->post->id,
                'user_id' => Auth::id(),
                'vote' => $vote
            ]);
            $this->post->increment('votes', $vote);
            $this->post = Post::find($this->post->id);
        }
    }
}
