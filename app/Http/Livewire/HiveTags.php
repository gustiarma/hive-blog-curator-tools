<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class HiveTags extends Component
{
    public $limitPost = 100;
    public $maxPayout = 10;
    public $maxHour = 2;
    public $tagPosts = [];

    //
    public $ttl = 300;

    public $selectedTags;

    public function searchTag()
    {

        $this->tagPost  = null;

        $this->tagPosts = $this->findPostByTags($this->selectedTags);
    }
    public function getCommunityInfoProperty()
    {
        // dd(getCommunityInfo($this->selectedTags));

        $tagsInfo =   Cache::remember('community-info-' . $this->selectedTags, $this->ttl, function () {
            $data = getCommunityInfo($this->selectedTags);
            if (isset(getCommunityInfo($this->selectedTags)->result)) {

                return $data->result;
            } else {
                Cache::forget('community-info-' . $this->selectedTags);
                return [];
            }
        });
        return $tagsInfo;
    }
    public function findPostByTags($tagsname)
    {
        if ($this->selectedTags !== null && $tagsname !== '') {
            $tagPost =   Cache::remember('community-tags-' . $this->selectedTags, $this->ttl, function () {
                $data = getTagPosts($this->selectedTags, $this->limitPost);
                if (isset(getTagPosts($this->selectedTags, $this->limitPost)->result)) {
                    $data = getTagPosts($this->selectedTags, $this->limitPost)->result;
                    return $data;
                } else {
                    Cache::forget('community-tags-' . $tagsname);
                    return [];
                }
                // return getCommunityPosts($this->selectedTags, $this->limitPost)->result;
            });
            return $tagPost;
        } else {
            return [];
        }

        // dd(getCommunityPosts($this->selectedTags, $this->limitPost)->result);

    }


    public function updatedLimitPost()
    {
        Cache::forget('community-tags-' . $this->selectedTags);
    }

    public function mount()
    {
        // $this->selectedTags  = $community;
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
        return view('livewire.hive-tags')->extends('layouts.hivecurator')
            ->section('contentarea');;
    }
}
