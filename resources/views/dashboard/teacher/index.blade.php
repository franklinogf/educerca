<x-layouts.app>
    <div class="grid min-h-screen max-w-full grid-flow-col grid-cols-[300px_1fr]">
        <aside class="sticky top-0 flex h-screen flex-col space-y-4 bg-base-100 p-2 shadow">
            <div class="flex flex-none justify-center">
                <span class="text-2xl"><x-logo /></span>
            </div>
            <x-mary-menu class="flex-auto p-0">
                <x-mary-menu-item icon="o-envelope" title="Home" />
                <x-mary-menu-item badge="78+" icon="o-paper-airplane" title="Messages" />
                <x-mary-menu-item badge-classes="!badge-warning" badge="new" icon="o-sparkles" title="Hello" />

                <x-mary-menu-item icon="o-arrow-down" link="/docs/components/alert" title="Internal link" />

            </x-mary-menu>
            <div class="self-end">
                <x-mary-dropdown right>
                    <x-slot:trigger>
                        <x-mary-button class="btn-primary btn-sm" icon="o-cog-6-tooth" label="Alam Perez" responsive />
                    </x-slot:trigger>

                    <x-mary-menu-item icon="o-swatch" title="Cambiar tema"
                                      x-on:click.stop="$dispatch('mary-toggle-theme')" />
                    <x-mary-menu-item icon="o-power" title="Cerrar sesión" />
                </x-mary-dropdown>
            </div>
        </aside>
        <main class="p-4">
            <div class="grid grid-flow-col grid-cols-4 gap-4">
                <x-mary-stat icon="o-envelope" title="Messages" value="44" />

                <x-mary-stat description="This month" icon="o-arrow-trending-up" title="Sales" value="22.124" />

                <x-mary-stat description="This month" icon="o-arrow-trending-down" title="Lost" value="34" />

                <x-mary-stat class="text-orange-500" color="text-pink-500" description="This month"
                             icon="o-arrow-trending-down" title="Sales" value="22.124" />
            </div>
        </main>
    </div>
    <x-mary-theme-toggle class="hidden" />
</x-layouts.app>
