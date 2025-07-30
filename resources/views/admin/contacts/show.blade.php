@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">Dettagli Contatto</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                            Ricevuto il {{ $contact->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        @if($contact->isNew())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Nuovo
                            </span>
                        @elseif($contact->isRead())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Letto
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Risposto
                            </span>
                        @endif
                        
                        @if(!$contact->isReplied())
                            <form method="POST" action="{{ route('admin.contacts.mark-replied', $contact) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                    Segna come risposto
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Informazioni contatto -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Informazioni Contatto</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Nome:</span>
                                <p class="text-gray-900 dark:text-white">{{ $contact->full_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Email:</span>
                                <p class="text-gray-900 dark:text-white">
                                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ $contact->email }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Oggetto:</span>
                                <p class="text-gray-900 dark:text-white">{{ $contact->subject }}</p>
                            </div>
                            @if($contact->read_at)
                                <div>
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Letto il:</span>
                                    <p class="text-gray-900 dark:text-white">{{ $contact->read_at->format('d/m/Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Azioni Rapide</h3>
                        <div class="space-y-3">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                               class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700 transition-colors">
                                Rispondi via Email
                            </a>
                            <a href="{{ route('admin.contacts.index') }}" 
                               class="block w-full px-4 py-2 bg-gray-600 text-white text-center rounded-md hover:bg-gray-700 transition-colors">
                                Torna alla Lista
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Messaggio -->
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Messaggio</h3>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="whitespace-pre-wrap text-gray-900 dark:text-white">
                            {{ $contact->message }}
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Messaggio ricevuto</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($contact->read_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Messaggio letto</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $contact->read_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($contact->isReplied())
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Risposta inviata</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $contact->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 