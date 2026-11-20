<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ConfirmModal extends Component
{
    public bool $show = false;
    public string $title = 'Konfirmasi';
    public string $message = 'Apakah Anda yakin?';
    public string $confirmText = 'Ya, Lanjutkan';
    public string $cancelText = 'Batal';
    public string $actionEvent = ''; 
    public array $actionPayload = [];

    #[On('open-confirm-modal')]
    public function openConfirmModal(array $data)
    {
        $this->title = $data['title'] ?? 'Konfirmasi';
        $this->message = $data['message'] ?? 'Apakah Anda yakin?';
        $this->confirmText = $data['confirmText'] ?? 'Ya, Lanjutkan';
        $this->cancelText = $data['cancelText'] ?? 'Batal';
        $this->actionEvent = $data['actionEvent'] ?? '';
        $this->actionPayload = $data['actionPayload'] ?? [];
        
        $this->show = true;
    }

    public function confirm()
    {
        $this->show = false;
        
        if ($this->actionEvent) {
            $this->dispatch($this->actionEvent, ...$this->actionPayload);
        }
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.confirm-modal');
    }
}