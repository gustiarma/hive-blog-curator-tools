<?php

namespace App\Http\Livewire;

use App\Models\HiveCommunity;
use Livewire\Component;
use Illuminate\Support\Str;

class HiveCurator extends Component
{
    // public $communityList;
    public $searchTerm = '';
    public $message  = '';


    public function updatedSearchTerm($search)
    {
    }
    public function getCommunityListProperty()
    {

        if (count(HiveCommunity::get()) < 1) {;
            foreach (getCommunityListData()->result as $key => $value) {
                $newCommunity = new HiveCommunity(['uuid' => Str::uuid()]);
                $fill = [

                    'id' => $value->id,
                    'name' => $value->name,
                    'title' => $value->title,
                    'about' => $value->about,
                    'lang' => $value->lang,
                    'type_id' => $value->type_id,
                    'is_nsfw' => $value->is_nsfw,
                    'subscribers' => $value->subscribers,
                    'sum_pending' => $value->sum_pending,
                    'num_pending' => $value->num_pending,
                    'num_authors' => $value->num_authors,
                    'community_created_at' => $value->created_at,
                    'avatar_url' => ($value->avatar_url === ''  ? 'https://images.hive.blog/u/' . $value->name . '/avatar' : $value->avatar_url),
                    'admins' => (isset($value->admins) ? json_encode($value->admins) : ''),
                ];

                $newCommunity->fill($fill);
                $newCommunity->save();
            }
        }

        // return HiveCommunity::get();
        return HiveCommunity::where('title', 'like', '%' . $this->searchTerm . '%')->get();
    }

    public function mount()
    {
        // $this->communityList = getCommunityListData()->result;

        // dd($this->communityList);
    }
    public function render()
    {
        // $this->communityList = getCommunityListData()->result;

        // return view('livewire.hive-curator');
        return view('livewire.hive-curator')
            ->extends('layouts.hivecurator')
            ->section('contentarea');
    }
}
