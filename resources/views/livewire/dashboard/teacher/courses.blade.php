<div>
    <x-layouts.teacher-dashboard>
        <h1 class="mb-4 text-center text-4xl font-bold">Cursos</h1>
        <div class="flex justify-center gap-4">
            @foreach ($courses as $course)
                <x-mary-card :subtitle="$course->subject->name" :title="$course->grade->name" class="bg-base-100 shadow-lg"
                             progress-indicator="showStudents('{{ $course->grade->name }}')" separator>
                    <x-mary-button class="btn-primary" label="Mostrar estudiantes"
                                   wire:click="showStudents('{{ $course->id }}')" />
                </x-mary-card>
            @endforeach
        </div>

        <div class="my-5 flex items-center justify-center">
            <svg aria-hidden="true" class="dark:text-gray-600 h-8 w-8 animate-spin fill-blue-600 text-gray-200"
                 fill="none" viewBox="0 0 100 101" wire:loading wire:target='showStudents'
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                      fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                      fill="currentFill" />
            </svg>
        </div>
        @if (count($students) > 0)
            <div class="mx-auto max-w-4xl bg-white shadow" wire:loading.remove wire:target='showStudents'>

                <div class="overflow-x-auto shadow-md">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="bg-primary text-xs uppercase text-primary-content">
                            <tr>
                                <th class="px-6 py-3" scope="col">
                                    Nombre
                                </th>
                                @for ($i = 1; $i <= 4; $i++)
                                    <th class="px-6 py-3" scope="col">
                                        Nota {{ $i }}
                                    </th>
                                @endfor
                                <th class="px-6 py-3" scope="col">
                                    Promedio
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-base-100">
                            @foreach ($students as $student)
                                <tr class="border-b">
                                    <th class="whitespace-nowrap px-4 py-2 font-medium" scope="row">
                                        {{ $student['name'] }} {{ $student['last_name'] }}
                                    </th>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <td class="px-4 py-2" scope="col">
                                            <input class="dark:text-white input-primary block w-14 border p-2 text-center text-black"
                                                   type="text"
                                                   wire:model.blur.number='notes.{{ $student['id'] }}.note{{ $i }}'>
                                        </td>
                                    @endfor
                                    <th class="px-4 py-2" scope="col">
                                        <strong class="w-100 block text-center text-xl"
                                                x-text="$wire.notes[{{ $student['id'] }}].average"></strong>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endif
    </x-layouts.teacher-dashboard>
</div>
