<div>
    <!-- Gallery Filters -->
    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
        <button wire:click="setFilter('all')" type="button" 
            class="{{ $filter === 'all' ? 'text-white hover:text-white border border-gray-800 bg-gray-800 hover:bg-[#0B1320]' : 'text-white border border-white hover:border-gray-700 bg-[#0B1320]' }} focus:ring-4 focus:outline-none focus:ring-ring-gray-700 rounded-lg text-base font-medium px-5 py-2.5 text-center me-3 mb-3 transition-colors">
            All categories
        </button>
        <button wire:click="setFilter('images')" type="button" 
            class="{{ $filter === 'images' ? 'text-white hover:text-white border border-gray-800 bg-gray-800 hover:bg-[#0B1320]' : 'text-white border border-white hover:border-gray-700 bg-[#0B1320]' }} focus:ring-4 focus:outline-none focus:ring-ring-gray-700 rounded-lg text-base font-medium px-5 py-2.5 text-center me-3 mb-3 transition-colors">
            Images
        </button>
        <button wire:click="setFilter('videos')" type="button" 
            class="{{ $filter === 'videos' ? 'text-white hover:text-white border border-gray-800 bg-gray-800 hover:bg-[#0B1320]' : 'text-white border border-white hover:border-gray-700 bg-[#0B1320]' }} focus:ring-4 focus:outline-none focus:ring-ring-gray-700 rounded-lg text-base font-medium px-5 py-2.5 text-center me-3 mb-3 transition-colors">
            Videos
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-16">
        @if($filter === 'all' || $filter === 'images')
            @foreach($images as $image)
            <div>
                <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/galleries/' . $image) }}" alt="Gallery Image">
            </div>
            @endforeach
        @endif

        @if($filter === 'all' || $filter === 'videos')
            @foreach($videos as $video)
            <div>
                <video class="h-auto max-w-full rounded-lg" controls>
                    <source src="{{ asset('images/galleries/' . $video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            @endforeach
        @endif
    </div>
</div>
