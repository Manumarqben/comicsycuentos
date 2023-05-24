<?php

namespace App\Http\Livewire\Chapter;

use Livewire\Component;

class ReaderImage extends Component
{
    public $images;
    public $view;
    public $page;

    public $navPageTransition;

    protected $queryString = [
        'view',
        'page' => ['except' => 0],
    ];

    protected $listeners = [
        'setView',
    ];

    public function mount($images, $view)
    {
        $this->page = $this->page ?? 0;

        $this->fill([
            'images' => $images,
            'view' => $view,
            'navPageTransition' => true,
        ]);
    }

    public function setView($value)
    {
        $this->navPageTransition = $value == 'paginate';
        $this->view = $value;
    }

    public function nextPage()
    {
        if ($this->page < $this->images->count()) {
            $this->page++;
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'info' ,'message' => 'It is on the last page.']);
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'info' ,'message' => 'It is on the first page.']);
        }
    }

    public function render()
    {
        if ($this->view == 'cascade') {
            $this->page = 0;
            $imagesList = $this->images->sortBy('order');
        }
        
        if ($this->view == 'paginate') {
            $this->page = $this->page != 0 ? $this->page : 1;
            $imagesList = $this->images->where('order', $this->page)->first();;
        }

        return view('livewire.chapter.reader-image', compact('imagesList'));
    }
}
