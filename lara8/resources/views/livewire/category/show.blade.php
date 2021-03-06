    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()" class="border-2 border-indigo-400 bg-indigo-500 text-white font-bold py-2 px-4 rounded my-3">New Category</button>
            @if($isDialogOpen)
            @include('livewire.category.create')
            @endif      
            
            <table class="table-fixed w-full leading-normal">
                <thead>
                    <tr class="px-5 py-3 border-b-2 border-gray-600 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="px-4 py-2" style="width: 30px">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2" style="width: 120px">Created By</th>
                        <th class="px-4 py-2" style="width: 200px">Update At</th>
                        <th class="px-4 py-2" style="width: 180px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $item)
                        <tr class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="px-4 py-2">{{ $item->name }}</td>
                            <td class="px-4 py-2">{{ $item->description}}</td>
                            <td class="px-4 py-2">{{ $item->user->name }}</td>
                            <td class="px-4 py-2">{{ date('D d-M-Y H:i', strtotime($item->updated_at)) }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="edit({{ $item->id }})" class="border-2 border-red-700 text-red-700 font-bold py-2 px-4">Edit</button>
                                <button wire:click="delete({{ $item->id }})" class="border-2 border-red-700 bg-red-700 text-white font-bold py-2 px-4">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-red-500 font-bold py-2 px-4">Data is empty!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>            
            {{ $categories->links() }}    
        </div>
    </div>
