<x-layouts.parent-dashboard>
    <div class="mx-auto grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2 md:gap-8">
        <x-mary-stat :value="$studentsCount" icon="o-users" title="Cantidad de estudiantes" />
        <x-mary-stat :value="$studentsNotEnrolled" icon="o-information-circle" title="Estudiantes sin matricular" />
    </div>
</x-layouts.parent-dashboard>
