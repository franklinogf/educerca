<div>
    <h1 class="text-center text-2xl font-semibold">
        Asistencias de el mes <span class="font-bold">{{ Arr::pluck($months, 'name', 'id')[$selectedMonth] }}</span>
    </h1>
    <div class="my-4 w-48">
        <x-mary-select :options="$months" label="Cambiar el mes" wire:model.change='selectedMonth' />
    </div>
    <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-primary text-xs uppercase text-white">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        Nombre
                    </th>
                    @foreach ($weekDays as $date)
                        <th @class([
                            'w-16 text-center',
                            'border-r-2 border-secondary' => $date->isFriday() && !$loop->last,
                        ]) wire:key="{{ 'day' . $date }}">
                            {{ strtoupper(substr($date->locale('es')->isoFormat('dd'), 0, 1)) }}
                            <br>
                            {{ $date->day }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-base-100">
                @foreach ($this->students as $student)
                    <tr class="border-b" wire:key="{{ $student->id }}">
                        <th class="whitespace-nowrap px-2 py-1 font-medium" scope="row">
                            {{ $student->full_name }}
                        </th>
                        @foreach ($weekDays as $date)
                            <td @class([
                                'px-2 py-1',
                                'border-r-2 border-secondary' => $date->isFriday() && !$loop->last,
                            ]) scope="col" wire:key="{{ $date }}">
                                <select {{ $date->greaterThan(now()) ? 'disabled' : '' }}
                                        class="dark:text-white select select-primary select-sm w-10 rounded-none bg-[url()] px-2 text-black"
                                        wire:key="{{ 'select' . $date }}"
                                        wire:model.change.number='attendances.{{ $student->id }}.{{ $date->format('Y-m-d') }}'>
                                    <option selected value=""></option>
                                    @foreach ($attendanceOptions as $option)
                                        <option value="{{ $option->id }}">
                                            {{ $option->option }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
