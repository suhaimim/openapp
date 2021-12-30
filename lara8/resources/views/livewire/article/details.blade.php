

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }} > {{ $article->title }} 
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                   
           <div class="flex justify-between">
               <span class="text-sm">Author: {{ $article->user->name }}</span>
               <span class="text-sm">Posted at: {{ date('D d-M-Y H:i', strtotime($article->updated_at)) }}</span>
           </div> 
           <p class="py-6">
            {!! nl2br($article->body) !!}     
           </p>

        </div>
    </div>
</div>

</x-app-layout>