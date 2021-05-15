<?php

namespace App\Observers;

use App\Models\PostVote;

class PostVoteObserver
{
    /**
     * Handle the post vote "created" event.
     *
     * @param PostVote $postVote
     */
    public function created(PostVote $postVote)
    {
        $postVote->post()->increment('votes', $postVote->vote);
    }

    /**
     * Handle the post vote "updated" event.
     *
     * @param PostVote $postVote
     */
    public function updated(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the post vote "deleted" event.
     *
     * @param PostVote $postVote
     */
    public function deleted(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the post vote "restored" event.
     *
     * @param PostVote $postVote
     */
    public function restored(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the post vote "force deleted" event.
     *
     * @param PostVote $postVote
     */
    public function forceDeleted(PostVote $postVote)
    {
        //
    }
}
