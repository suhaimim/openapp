

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }} > {{ $article->title }} 
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-4 px-5">
                    <div class="flex justify-between">
                        <span class="text-sm">Author: {{ $article->user->name }}</span>
                        <span class="text-sm">Posted at: {{ date('D d-M-Y H:i', strtotime($article->updated_at)) }}</span>
                    </div> 
                    <div class="max-w-full">
                        @if($article->image)
                        <img src="{{ '/storage/'.$article->image }}" alt="">
                        @endif
                    </div>
                    <p class="py-6">
                    {!! nl2br($article->body) !!}     
                    </p>    
                </div>
                <div class=" px-5">
                    <form action=""  class="px-5">
                        <label for="">Comments:</label>
                        <br>
                        <textarea name="" id="" class="w-full" rows="5"></textarea>
                        <br>
                        <input type="submit" class="border border-2 bg-gray-300 p-2" value="Reply">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</x-app-layout>