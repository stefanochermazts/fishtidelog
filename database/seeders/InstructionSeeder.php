<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruction;

class InstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructions = [
            [
                'section_key' => 'fishing_spots',
                'title' => [
                    'it' => 'Come Creare i Punti di Pesca',
                    'en' => 'How to Create Fishing Spots',
                    'de' => 'Wie man Angelplätze erstellt',
                    'fr' => 'Comment Créer des Spots de Pêche'
                ],
                'content' => [
                    'it' => '<div class="space-y-6">
                        <p class="text-lg">I punti di pesca sono la base per organizzare le tue uscite. Ecco come crearli:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Passo 1: Accedi alla sezione Punti Pesca</h3>
                            <p>Dal menu principale, clicca su "Punti Pesca" e poi su "Nuovo Punto".</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Passo 2: Inserisci la Posizione</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Usa la mappa interattiva per selezionare il punto esatto</li>
                                <li>Oppure inserisci manualmente latitudine e longitudine</li>
                                <li>Puoi anche cercare per indirizzo usando il pulsante "Trova coordinate"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">✏️ Passo 3: Aggiungi Informazioni</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Nome:</strong> Scegli un nome riconoscibile (es. "Molo Porto")</li>
                                <li><strong>Tipo:</strong> Seleziona da riva, barca, molo, etc.</li>
                                <li><strong>Descrizione:</strong> Note utili su correnti, fondali, accessi</li>
                                <li><strong>Privato/Pubblico:</strong> Scegli se condividere con altri utenti</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">⭐ Suggerimento Pro</h3>
                            <p>Aggiungi sempre una buona descrizione con dettagli su fondali, correnti e migliori orari. Ti sarà utile per le prossime uscite!</p>
                        </div>
                    </div>',
                    
                    'en' => '<div class="space-y-6">
                        <p class="text-lg">Fishing spots are the foundation for organizing your trips. Here\'s how to create them:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Step 1: Access the Fishing Spots Section</h3>
                            <p>From the main menu, click on "Fishing Spots" and then "New Spot".</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Step 2: Enter the Location</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Use the interactive map to select the exact point</li>
                                <li>Or manually enter latitude and longitude</li>
                                <li>You can also search by address using the "Find coordinates" button</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">✏️ Step 3: Add Information</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Name:</strong> Choose a recognizable name (e.g., "Harbor Pier")</li>
                                <li><strong>Type:</strong> Select from shore, boat, pier, etc.</li>
                                <li><strong>Description:</strong> Useful notes on currents, depths, access</li>
                                <li><strong>Private/Public:</strong> Choose whether to share with other users</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">⭐ Pro Tip</h3>
                            <p>Always add a good description with details about depths, currents, and best times. It will be useful for your next trips!</p>
                        </div>
                    </div>',
                    
                    'de' => '<div class="space-y-6">
                        <p class="text-lg">Angelplätze sind die Grundlage für die Organisation Ihrer Ausflüge. So erstellen Sie sie:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Schritt 1: Gehen Sie zum Bereich Angelplätze</h3>
                            <p>Klicken Sie im Hauptmenü auf "Angelplätze" und dann auf "Neuer Platz".</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Schritt 2: Standort eingeben</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Verwenden Sie die interaktive Karte, um den genauen Punkt auszuwählen</li>
                                <li>Oder geben Sie manuell Breiten- und Längengrad ein</li>
                                <li>Sie können auch nach Adresse suchen mit dem Button "Koordinaten finden"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">✏️ Schritt 3: Informationen hinzufügen</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Name:</strong> Wählen Sie einen erkennbaren Namen (z.B. "Hafenpier")</li>
                                <li><strong>Typ:</strong> Wählen Sie aus Ufer, Boot, Pier, usw.</li>
                                <li><strong>Beschreibung:</strong> Nützliche Notizen zu Strömungen, Tiefen, Zugang</li>
                                <li><strong>Privat/Öffentlich:</strong> Wählen Sie, ob Sie mit anderen Benutzern teilen möchten</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">⭐ Profi-Tipp</h3>
                            <p>Fügen Sie immer eine gute Beschreibung mit Details zu Tiefen, Strömungen und besten Zeiten hinzu. Es wird für Ihre nächsten Ausflüge nützlich sein!</p>
                        </div>
                    </div>',
                    
                    'fr' => '<div class="space-y-6">
                        <p class="text-lg">Les spots de pêche sont la base pour organiser vos sorties. Voici comment les créer :</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Étape 1 : Accédez à la section Spots de Pêche</h3>
                            <p>Depuis le menu principal, cliquez sur "Spots de Pêche" puis sur "Nouveau Spot".</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Étape 2 : Entrez l\'emplacement</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Utilisez la carte interactive pour sélectionner le point exact</li>
                                <li>Ou entrez manuellement latitude et longitude</li>
                                <li>Vous pouvez aussi chercher par adresse avec le bouton "Trouver coordonnées"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">✏️ Étape 3 : Ajoutez des informations</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Nom :</strong> Choisissez un nom reconnaissable (ex. "Jetée du Port")</li>
                                <li><strong>Type :</strong> Sélectionnez rivage, bateau, jetée, etc.</li>
                                <li><strong>Description :</strong> Notes utiles sur courants, profondeurs, accès</li>
                                <li><strong>Privé/Public :</strong> Choisissez si partager avec d\'autres utilisateurs</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">⭐ Conseil Pro</h3>
                            <p>Ajoutez toujours une bonne description avec des détails sur profondeurs, courants et meilleurs horaires. Ce sera utile pour vos prochaines sorties !</p>
                        </div>
                    </div>'
                ],
                'order' => 1
            ],
            
            [
                'section_key' => 'fishing_trips',
                'title' => [
                    'it' => 'Come Registrare le Uscite di Pesca',
                    'en' => 'How to Record Fishing Trips',
                    'de' => 'Wie man Angelausflüge aufzeichnet',
                    'fr' => 'Comment Enregistrer les Sorties de Pêche'
                ],
                'content' => [
                    'it' => '<div class="space-y-6">
                        <p class="text-lg">Le uscite di pesca ti permettono di tenere traccia delle tue sessioni e analizzare i risultati. Ecco come procedere:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Passo 1: Crea una Nuova Uscita</h3>
                            <p>Dal menu "Uscite", clicca su "Nuova Uscita" o usa il pulsante rapido dalla dashboard.</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Passo 2: Scegli il Punto di Pesca (Opzionale)</h3>
                            <p><strong>Importante:</strong> Puoi registrare un\'uscita anche SENZA punto di pesca predefinito!</p>
                            <ul class="list-disc list-inside space-y-1 mt-2">
                                <li><strong>Con punto:</strong> Seleziona un punto esistente dal menu a tendina</li>
                                <li><strong>Senza punto:</strong> Lascia vuoto e aggiungi le coordinate durante l\'uscita</li>
                                <li><strong>Nuovo punto:</strong> Crea al volo un nuovo punto durante la registrazione</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">⏰ Passo 3: Imposta Data e Orari</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Data:</strong> Scegli il giorno dell\'uscita</li>
                                <li><strong>Ora inizio:</strong> Quando hai iniziato a pescare</li>
                                <li><strong>Ora fine:</strong> Quando hai finito (lascia vuoto se in corso)</li>
                                <li><strong>Durata:</strong> Viene calcolata automaticamente</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🌊 Passo 4: Aggiungi Condizioni (Opzionale)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Meteo:</strong> Sole, nuvoloso, pioggia</li>
                                <li><strong>Vento:</strong> Intensità e direzione</li>
                                <li><strong>Temperatura:</strong> Dell\'aria e dell\'acqua</li>
                                <li><strong>Note:</strong> Osservazioni personali</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Suggerimenti Utili</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Registra l\'uscita anche se non peschi nulla - i dati sono sempre utili</li>
                                <li>Puoi aggiungere le catture durante o dopo l\'uscita</li>
                                <li>Le condizioni meteo aiutano a capire i pattern di pesca</li>
                                <li>Usa le note per ricordare esche efficaci o tecniche usate</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'en' => '<div class="space-y-6">
                        <p class="text-lg">Fishing trips allow you to track your sessions and analyze results. Here\'s how to proceed:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Step 1: Create a New Trip</h3>
                            <p>From the "Trips" menu, click "New Trip" or use the quick button from the dashboard.</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Step 2: Choose Fishing Spot (Optional)</h3>
                            <p><strong>Important:</strong> You can record a trip even WITHOUT a predefined fishing spot!</p>
                            <ul class="list-disc list-inside space-y-1 mt-2">
                                <li><strong>With spot:</strong> Select an existing spot from the dropdown</li>
                                <li><strong>Without spot:</strong> Leave empty and add coordinates during the trip</li>
                                <li><strong>New spot:</strong> Create a new spot on-the-fly during recording</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">⏰ Step 3: Set Date and Times</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Date:</strong> Choose the trip day</li>
                                <li><strong>Start time:</strong> When you started fishing</li>
                                <li><strong>End time:</strong> When you finished (leave empty if ongoing)</li>
                                <li><strong>Duration:</strong> Calculated automatically</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🌊 Step 4: Add Conditions (Optional)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Weather:</strong> Sunny, cloudy, rain</li>
                                <li><strong>Wind:</strong> Intensity and direction</li>
                                <li><strong>Temperature:</strong> Air and water temperature</li>
                                <li><strong>Notes:</strong> Personal observations</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Useful Tips</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Record the trip even if you catch nothing - data is always useful</li>
                                <li>You can add catches during or after the trip</li>
                                <li>Weather conditions help understand fishing patterns</li>
                                <li>Use notes to remember effective baits or techniques used</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'de' => '<div class="space-y-6">
                        <p class="text-lg">Angelausflüge ermöglichen es Ihnen, Ihre Sitzungen zu verfolgen und Ergebnisse zu analysieren. So gehen Sie vor:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Schritt 1: Erstellen Sie einen neuen Ausflug</h3>
                            <p>Klicken Sie im Menü "Ausflüge" auf "Neuer Ausflug" oder verwenden Sie die Schnelltaste vom Dashboard.</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Schritt 2: Angelplatz wählen (Optional)</h3>
                            <p><strong>Wichtig:</strong> Sie können einen Ausflug auch OHNE vordefinierten Angelplatz aufzeichnen!</p>
                            <ul class="list-disc list-inside space-y-1 mt-2">
                                <li><strong>Mit Platz:</strong> Wählen Sie einen bestehenden Platz aus dem Dropdown</li>
                                <li><strong>Ohne Platz:</strong> Lassen Sie es leer und fügen Sie Koordinaten während des Ausflugs hinzu</li>
                                <li><strong>Neuer Platz:</strong> Erstellen Sie spontan einen neuen Platz während der Aufzeichnung</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">⏰ Schritt 3: Datum und Zeiten festlegen</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Datum:</strong> Wählen Sie den Ausflugstag</li>
                                <li><strong>Startzeit:</strong> Wann Sie mit dem Angeln begonnen haben</li>
                                <li><strong>Endzeit:</strong> Wann Sie aufgehört haben (leer lassen wenn laufend)</li>
                                <li><strong>Dauer:</strong> Wird automatisch berechnet</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🌊 Schritt 4: Bedingungen hinzufügen (Optional)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Wetter:</strong> Sonnig, bewölkt, Regen</li>
                                <li><strong>Wind:</strong> Intensität und Richtung</li>
                                <li><strong>Temperatur:</strong> Luft- und Wassertemperatur</li>
                                <li><strong>Notizen:</strong> Persönliche Beobachtungen</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Nützliche Tipps</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Zeichnen Sie den Ausflug auf, auch wenn Sie nichts fangen - Daten sind immer nützlich</li>
                                <li>Sie können Fänge während oder nach dem Ausflug hinzufügen</li>
                                <li>Wetterbedingungen helfen, Angelmuster zu verstehen</li>
                                <li>Verwenden Sie Notizen, um sich an effektive Köder oder verwendete Techniken zu erinnern</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'fr' => '<div class="space-y-6">
                        <p class="text-lg">Les sorties de pêche vous permettent de suivre vos sessions et d\'analyser les résultats. Voici comment procéder :</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Étape 1 : Créer une nouvelle sortie</h3>
                            <p>Depuis le menu "Sorties", cliquez sur "Nouvelle Sortie" ou utilisez le bouton rapide du tableau de bord.</p>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">📍 Étape 2 : Choisir le spot de pêche (Optionnel)</h3>
                            <p><strong>Important :</strong> Vous pouvez enregistrer une sortie même SANS spot de pêche prédéfini !</p>
                            <ul class="list-disc list-inside space-y-1 mt-2">
                                <li><strong>Avec spot :</strong> Sélectionnez un spot existant dans le menu déroulant</li>
                                <li><strong>Sans spot :</strong> Laissez vide et ajoutez les coordonnées pendant la sortie</li>
                                <li><strong>Nouveau spot :</strong> Créez un nouveau spot à la volée pendant l\'enregistrement</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">⏰ Étape 3 : Définir date et horaires</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Date :</strong> Choisissez le jour de la sortie</li>
                                <li><strong>Heure début :</strong> Quand vous avez commencé à pêcher</li>
                                <li><strong>Heure fin :</strong> Quand vous avez terminé (laissez vide si en cours)</li>
                                <li><strong>Durée :</strong> Calculée automatiquement</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🌊 Étape 4 : Ajouter conditions (Optionnel)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Météo :</strong> Ensoleillé, nuageux, pluie</li>
                                <li><strong>Vent :</strong> Intensité et direction</li>
                                <li><strong>Température :</strong> De l\'air et de l\'eau</li>
                                <li><strong>Notes :</strong> Observations personnelles</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Conseils utiles</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Enregistrez la sortie même si vous ne pêchez rien - les données sont toujours utiles</li>
                                <li>Vous pouvez ajouter les prises pendant ou après la sortie</li>
                                <li>Les conditions météo aident à comprendre les schémas de pêche</li>
                                <li>Utilisez les notes pour vous souvenir des appâts efficaces ou techniques utilisées</li>
                            </ul>
                        </div>
                    </div>'
                ],
                'order' => 2
            ],
            
            [
                'section_key' => 'catches',
                'title' => [
                    'it' => 'Come Documentare le Catture',
                    'en' => 'How to Document Catches',
                    'de' => 'Wie man Fänge dokumentiert',
                    'fr' => 'Comment Documenter les Prises'
                ],
                'content' => [
                    'it' => '<div class="space-y-6">
                        <p class="text-lg">Documentare le catture è essenziale per analizzare i tuoi progressi e migliorare le tecniche. Ecco la procedura completa:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Passo 1: Accesso alle Catture</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Dalle uscite: Clicca su un\'uscita e poi "Aggiungi Cattura"</li>
                                <li>Menu principale: Vai a "Le Mie Catture" → "Nuova Cattura"</li>
                                <li>Dashboard: Usa il pulsante rapido "Aggiungi Cattura"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">🐟 Passo 2: Specie del Pesce</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Ricerca intelligente:</strong> Inizia a digitare il nome della specie</li>
                                <li><strong>Database completo:</strong> Oltre 100 specie di pesci italiani</li>
                                <li><strong>Specie personalizzata:</strong> Se non trovi la specie, puoi aggiungerla</li>
                                <li><strong>Suggerimenti:</strong> Il sistema suggerisce specie simili</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">📏 Passo 3: Misure e Peso</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Peso:</strong> In grammi o chilogrammi (conversione automatica)</li>
                                <li><strong>Lunghezza:</strong> In centimetri (opzionale ma consigliata)</li>
                                <li><strong>Validazione:</strong> Il sistema controlla misure ragionevoli per la specie</li>
                                <li><strong>Statistiche:</strong> Peso e lunghezza sono usate per i record personali</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🎣 Passo 4: Dettagli della Cattura</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Esca utilizzata:</strong> Tipo di esca che ha attirato il pesce</li>
                                <li><strong>Metodo di pesca:</strong> Spinning, surfcasting, bolognese, etc.</li>
                                <li><strong>Ora della cattura:</strong> Momento esatto (importante per i pattern)</li>
                                <li><strong>Rilasciato:</strong> Indica se hai rilasciato il pesce</li>
                            </ul>
                        </div>
                        
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-red-900 dark:text-red-100 mb-2">📸 Passo 5: Foto (Opzionale)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Upload foto:</strong> Aggiungi foto della cattura per ricordo</li>
                                <li><strong>Formato supportati:</strong> JPG, PNG, WebP</li>
                                <li><strong>Compressione automatica:</strong> Le foto vengono ottimizzate</li>
                                <li><strong>Privacy:</strong> Le foto sono visibili solo a te (se profilo privato)</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Suggerimenti per Catture Efficaci</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Documenta anche i pesci piccoli - aiutano a capire l\'attività</li>
                                <li>Aggiungi sempre l\'esca usata per future reference</li>
                                <li>L\'orario è cruciale per identificare i momenti migliori</li>
                                <li>Le note possono includere condizioni specifiche del momento</li>
                                <li>Registra anche i pesci rilasciati per statistiche complete</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'en' => '<div class="space-y-6">
                        <p class="text-lg">Documenting catches is essential for analyzing your progress and improving techniques. Here\'s the complete procedure:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Step 1: Access Catches</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>From trips: Click on a trip and then "Add Catch"</li>
                                <li>Main menu: Go to "My Catches" → "New Catch"</li>
                                <li>Dashboard: Use the quick button "Add Catch"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">🐟 Step 2: Fish Species</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Smart search:</strong> Start typing the species name</li>
                                <li><strong>Complete database:</strong> Over 100 Italian fish species</li>
                                <li><strong>Custom species:</strong> If you don\'t find the species, you can add it</li>
                                <li><strong>Suggestions:</strong> The system suggests similar species</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">📏 Step 3: Measurements and Weight</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Weight:</strong> In grams or kilograms (automatic conversion)</li>
                                <li><strong>Length:</strong> In centimeters (optional but recommended)</li>
                                <li><strong>Validation:</strong> System checks reasonable measurements for species</li>
                                <li><strong>Statistics:</strong> Weight and length are used for personal records</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🎣 Step 4: Catch Details</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Bait used:</strong> Type of bait that attracted the fish</li>
                                <li><strong>Fishing method:</strong> Spinning, surfcasting, float fishing, etc.</li>
                                <li><strong>Catch time:</strong> Exact moment (important for patterns)</li>
                                <li><strong>Released:</strong> Indicate if you released the fish</li>
                            </ul>
                        </div>
                        
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-red-900 dark:text-red-100 mb-2">📸 Step 5: Photos (Optional)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Photo upload:</strong> Add catch photos for memories</li>
                                <li><strong>Supported formats:</strong> JPG, PNG, WebP</li>
                                <li><strong>Automatic compression:</strong> Photos are optimized</li>
                                <li><strong>Privacy:</strong> Photos are visible only to you (if private profile)</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Tips for Effective Catch Recording</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Document even small fish - they help understand activity</li>
                                <li>Always add the bait used for future reference</li>
                                <li>Timing is crucial for identifying the best moments</li>
                                <li>Notes can include specific conditions of the moment</li>
                                <li>Record released fish too for complete statistics</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'de' => '<div class="space-y-6">
                        <p class="text-lg">Das Dokumentieren von Fängen ist wesentlich für die Analyse Ihres Fortschritts und die Verbesserung der Techniken. Hier ist das komplette Verfahren:</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Schritt 1: Zugang zu Fängen</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Von Ausflügen: Klicken Sie auf einen Ausflug und dann "Fang hinzufügen"</li>
                                <li>Hauptmenü: Gehen Sie zu "Meine Fänge" → "Neuer Fang"</li>
                                <li>Dashboard: Verwenden Sie die Schnelltaste "Fang hinzufügen"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">🐟 Schritt 2: Fischart</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Intelligente Suche:</strong> Beginnen Sie mit der Eingabe des Artnamens</li>
                                <li><strong>Vollständige Datenbank:</strong> Über 100 italienische Fischarten</li>
                                <li><strong>Benutzerdefinierte Art:</strong> Wenn Sie die Art nicht finden, können Sie sie hinzufügen</li>
                                <li><strong>Vorschläge:</strong> Das System schlägt ähnliche Arten vor</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">📏 Schritt 3: Maße und Gewicht</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Gewicht:</strong> In Gramm oder Kilogramm (automatische Umrechnung)</li>
                                <li><strong>Länge:</strong> In Zentimetern (optional aber empfohlen)</li>
                                <li><strong>Validierung:</strong> System prüft vernünftige Maße für die Art</li>
                                <li><strong>Statistiken:</strong> Gewicht und Länge werden für persönliche Rekorde verwendet</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🎣 Schritt 4: Fangdetails</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Verwendeter Köder:</strong> Art des Köders, der den Fisch angelockt hat</li>
                                <li><strong>Angelmethode:</strong> Spinning, Brandungsangeln, Posenfischen, etc.</li>
                                <li><strong>Fangzeit:</strong> Genauer Moment (wichtig für Muster)</li>
                                <li><strong>Freigelassen:</strong> Geben Sie an, ob Sie den Fisch freigelassen haben</li>
                            </ul>
                        </div>
                        
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-red-900 dark:text-red-100 mb-2">📸 Schritt 5: Fotos (Optional)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Foto-Upload:</strong> Fügen Sie Fangfotos für Erinnerungen hinzu</li>
                                <li><strong>Unterstützte Formate:</strong> JPG, PNG, WebP</li>
                                <li><strong>Automatische Komprimierung:</strong> Fotos werden optimiert</li>
                                <li><strong>Privatsphäre:</strong> Fotos sind nur für Sie sichtbar (bei privatem Profil)</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Tipps für effektive Fangaufzeichnung</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Dokumentieren Sie auch kleine Fische - sie helfen, Aktivität zu verstehen</li>
                                <li>Fügen Sie immer den verwendeten Köder für zukünftige Referenz hinzu</li>
                                <li>Das Timing ist entscheidend für die Identifizierung der besten Momente</li>
                                <li>Notizen können spezifische Bedingungen des Moments enthalten</li>
                                <li>Zeichnen Sie auch freigelassene Fische für vollständige Statistiken auf</li>
                            </ul>
                        </div>
                    </div>',
                    
                    'fr' => '<div class="space-y-6">
                        <p class="text-lg">Documenter les prises est essentiel pour analyser vos progrès et améliorer les techniques. Voici la procédure complète :</p>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">🎯 Étape 1 : Accès aux prises</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Depuis les sorties : Cliquez sur une sortie puis "Ajouter Prise"</li>
                                <li>Menu principal : Allez à "Mes Prises" → "Nouvelle Prise"</li>
                                <li>Tableau de bord : Utilisez le bouton rapide "Ajouter Prise"</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">🐟 Étape 2 : Espèce de poisson</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Recherche intelligente :</strong> Commencez à taper le nom de l\'espèce</li>
                                <li><strong>Base de données complète :</strong> Plus de 100 espèces de poissons italiens</li>
                                <li><strong>Espèce personnalisée :</strong> Si vous ne trouvez pas l\'espèce, vous pouvez l\'ajouter</li>
                                <li><strong>Suggestions :</strong> Le système suggère des espèces similaires</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">📏 Étape 3 : Mesures et poids</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Poids :</strong> En grammes ou kilogrammes (conversion automatique)</li>
                                <li><strong>Longueur :</strong> En centimètres (optionnel mais recommandé)</li>
                                <li><strong>Validation :</strong> Le système vérifie des mesures raisonnables pour l\'espèce</li>
                                <li><strong>Statistiques :</strong> Le poids et la longueur sont utilisés pour les records personnels</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">🎣 Étape 4 : Détails de la prise</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Appât utilisé :</strong> Type d\'appât qui a attiré le poisson</li>
                                <li><strong>Méthode de pêche :</strong> Spinning, surf-casting, pêche au flotteur, etc.</li>
                                <li><strong>Heure de la prise :</strong> Moment exact (important pour les schémas)</li>
                                <li><strong>Relâché :</strong> Indiquez si vous avez relâché le poisson</li>
                            </ul>
                        </div>
                        
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-red-900 dark:text-red-100 mb-2">📸 Étape 5 : Photos (Optionnel)</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Upload photo :</strong> Ajoutez des photos de prise pour les souvenirs</li>
                                <li><strong>Formats supportés :</strong> JPG, PNG, WebP</li>
                                <li><strong>Compression automatique :</strong> Les photos sont optimisées</li>
                                <li><strong>Confidentialité :</strong> Les photos ne sont visibles que par vous (si profil privé)</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-yellow-900 dark:text-yellow-100 mb-2">💡 Conseils pour un enregistrement efficace des prises</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Documentez même les petits poissons - ils aident à comprendre l\'activité</li>
                                <li>Ajoutez toujours l\'appât utilisé pour référence future</li>
                                <li>Le timing est crucial pour identifier les meilleurs moments</li>
                                <li>Les notes peuvent inclure des conditions spécifiques du moment</li>
                                <li>Enregistrez aussi les poissons relâchés pour des statistiques complètes</li>
                            </ul>
                        </div>
                    </div>'
                ],
                'order' => 3
            ]
        ];

        foreach ($instructions as $instruction) {
            Instruction::create($instruction);
        }
    }
}
