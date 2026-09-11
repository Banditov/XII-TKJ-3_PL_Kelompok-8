<?php
namespace App\Livewire\Equipment;

use App\Data\EquipmentData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    public array $equipment = [];

    public function mount(): void
    {
        $this->loadEquipment();
    }

    public function loadEquipment(): void
    {
        $this->equipment = EquipmentData::all();
    }

    public function increment(int $id): void
    {
        foreach ($this->equipment as &$item) {
            if ($item['id'] === $id) {
                $item['total']++;
                break;
            }
        }
        unset($item);

        session()->flash('success', 'Jumlah berhasil ditambah!');
    }

    public function decrement(int $id): void
    {
        foreach ($this->equipment as &$item) {
            if ($item['id'] === $id && $item['total'] > 1) {
                $item['total']--;
                break;
            }
        }
        unset($item);

        session()->flash('success', 'Jumlah berhasil dikurangi!');
    }

    public function delete(int $id): void
    {
        $this->equipment = array_values(
            array_filter($this->equipment, fn($item) => $item['id'] !== $id)
        );

        session()->flash('success', 'Perlengkapan berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.equipment.index');
    }
}