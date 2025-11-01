<div class="container mx-auto">
    <div class="flex flex-col items-start mb-10 mt-4">
        @isset($title)
            <h1 class="font-poppins text-2xl font-bold text-gray-800">{{ $title }}</h1>
        @endisset
        @isset($description)
            <p class="text-sm text-gray-600 truncate mt-1">{{ $description }}</p>
        @endisset
    </div>
</div>
