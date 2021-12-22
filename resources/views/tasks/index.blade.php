<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('tasks.create') }}" class="bg-lime-500 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded">Add Task</a>            
            </div>
            <div class="flex flex-col">
                <div class="-my-2 sm:-mx-8 lg:-mx-12">
                    <div class="py-2 align-middle inline-block w-full sm:px-8 lg:px-12">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Author
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descriptions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <!-- 
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                     -->
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{URL::asset('img/avatar1.png')}}" alt="" height="40">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            Jane Cooper
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            jane.cooper@example.com
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                        </span>
                                    </td>
                                    <!-- 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Admin
                                    </td>
                                    -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="border-2 border-lime-500 text-green-500 hover:bg-lime-400 p-2 rounded">View</a>
                                        <a href="#" class="border-2 border-cyan-500 text-cyan-500 hover:bg-cyan-400 p-2 rounded">Edit</a>
                                        <a href="#" class="border-2 border-rose-500 text-red-500 hover:bg-rose-400 p-2 rounded">Delete</a>
                                    </td>
                                </tr>

                                <!-- More tasks... -->
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{URL::asset('img/avatar1.png')}}" alt="" height="40">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $task->id }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $task->id }}@example.com
                                                </div>
                                            </div>
                                            </div>
                                        </td>
    
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->description }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                            </span>
                                        </td>
    
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="border-2 border-lime-500 text-green-500 hover:bg-lime-400 p-2 rounded">View</a>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="border-2 border-cyan-500 text-cyan-500 hover:bg-cyan-400 p-2 rounded">Edit</a>
                                            <form class="inline-flex" action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="border-2 border-rose-500 text-red-500 hover:bg-rose-400 p-2 rounded" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</x-app-layout>
