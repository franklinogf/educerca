<x-layouts.app>
    <div class="grid min-h-screen max-w-full grid-flow-col grid-cols-[300px_1fr]">
        <aside class="sticky top-0 flex h-screen flex-col space-y-4 bg-base-100 p-2 shadow">
            <div class="flex flex-none justify-center">
                <span class="text-2xl"><x-logo /></span>
            </div>
            <x-mary-menu activate-by-route active-bg-color="bg-primary text-primary-content" class="flex-auto p-0">
                <x-mary-menu-item :link="route('dashboard.teacher.home')" icon="o-envelope" title="Home" />
                <x-mary-menu-item icon="o-paper-airplane" title="Cursos" />
                <x-mary-menu-item icon="o-sparkles" title="Asistencias" />
                <x-mary-menu-item icon="o-sparkles" title="Foro" />

            </x-mary-menu>
            <div class="self-end">
                <x-mary-dropdown right>
                    <x-slot:trigger>
                        <x-mary-button :label="auth('teacher')->user()->fullName" class="btn-primary btn-sm" icon="o-cog-6-tooth" responsive />
                    </x-slot:trigger>

                    <x-mary-menu-item icon="o-swatch" title="Cambiar tema"
                                      x-on:click.stop="$dispatch('mary-toggle-theme')" />
                    <x-mary-menu-item icon="o-power" title="Cerrar sesión" />
                </x-mary-dropdown>
            </div>
        </aside>
        <main class="p-4">
            <x-mary-header title="Dashboard">
                <x-slot:actions> <x-mary-theme-toggle /></x-slot:actions>
            </x-mary-header>
            <div class="grid grid-flow-col grid-cols-4 gap-8">
                <x-mary-stat icon="o-envelope" title="Messages" value="44" />

                <x-mary-stat description="This month" icon="o-arrow-trending-up" title="Sales" value="22.124" />

                <x-mary-stat description="This month" icon="o-arrow-trending-down" title="Lost" value="34" />

                <x-mary-stat class="text-orange-500" color="text-pink-500" description="This month"
                             icon="o-arrow-trending-down" title="Sales" value="22.124" />
            </div>
        </main>
    </div>

</x-layouts.app>
