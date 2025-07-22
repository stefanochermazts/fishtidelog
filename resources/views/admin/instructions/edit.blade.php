<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.edit_instruction') }}: {{ $instruction->getLocalizedTitle() }}
            </h2>
            <a href="{{ route('admin.instructions.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('messages.back_to_instructions') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 pb-32">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('admin.instructions.update', $instruction) }}" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Section Info -->
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('messages.section_key') }}
                                </label>
                                <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                                    {{ ucfirst(str_replace('_', ' ', $instruction->section_key)) }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('messages.instruction_order') }}
                                </label>
                                <input type="number" name="order" value="{{ old('order', $instruction->order) }}" min="0"
                                       class="mt-1 block w-20 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                       {{ $instruction->is_active ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('messages.instruction_active') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Language Tabs -->
                    <div class="mb-6" x-data="{ activeTab: 'it' }">
                        <div class="flex space-x-1 bg-gray-100 dark:bg-gray-700 p-1 rounded-lg mb-6">
                            <button type="button" @click="activeTab = 'it'" 
                                    :class="activeTab === 'it' ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'"
                                    class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors">
                                🇮🇹 Italiano
                            </button>
                            <button type="button" @click="activeTab = 'en'" 
                                    :class="activeTab === 'en' ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'"
                                    class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors">
                                🇬🇧 English
                            </button>
                            <button type="button" @click="activeTab = 'de'" 
                                    :class="activeTab === 'de' ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'"
                                    class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors">
                                🇩🇪 Deutsch
                            </button>
                            <button type="button" @click="activeTab = 'fr'" 
                                    :class="activeTab === 'fr' ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'"
                                    class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors">
                                🇫🇷 Français
                            </button>
                        </div>

                        <!-- Italian -->
                        <div x-show="activeTab === 'it'" class="space-y-4">
                            <div>
                                <label for="title_it" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Titolo (Italiano)
                                </label>
                                <input type="text" name="title_it" id="title_it" 
                                       value="{{ old('title_it', $instruction->title['it'] ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="content_it" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contenuto (Italiano)
                                </label>
                                <textarea name="content_it" id="content_it" class="tinymce">{{ old('content_it', $instruction->content['it'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- English -->
                        <div x-show="activeTab === 'en'" class="space-y-4">
                            <div>
                                <label for="title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Title (English)
                                </label>
                                <input type="text" name="title_en" id="title_en" 
                                       value="{{ old('title_en', $instruction->title['en'] ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="content_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Content (English)
                                </label>
                                <textarea name="content_en" id="content_en" class="tinymce">{{ old('content_en', $instruction->content['en'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- German -->
                        <div x-show="activeTab === 'de'" class="space-y-4">
                            <div>
                                <label for="title_de" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Titel (Deutsch)
                                </label>
                                <input type="text" name="title_de" id="title_de" 
                                       value="{{ old('title_de', $instruction->title['de'] ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="content_de" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Inhalt (Deutsch)
                                </label>
                                <textarea name="content_de" id="content_de" class="tinymce">{{ old('content_de', $instruction->content['de'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- French -->
                        <div x-show="activeTab === 'fr'" class="space-y-4">
                            <div>
                                <label for="title_fr" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Titre (Français)
                                </label>
                                <input type="text" name="title_fr" id="title_fr" 
                                       value="{{ old('title_fr', $instruction->title['fr'] ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="content_fr" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contenu (Français)
                                </label>
                                <textarea name="content_fr" id="content_fr" class="tinymce">{{ old('content_fr', $instruction->content['fr'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="sticky bottom-0 bg-white dark:bg-gray-800 pt-6 mt-8 border-t border-gray-200 dark:border-gray-700 z-10">
                        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                            <a href="{{ route('instructions.index') }}" target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ __('messages.preview') }}
                            </a>
                            
                            <button type="submit"
                                    class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-lg transition-all hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('messages.save_instruction') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '.tinymce',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link | help',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px }',
                skin: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
                content_css: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default',
                images_upload_url: '{{ route("admin.instructions.upload-image") }}',
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise(function(resolve, reject) {
                        const xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '{{ route("admin.instructions.upload-image") }}');
                        
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        
                        xhr.upload.onprogress = function (e) {
                            progress(e.loaded / e.total * 100);
                        };
                        
                        xhr.onload = function() {
                            if (xhr.status === 403) {
                                reject({message: 'HTTP Error: ' + xhr.status, remove: true});
                                return;
                            }
                            
                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                            
                            const json = JSON.parse(xhr.responseText);
                            
                            if (!json || typeof json.url != 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            
                            resolve(json.url);
                        };
                        
                        xhr.onerror = function () {
                            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                        };
                        
                        const formData = new FormData();
                        formData.append('upload', blobInfo.blob(), blobInfo.filename());
                        
                        xhr.send(formData);
                    });
                },
                branding: false,
                promotion: false,
            });
        });
    </script>
</x-app-layout> 