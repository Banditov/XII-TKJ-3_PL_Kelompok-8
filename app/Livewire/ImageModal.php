<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ImageModal extends Component
{
    public bool $show = false;
    public string $imageUrl = '';

    #[On('open-image-modal')]
    public function openImageModal(string $url)
    {
        $this->imageUrl = $url;
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
        $this->imageUrl = '';
    }

    public function render()
    {
        return view('livewire.image-modal');
    }
}