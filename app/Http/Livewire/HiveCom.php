<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class HiveCom extends Component
{
    //
    public $limitPost = 20;
    public $maxPayout = 10;
    public $maxHour = 2;

    //
    public $ttl = 300;

    public $selectedCommunity;
    public function getCommunityInfoProperty()
    {
        $communityInfo =   Cache::remember('community-info-' . $this->selectedCommunity, $this->ttl, function () {
            return getCommunityInfo($this->selectedCommunity)->result;
        });
        return $communityInfo;
    }
    public function getCommunityPostsProperty()
    {
        $communityInfo =   Cache::remember('community-posts-' . $this->selectedCommunity, $this->ttl, function () {
            return getCommunityPosts($this->selectedCommunity)->result;
        });
        return $communityInfo;
    }


    public function updatedLimitPost()
    {
        Cache::forget('community-posts-' . $this->selectedCommunity);
    }

    public function mount($community)
    {
        $this->selectedCommunity  = $community;
    }

    public function subMaxPayout()
    {
        $this->maxPayout =  $this->maxPayout - 1;
    }
    public function addMaxPayout()
    {
        $this->maxPayout =  $this->maxPayout + 1;
    }

    public function subMaxHour()
    {
        $this->maxHour =  $this->maxHour - 1;
    }
    public function addMaxHour()
    {
        $this->maxHour =  $this->maxHour + 1;
    }
    public function render()
    {
        return view('livewire.hive-com')
            ->layout(
                'layouts.hivecurator',
                ['title' => 'something']
            )
            ->extends('layouts.hivecurator')
            ->section('contentarea');
    }
}
