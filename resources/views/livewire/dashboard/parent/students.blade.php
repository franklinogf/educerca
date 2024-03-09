<div class="mx-auto max-w-2xl space-y-5">
    @foreach ($this->students as $student)
        @if ($student->is_enrolled)
            <x-mary-collapse separator>
                <x-slot:heading class="bg-base-100">
                    {{ $student->full_name }} <x-mary-badge :value="$student->grade->name" class="badge-primary" />
                </x-slot:heading>
                <x-slot:content class="bg-base-100">

                    @forelse ($student->notes as $note)
                        <article class="flex items-center gap-x-5">
                            <h3 class="text-xl font-semibold">{{ $note->classroom->subject->name }}</h3>
                            <x-mary-badge :value="$note->average" class="badge-primary" />
                        </article>
                    @empty
                        <small>No tiene notas disponibles</small>
                    @endforelse
                </x-slot:content>
            </x-mary-collapse>
        @else
            <x-mary-card class="bg-base-100 shadow-lg" wire:key='{{ $student->id }}'>
                <div class="mb-2 text-xl font-medium">{{ $student->full_name }} <x-mary-badge :value="$student->grade->name"
                                  class="badge-primary" /></div>
                <x-mary-alert class="alert-warning" description="Debe de pagar la matricula para poder ver la nota"
                              icon="o-exclamation-triangle" shadow title="Matricula no pagada">
                    <x-slot:actions>
                        <x-mary-button :link="route('dashboard.parent.enrollment')" class="btn-primary" label="Pagar matrícula" />
                    </x-slot:actions>
                </x-mary-alert>
            </x-mary-card>
        @endif
    @endforeach
    <x-mary-button label="Desmatricular" wire:click="resetEnrollment" />
    <small class="text-xs">Esto solo es para probar y hacer que los estudiantes no esten matriculados</small>
</div>
