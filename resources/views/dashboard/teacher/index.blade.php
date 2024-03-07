<x-layouts.teacher-dashboard>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:gap-8 xl:grid-cols-4">
        @if ($grade)
            <x-mary-stat :value="$grade" icon="o-academic-cap" title="Grado asignado" />
        @else
            <x-mary-stat icon="o-academic-cap" title="No tiene grado asignado" />
        @endif

        <x-mary-stat :value="$amountOfStudents" icon="o-users" title="Cantidad de estudiantes" />

        <x-mary-stat :value="$amountOfCourses" icon="o-briefcase" title="Cursos asigandos" />
        <x-mary-stat :value="$amountOfPosts" icon="o-chat-bubble-bottom-center-text" title="Posts creados" />

    </div>
</x-layouts.teacher-dashboard>
