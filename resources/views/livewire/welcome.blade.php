<main class="hero min-h-screen" style="background-image: url('{{ asset('images/hero-image.jpg') }}');">
    <nav class="navbar fixed top-0">
        <div class="mx-auto flex max-w-full flex-grow justify-between bg-transparent md:max-w-3xl">
            <x-logo />
            <ul class="*:text-white *:font-semibold flex items-center gap-5 text-lg">
                <li>Misión</li>
                <li>Visión</li>
                <li><x-mary-theme-toggle /></li>
            </ul>
        </div>
    </nav>
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md space-y-5">
            <h1 class="text-4xl font-bold text-white">Bienvenidos a {{ config('app.name') }}</h1>
            <p class="text-1x1 text-white/80">
                Con {{ config('app.name') }}, ¡tu aprendizaje está a la vuelta de la esquina!.</p>

            <x-mary-button class="btn-primary" label="Iniciar sesión" x-on:click='$wire.loginModal = true' />
        </div>
    </div>
    <x-mary-modal class="backdrop-blur" title="Inicia Sesión" wire:model='loginModal'>

        <x-mary-tabs selected="teachers-tab">
            <x-mary-tab icon="o-users" label="Profesores" name="teachers-tab">
                <x-mary-form wire:submit.prevent="login('teacher')">
                    <x-mary-input icon="o-user" label="Email" placeholder="email@alam.com" type="text"
                                  wire:model="emailTeacher" />
                    <x-mary-input icon="o-eye" label="Clave" type="password" wire:model="passwordTeacher" />

                    <x-slot:actions>
                        <x-mary-button label="Cancel" x-on:click="$wire.loginModal = false" />
                        <x-mary-button class="btn-primary" label="Iniciar Sessión" spinner="login" type="submit"
                                       x-bind:disabled="$wire.signingIn" />
                    </x-slot:actions>
                </x-mary-form>
            </x-mary-tab>

            <x-mary-tab icon="o-sparkles" label="Padres" name="parents-tab">
                <x-mary-form wire:submit.prevent="login('parent')">
                    <x-mary-input icon="o-user" label="Email" placeholder="email@alam.com" type="text"
                                  wire:model="emailParent" />
                    <x-mary-input icon="o-eye" label="Clave" type="password" wire:model="passwordParent" />

                    <x-slot:actions>
                        <x-mary-button label="Cancel" x-on:click="$wire.loginModal = false" />
                        <x-mary-button class="btn-primary" label="Iniciar Sessión" spinner="login" type="submit"
                                       x-bind:disabled="$wire.signingIn" />
                    </x-slot:actions>
                </x-mary-form>
            </x-mary-tab>
        </x-mary-tabs>

    </x-mary-modal>
</main>
