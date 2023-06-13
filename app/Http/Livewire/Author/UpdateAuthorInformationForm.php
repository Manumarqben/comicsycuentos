<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateAuthorInformationForm extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Author $author;
    public $photo;

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
            ],
        ];
    }

    protected $validationAttributes = [
        'slug' => "alias",
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => [
                'image',
                'max:1024',
            ],
        ]);
    }

    public function mount($author)
    {
        $this->fill([
            'author' => $author,
        ]);
    }

    public function getProfilePhotoPathProperty()
    {
        if($this->photo) {
            try {
                return $this->photo->temporaryUrl();
            } catch (Exception $e) {}
        }

        if ($this->author->profilePhoto) {
            return asset(Storage::url($this->author->profilePhoto->path));
        }

        return asset(Storage::url('seed/author_profile_photos/cervantes.jpg'));
    }

    public function updateAuthorInformation()
    {
        $this->authorize('update', $this->author);

        $this->author->alias = trim($this->author->alias);
        $this->author->slug = str($this->author->alias)->slug();
        $this->author->biography = trim($this->author->biography);

        $this->validate();

        DB::beginTransaction();
        try {
            if ($this->photo) {
                if ($this->author->profilePhoto->path) {
                    Storage::disk('s3')->delete($this->author->profilePhoto->path);
                }
                $extension = $this->photo->getClientOriginalExtension();
                $fileName = $this->author->id . '.' . $extension;
                $path = $this->photo->storePubliclyAs('author_profile_photos', $fileName, 's3');
                $this->author->profilePhoto()->updateOrCreate(
                    ['author_id' => $this->author->id],
                    ['path' => $path]
                );
            }

            $this->author->save();

            DB::commit();

            $this->dispatchBrowserEvent('alert', ['message' => 'Updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'A mistake has happened, try again later']);
        }
    }

    public function render()
    {
        return view('livewire.author.update-author-information-form');
    }
}
