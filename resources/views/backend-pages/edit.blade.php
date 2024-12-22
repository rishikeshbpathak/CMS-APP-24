<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-dark">
                    <form action="{{ route('pages.update', $page->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This tells the controller it's an update request -->

                        <!-- Title Input -->
                        <div>
                            <label class="text-white" for="title">Title</label>
                            <input type="text" id="title" name="title" class="w-full" value="{{ old('title', $page->title) }}" required>
                        </div>

                        <!-- Slug Input -->
                        <div>
                            <label class="text-white" for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" class="w-full" value="{{ old('slug', $page->slug) }}" required>
                        </div>

                        <!-- Content Textarea -->
                        <div>
                            <label class="text-white" for="content">Content</label>
                            <textarea id="content" name="content" class="w-full" rows="5" required>{{ old('content', $page->content) }}</textarea>
                        </div>

                        <!-- Parent Page Dropdown -->
                        <div>
                            <label class="text-white" for="parent_id">Parent Page</label>
                            <select id="parent_id" name="parent_id" class="w-full">
                                <option value="">-- Select Parent Page (if any) --</option>
                                @foreach($parents as $parentPage)
                                    <option value="{{ $parentPage->id }}"
                                            {{ old('parent_id', $page->parent_id) == $parentPage->id ? 'selected' : '' }}>
                                        {{ $parentPage->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Update Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 border text-white px-6 py-2 rounded hover:bg-blue-700 inline-flex items-center">
                                Update Page
                            </button>
                            <a href="{{ route('pages.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-700 inline-flex items-center">
                                Back
                            </a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
