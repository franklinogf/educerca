<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.app')]
class Welcome extends Component
{
    use Toast;

    public string $emailTeacher = 'teacher@demo.com';

    public string $passwordTeacher = '123456';
    public string $emailParent = 'parent@demo.com';

    public string $passwordParent = '123456';

    public bool $loginModal = false;

    public bool $signingIn = false;

    public function login($type)
    {

        $this->signingIn = true;
        if ($type === 'teacher') {
            $validated = $this->validate([
                'emailTeacher' => 'required|email',
                'passwordTeacher' => 'required',
            ]);
            if (Auth::guard($type)->attempt(['email' => $validated['emailTeacher'], 'password' => $validated['passwordTeacher']])) {
                return $this->redirect(route('dashboard.home'), navigate: true);
            }
        } else {
            $validated = $this->validate([
                'emailParent' => 'required|email',
                'passwordParent' => 'required',
            ]);
            if (Auth::guard($type)->attempt(['email' => $validated['emailParent'], 'password' => $validated['passwordParent']])) {
                return $this->redirect('/home', navigate: true);
            }
        }

        $this->error(
            'Error al iniciar sessión',
            timeout: 5000,
            position: 'toast-bottom'
        );
        $this->signingIn = false;

    }

    public function render()
    {
        return view('livewire.welcome');
    }
}
