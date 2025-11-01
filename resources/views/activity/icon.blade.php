<div x-data="{ open: false, selected: { icon: 'fas fa-calendar-alt', label: 'Arisan' } }" class="relative w-full">
    <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Icon Kegiatan</label>
    <button type="button" @click="open = !open"
        class="w-full border rounded px-4 py-2 text-left flex items-center gap-3 shadow-sm bg-white">
        <i :class="selected.icon" class="text-lg"></i>
        <span x-text="selected.label"></span>
    </button>

    <div x-show="open" @click.away="open = false" class="absolute bg-white border mt-1 w-full z-10 shadow rounded">
        <template x-for="item in [
            { label: 'Arisan', icon: 'fas fa-money-bill-wave' },
            { label: 'Makan-makan', icon: 'fas fa-utensils' },
            { label: 'Keagamaan', icon: 'fas fa-mosque' },
            { label: 'Ulang Tahun', icon: 'fas fa-birthday-cake' },
            { label: 'Kumpul-kumpul', icon: 'fas fa-users' }
        ]" :key="item.label">
            <div @click="selected = item; open = false"
                class="flex items-center gap-3 px-4 py-2 cursor-pointer hover:bg-gray-100">
                <i :class="item.icon" class="text-lg"></i>
                <span x-text="item.label"></span>
            </div>
        </template>
    </div>

    <!-- Hidden input for backend -->
    <input type="hidden" name="icon" :value="selected.icon">
</div>
