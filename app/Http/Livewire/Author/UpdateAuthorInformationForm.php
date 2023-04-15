<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateAuthorInformationForm extends Component
{
    use AuthorizesRequests;

    public Author $author;

    protected function rules()
    {
        return $rules = [
            'author.alias' => [
                'required',
                'max:100',
                'unique:applicants,alias',
                Rule::unique('authors', 'alias')->ignore($this->author->id),
            ],
            'author.slug' => [
                'max:150',
                'unique:applicants,slug',
                Rule::unique('authors', 'slug')->ignore($this->author->id),
            ],
            'author.biography' => [
                'max:255',
            ]
        ];
    }

    protected $validationAttributes = [
        'slug' => "alias",
    ];

    public function mount($author)
    {
        $this->fill([
            'author' => $author,
        ]);
    }

    public function updateAuthorInformation()
    {
        $this->authorize('update', $this->author);

        $this->author->alias = trim($this->author->alias);
        $this->author->slug = str($this->author->alias)->slug();
        $this->author->biography = trim($this->author->biography);

        $this->validate();

        $this->author->save();

        $this->dispatchBrowserEvent('alert', ['message' => 'Updated successfully']);
    }

    public function render()
    {
        return view('livewire.author.update-author-information-form');
    }
}
