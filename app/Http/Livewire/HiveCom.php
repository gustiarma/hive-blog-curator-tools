<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class HiveCom extends Component
{
    //
    public $limitPost = 100;
    public $maxPayout = 10;
    public $maxHour = 2;

    //
    public $ttl = 300;

    public $selectedCommunity;
    public function getCommunityInfoProperty()
    {
        // dd(getCommunityInfo($this->selectedCommunity));

        $communityInfo =   Cache::remember('community-info-' . $this->selectedCommunity, $this->ttl, function () {
            $data = getCommunityInfo($this->selectedCommunity);
            if (isset(getCommunityInfo($this->selectedCommunity)->result)) {

                return $data->result;
            } else {
                Cache::forget('community-info-' . $this->selectedCommunity);
                return [];
            }
        });
        return $communityInfo;
    }
    public function getCommunityPostsProperty()
    {
        // dd(getCommunityPosts($this->selectedCommunity, $this->limitPost)->result);
        $communityInfo =   Cache::remember('community-posts-' . $this->selectedCommunity, $this->ttl, function () {
            $data = getCommunityPosts($this->selectedCommunity, $this->limitPost);
            if (isset(getCommunityPosts($this->selectedCommunity, $this->limitPost)->result)) {
                $data = getCommunityPosts($this->selectedCommunity, $this->limitPost)->result;
                return $data;
            } else {
                Cache::forget('community-posts-' . $this->selectedCommunity);
                return [];
            }
            // return getCommunityPosts($this->selectedCommunity, $this->limitPost)->result;
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

    public function addMoreData()
    {
        $newData = dd($this->getCommunityPostsProperty());
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
