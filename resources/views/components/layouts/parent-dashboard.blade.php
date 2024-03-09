@php
    $fullName = auth()->user()->full_name;
@endphp
<x-layouts.app>
    <div class="min-h-screen lg:grid lg:grid-flow-col lg:grid-cols-[300px_1fr]">
        <aside class="sticky top-0 hidden h-screen flex-col space-y-4 bg-base-100 p-2 shadow lg:flex">
            <div class="flex flex-none justify-center">
                <span class="text-2xl"><x-logo /></span>
            </div>
            <nav class="flex-auto p-0">
                <x-mary-menu activate-by-route active-bg-color="bg-primary text-primary-content">
                    @include('components.layouts.partials.parent-links')
                </x-mary-menu>
            </nav>
            <div class="self-end">
                <x-mary-dropdown right>
                    <x-slot:trigger>
                        <x-mary-button :label="$fullName" class="btn-primary btn-sm" icon="o-cog-6-tooth" responsive />
                    </x-slot:trigger>

                    <x-mary-menu-item icon="o-swatch" title="Cambiar tema"
                                      x-on:click.stop="$dispatch('mary-toggle-theme')" />
                    <x-mary-menu-item :link="route('dashboard.parent.logout')" icon="o-power" title="Cerrar sesión" />
                </x-mary-dropdown>
            </div>
        </aside>
        <main class="h-full overflow-x-hidden p-4">

            <header class="relative" x-data="{ expanded: false }"
                    x-on:resize.window.debounce="expanded = (window.innerWidth > 1024) ? false : expanded ">
                <x-mary-header size="text-xl lg:text-3xl" title="Dashboard: {{ $fullName }}">
                    <x-slot:actions>
                        <x-mary-button class="btn absolute right-1 top-0 lg:hidden" icon="o-bars-3"
                                       x-on:click="expanded = ! expanded" />
                        <x-mary-theme-toggle class="hidden lg:block" />
                    </x-slot:actions>
                </x-mary-header>
                <div class="mb-5" x-cloak x-collapse x-show="expanded">
                    <nav class="mb-5">
                        <x-mary-menu activate-by-route active-bg-color="bg-primary text-primary-content"
                                     class="flex-auto p-0">
                            @include('components.layouts.partials.parent-links')

                        </x-mary-menu>
                    </nav>
                    <div class="flex justify-end">
                        <x-mary-dropdown right>
                            <x-slot:trigger>
                                <x-mary-button :label="$fullName" class="btn-primary btn-sm" icon="o-cog-6-tooth" />
                            </x-slot:trigger>

                            <x-mary-menu-item icon="o-swatch" title="Cambiar tema"
                                              x-on:click.stop="$dispatch('mary-toggle-theme')" />
                            <x-mary-menu-item :link="route('dashboard.parent.logout')" icon="o-power" title="Cerrar sesión" />
                        </x-mary-dropdown>
                    </div>
                </div>
            </header>
            {{ $slot }}
        </main>
    </div>

</x-layouts.app>
