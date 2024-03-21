<div class="mx-auto mt-10 max-w-2xl">
    @if (count($students) > 0)
        <div class="w-full rounded-lg bg-base-100 p-5 shadow-lg">
            <div class="w-full pb-5 pt-1">
                <div
                     class="mx-auto -mt-16 flex h-20 w-20 items-center justify-center overflow-hidden rounded-full bg-primary text-white shadow-lg">
                    <x-logo />
                </div>
            </div>
            <div class="mb-10">
                <h1 class="text-center text-xl font-bold uppercase text-base-content">Pago seguro</h1>
            </div>
            <div class="mb-10 space-y-4 rounded-xl bg-gray-300/80 p-5 text-gray-700 shadow">
                <h2 class="text-xl font-bold">Descripción del pago</h2>
                @foreach ($students as $student)
                    <div class="flex items-center justify-between" wire:key="{{ $student->id }}">
                        <x-mary-checkbox value="{{ $student->id }}" wire:model.change='selectedStudents'>
                            <x-slot:label>
                                <span class="text-center text-lg font-semibold text-black/70">
                                    {{ $student->full_name }}
                                    <x-mary-badge :value="$student->grade->name" class="badge-primary" />
                                </span>
                            </x-slot:label>
                        </x-mary-checkbox>

                        <span class="font-bold">RD$ 15,000</span>
                    </div>
                @endforeach
                <hr class="border-separate border-primary">
                <div class="flex items-center justify-between">
                    <span class="text-center text-lg font-semibold text-black/70">
                        Total:
                    </span>
                    <span class="font-extrabold">RD$ {{ $total }}</span>
                </div>
            </div>
            <div class="mb-3">
                <x-mary-input label="Nombre en la tarjeta" wire:model='name' />
            </div>
            <div class="mb-3">
                <x-mary-input label="Número de la tarjeta" placeholder="0000 0000 0000 0000" wire:model='cardNumber' />
            </div>
            <div class="-mx-2 mb-3 flex items-end">
                <div class="w-1/2 px-2">
                    <x-mary-select :options="$months" label="Fecha de expiración" placeholder="Selecciona el mes"
                                   wire:model='month' />
                </div>
                <div class="w-1/2 px-2">
                    <x-mary-select :options="$years" placeholder="Selecciona el año" wire:model="year" />
                </div>
            </div>
            <div class="mb-10">
                <x-mary-input class="w-32" label="CVV" placeholder="000" wire:model="cvv" />
            </div>
            <div>
                @error('total')
                    <span class="block text-center text-red-400">{{ $message }}</span>
                @enderror
                <x-mary-button class="btn-primary mx-auto flex w-full max-w-xs" icon-right="o-credit-card"
                               label="Pagar" wire:click='pay' wire:loading.attr='disabled' />
            </div>
        </div>
    @else
        <x-mary-alert class="alert-success" icon="o-face-smile" title="Todos los estudiantes estan matriculados" />
    @endif
</div>
