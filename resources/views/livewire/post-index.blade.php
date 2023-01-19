<div class="max-w-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">

            {{-- the button calls the showingpostmodal in the component  --}}

        <x-jet-button wire:click="ShowPostModal"> Create</x-jet-button>

    </div>
<div class="m-2 p-2">

    <div class ="my-2 overflow-x-auto sm:-mx-6 lg:-mx-6">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-gray-200">
                    <thead class ="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">ID </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Title </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Body</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500">Image</th>
                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500"> Action </th> --}}
                            </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr></tr>
                        <@foreach ($posts as $post)
                        <tr>
                                {{-- the button calls the showingpostalmodel in the component  --}}
                            <td class="px-6 py-4 whitespace-nowrap">{{$post->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$post->title}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$post->body}}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                            <img class="w-8 h-8 rounded-full" src="{{asset($newImage)}}">  
                          
                            </td>
                            <td class="px-6 py-4 text-right text-sm"> 
                                <x-jet-button wire:click="ShowEditModal({{$post->id}})"> Edit </x-jet-button>
                                <x-jet-button class="bg-red-400 hover:bg-red-600" wire:click="ShowDeleteModal({{$post->id}})"> Delete </x-jet-button>

                                 </td>
                            @endforeach

                        </tr>
    
                    </tbody>
                </table>
                <div class="my-2 p-2">Pagination </div>
            </div>
        </div>
    </div>

</div> 
<div> 

    {{-- the button calls the showingpostalmodel in the component  --}}

    <x-jet-dialog-modal wire:model="showingPostModel">
        @if($isEditMode)
        <x-slot name="title"> Update Post</x-slot>
        @else        
        <x-slot name="title"> Create Post</x-slot>
        @endif




        <x-slot name="content">
            {{-- <x-slot name="footer">

            </x-slot> --}}
            <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                <form enctype="multipart/form-data">
                    <div class="sm:col-span-6">
                        <label for="title" class="block text-sm font-medium text-gray-700"> Post Title</label>
                        <div class="mt-1">
                            <input type="text" wire:model.lazy="title" name="title"class="block w-full appearance-none bg-white border border-gray-400">
                        </div>
                            {{-- displaying empty input field --}}

                        @error('title') <span class"text-red-400">{{$message}}</span> @enderror

                        </div>

                        {{-- creating a picture input --}}

                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Post Image</label>
                            <div class="mt-1">

                                {{-- preivew the  old picture before saving it  --}}
                                @if ($oldImage)

                                Old image:
                                <img src ="{{Storage::url($oldImage)}}">
                                @endif

                                {{-- preivew the new picture before saving it  --}}
                                @if ($newImage)
                                photo Preview:
                                <img src ="{{$newImage->temporaryURL() }}">
                                @endif
                                <input type="file" id="image" wire:model="newImage" name="image" class="block w-full appearance-none bg-white border border-gray-400">
                            </div>
                            @error('newImage') <span class"text-red-400">{{$message}}</span> @enderror

                            </div>

                        <div class="sm:col-span-6">
                            <div class="sm:col-6 pt-5">
                                <label for="body" class="block text-sm font-medium text-gray-700">Body </label>
                                <div class="mt-1">
                                    <textarea id="body" row="3" wire:model.lazy="body"class="shadow-sm focus:ring-indigo-500 appearance-none g-white bordered">
                                    </textarea>
                                </div>
                                 @error('body') <span class"text-red-400">{{$message}}</span> @enderror

                            </div>
                        </div>
                        </form>
            </div>
        </x-slot>
        <x-slot name="footer">
                {{-- the button calls the storePost in the component  --}}

                @if($isEditMode)
            <x-jet-button wire:click="updatePost">Update</x-jet-button>
            @else
            <x-jet-button wire:click="storePost">Create</x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-model>
</div>
</div>
