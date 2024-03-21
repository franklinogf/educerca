<main class="hero min-h-screen" style="background-image: url('{{ asset('images/hero-image.jpg') }}');">
    <nav class="navbar fixed top-0">
        <div class="mx-auto flex max-w-full flex-grow justify-between bg-transparent md:max-w-3xl">
            <span class="text-white"><x-logo /></span>
            <ul class="*:font-semibold *:text-white flex items-center gap-5 text-lg">
                <li><x-mary-button class="btn-ghost" label="Desarrolladores" onclick="developers.showModal()" /></li>
                @auth('admin')
                    <li><a class="text-primary" href="/admin">Admin</a></li>
                @endauth
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
    <x-mary-modal class="z-40 backdrop-blur" persistent wire:model='loginModal'>
        <x-mary-header separator>
            <x-slot:middle>
                <h1 class="text-4xl font-bold">Inicia Sesión</h1>
            </x-slot:middle>
        </x-mary-header>
        <div class="mb-2 flex justify-center">
            <x-mary-radio :options="$loginOptions" class="btn-sm" wire:model.live.stop="selectedTab" />
        </div>
        <x-mary-form wire:submit.prevent="login">
            <x-mary-input icon="o-user" inline label="Email" type="text" wire:model="email" />
            <x-mary-input icon="o-eye" inline label="Clave" type="password" wire:model="password" />

            <x-slot:actions>
                <x-mary-button label="Cancel" x-on:click="$wire.loginModal = false" />
                <x-mary-button class="btn-primary" label="Iniciar Sessión" spinner="login" type="submit" />
            </x-slot:actions>
        </x-mary-form>

    </x-mary-modal>

    <x-mary-modal class="backdrop-blur" id="developers" persistent>
        <x-mary-header separator>
            <x-slot:middle>
                <h1 class="text-2xl font-bold">Desarrolladores del proyecto</h1>
            </x-slot:middle>
        </x-mary-header>
        <div>
            @foreach ($developers as $developer)
                <x-mary-list-item :item="$developer" no-hover sub-value="id" value="name" />
            @endforeach
        </div>
        <x-slot:actions>
            <x-mary-button label="Cancel" onclick="developers.close()" />
        </x-slot:actions>
    </x-mary-modal>
    <x-mary-theme-toggle class="hidden" />
</main>
