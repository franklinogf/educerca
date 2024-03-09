<x-layouts.parent-dashboard>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:gap-8 xl:grid-cols-4">
        <x-mary-stat :value="$studentsCount" icon="o-users" title="Cantidad de estudiantes" />

        <x-mary-stat description="This month" icon="o-arrow-trending-up" title="Sales" value="22.124" />

        <x-mary-stat description="This month" icon="o-arrow-trending-down" title="Lost" value="34" />

        <x-mary-stat class="text-orange-500" color="text-pink-500" description="This month" icon="o-arrow-trending-down"
                     title="Sales" value="22.124" />
    </div>
</x-layouts.parent-dashboard>
