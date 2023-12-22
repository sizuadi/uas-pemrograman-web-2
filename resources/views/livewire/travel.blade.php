 <x-slot name="header">
     <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Travel CRUD') }}
     </h2>
 </x-slot>

 <div class="py-12">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
             @if (session()->has('message'))
                 <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                     <div class="flex">
                         <div>
                             <p class="text-sm">{{ session('message') }}</p>
                         </div>
                     </div>
                 </div>
             @endif
             <button wire:click="create()"
                 class="my-4 inline-flex justify-center w-48 rounded-md border border-transparent px-4 py-2 bg-green-600 text-base font-bold text-white shadow-sm hover:bg-green-700">
                 Create Travel
             </button>
             @if ($isModalOpen)
                 @include('livewire.travel-create')
             @endif
             <table class="table-fixed w-full mt-5">
                 <thead>
                     <tr class="bg-gray-100">
                         <th class="px-4 py-2 w-20">No.</th>
                         <th class="px-4 py-2">Name</th>
                         <th class="px-4 py-2">Description</th>
                         <th class="px-4 py-2">Image</th>
                         <th class="px-4 py-2">Price</th>
                         <th class="px-4 py-2">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($travels as $key => $travel)
                         <tr>
                             <td class="border px-4 py-2">{{ $key + 1 }}</td>
                             <td class="border px-4 py-2">{{ $travel->name }}</td>
                             <td class="border px-4 py-2">{{ $travel->description }}</td>
                             <td class="border px-4 py-2">
                                 <img src="{{ asset('storage/' . $travel->image) }}" style="width: 100px;">
                             </td>
                             <td class="border px-4 py-2">${{ $travel->price }}</td>
                             <td class="border px-4 py-2">
                                 <button wire:click="edit({{ $travel->id }})"
                                     class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                                 <button wire:click="delete({{ $travel->id }})"
                                     class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>
