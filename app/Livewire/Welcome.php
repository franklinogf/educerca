<?php

namespace App\Livewire;

use App\Enums\GuardsEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.app')]
class Welcome extends Component
{
    use Toast;

    public string $email = 'teacher@demo.com';
    public string $password = '123456';
    public string $selectedTab;
    public bool $loginModal = false;
    public bool $signingIn = false;

    public function mount()
    {
        $this->selectedTab = GuardsEnum::Teacher->value;
    }

    public function login()
    {
        $this->signingIn = true;

        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard($this->selectedTab)->attempt($validated)) {
            return $this->redirect(route("dashboard.{$this->selectedTab}.home"), navigate: true);
        }

        $this->error(
            'Error al iniciar sessión',
            timeout: 5000,
            position: 'toast-bottom'
        );
        $this->signingIn = false;

    }

    public function updatedSelectedTab($tab)
    {
        $this->email = $tab === GuardsEnum::Teacher->value ? 'teacher@demo.com' : 'parent@demo.com';

    }

    public function render()
    {
        $developers = [
            ['name' => 'Alam Soriano Pérez Figuereo', 'id' => '316-3980'],
            ['name' => 'Yanerys Espejo López', 'id' => '217-6740'],
            ['name' => 'Lesly Dayermin Arias De La Rosa', 'id' => '117-6560']
        ];
        $loginOptions = [['id' => GuardsEnum::Teacher->value, 'name' => GuardsEnum::Teacher->label()], ['id' => GuardsEnum::Parent->value, 'name' => GuardsEnum::Parent->label()]];
        return view('livewire.welcome', ['loginOptions' => $loginOptions, 'developers' => $developers]);
    }
}
