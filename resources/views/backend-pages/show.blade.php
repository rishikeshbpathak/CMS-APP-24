<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard > Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <span>Pages List</span> <!-- This will stay on the left -->
                    <a href="{{ route('pages.create') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-700">
                        Add New Page
                    </a>
                </div>

            </div>

            <table class="w-full min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-white">#</th>
                        <th class="px-4 py-2 text-white">Title</th>
                        <th class="px-4 py-2 text-white">Slug</th>
                        <th class="px-4 py-2 text-white">Parent Page</th>
                        <th class="px-4 py-2 text-white">Content</th>
                        <th class="px-4 py-2 text-white" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($pages as $key=>$page)
                        <!-- Display Parent Page -->
                        <tr class="border  odd:bg-gray-100 even:bg-white">
                            <td class="px-4 py-2">{{ $key+1}}</td>
                            <td class="px-4 py-2">{{ $page->title }}</td>
                            <td class="px-4 py-2">{{ $page->slug }}</td>
                            <td class="px-4 py-2">{{ $page->parent_id ? $page->parent->title : 'No Parent' }}</td>
                            <td class="px-4 py-2">{{ \Str::limit($page->content, 50) }}</td>
                            <td class="px-4 py-1" width="10%">
                                <!-- Flex container for horizontal alignment -->
                                <div class="flex items-center space-x-2">
                                    <!-- Edit button -->
                                    <a href="{{ route('pages.edit', $page->id) }}"
                                        class="text-white hover:text-white bg-yellow-400 hover:bg-yellow-300 focus:ring-red-300 rounded px-3 py-1 h-8 flex items-center justify-center">
                                        Edit
                                    </a>

                                    <!-- Delete button -->
                                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white hover:bg-red-600 focus:ring-2 focus:ring-red-300 rounded px-3 py-1 h-8 flex items-center justify-center">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                        <!-- Loop through children pages -->
                       @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
