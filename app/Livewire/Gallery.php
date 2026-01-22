<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class Gallery extends Component
{
    public $filter = 'all'; // all, images, videos
    public $images = [];
    public $videos = [];

    public function mount()
    {
        $path = public_path('images/galleries');
        if (File::exists($path)) {
            $files = File::files($path);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                $extension = strtolower($file->getExtension());
                
                // Sort extensions
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'heic'])) {
                    $this->images[] = $filename;
                } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'webm'])) {
                    $this->videos[] = $filename;
                }
            }
        }
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function render()
    {
        return view('livewire.gallery');
    }
}
