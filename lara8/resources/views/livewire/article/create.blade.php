<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-85"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label class="inline-block w-32 font-bold">Category:</label>
                            <select name="category" wire:model="category_id" class="border shadow p-2 bg-white w-full">
                                <option value=''>Choose a category</option>
                                @foreach($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" class="sshadow appearance-none border w-full" placeholder="Title" wire:model.lazy="title">
                            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <textarea rows="5" class="shadow appearance-none border w-full" wire:model.lazy="body" placeholder="Contents"></textarea>
                            @error('body') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>   
                        <div class="mb-4">
                            <input type="file" id="image" wire:change="$emit('fileChoosen')" wire:model="image"> 
                            {{-- @error('image') <span class="text-red-500">{{ $message }}</span>@enderror     --}}
                            @if($image)
                                <img src="{{ $image }}" alt="" width="200" />
                            @else
                                <img alt="" width="200" wire:model="image" />
                            @endif                         
                        </div>                                       
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"> Save </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"> Close </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>


   <script>
    window.livewire.on('fileChoosen', () => {
        let inputField = document.getElementById('image');
        let file = inputField.files[0];
        const reader = new FileReader();

        reader.onload = () => {
            window.livewire.emit('fileUpload', reader.result);
        };
        reader.readAsDataURL(file);
    });
</script>