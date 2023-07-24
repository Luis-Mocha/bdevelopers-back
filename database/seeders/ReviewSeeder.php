<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Review;

// implemento Faker
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $reviews_old = [
        //     [
        //         'vote' => 4,
        //         'description' => "Ho provato una cena deliziosa in questo ristorante grazie al loro sito web. Le immagini dei piatti mi hanno fatto venire l'acquolina in bocca e la prenotazione online è stata facile. Un'ottima esperienza gastronomica!",
        //         'name' => 'Marco',
        //         'surname' => 'Rossi',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 5,
        //         'description' => "Style Chic è diventato il mio punto di riferimento per lo shopping di abbigliamento di tendenza. Il sito web offre una vasta selezione di capi di qualità e il processo di acquisto è semplice e veloce.",
        //         'name' => 'Sofia',
        //         'surname' => 'Bianchi',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 4.5,
        //         'description' => "Travel Explorer mi ha aiutato a organizzare una vacanza indimenticabile. Le informazioni dettagliate sui luoghi da visitare e le opzioni di prenotazione degli hotel hanno reso tutto molto comodo.",
        //         'name' => 'Luca',
        //         'surname' => 'Esposito',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 4,
        //         'description' => "Capture Moments ha presentato una collezione di fotografie stupefacenti. Ho apprezzato l'interfaccia intuitiva del sito e la possibilità di acquistare stampe di alta qualità per decorare la mia casa.",
        //         'name' => 'Martina',
        //         'surname' => 'Conti',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 5,
        //         'description' => "FitZone è un sito web fantastico per il fitness. Le guide dettagliate degli esercizi e i programmi personalizzati mi hanno aiutato a raggiungere i miei obiettivi. Consigliatissimo!",
        //         'name' => 'Andrea',
        //         'surname' => 'Russo',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 4.5,
        //         'description' => "Melody Masters ha una vasta libreria musicale. Ho trovato facilmente i brani che volevo ascoltare grazie alla loro funzione di ricerca avanzata. Buona qualità audio e navigazione fluida.",
        //         'name' => 'Valentina',
        //         'surname' => 'Ferri',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 5,
        //         'description' => "SmartDeals è un'ottima piattaforma per fare acquisti online. Ho trovato prezzi convenienti e una vasta gamma di prodotti. La spedizione è stata veloce e il servizio clienti eccellente.",
        //         'name' => 'Giorgio',
        //         'surname' => 'Marini',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 4,
        //         'description' => "NewsFlash è il mio quotidiano online preferito. Offre una copertura completa e tempestiva delle notizie di attualità. Mi tiene sempre aggiornato su tutto ciò che succede nel mondo.",
        //         'name' => 'Alessia',
        //         'surname' => 'De Luca',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 4.5,
        //         'description' => "Knowledge Hub è un tesoro di conoscenza. I loro corsi ben strutturati e le risorse educative mi hanno aiutato a imparare nuove competenze in modo efficace. Un'ottima piattaforma per l'apprendimento.",
        //         'name' => 'Matteo',
        //         'surname' => 'Moretti',
        //         'date' => "2022-06-02"
        //     ],
        //     [
        //         'vote' => 5,
        //         'description' => "ArtGallery Online è un paradiso per gli amanti dell'arte. Le opere d'arte esposte sono straordinarie e l'opzione di acquistare capolavori unici è fantastica. Un sito web che ispira.",
        //         'name' => 'Giulia',
        //         'surname' => 'Romano',
        //         'date' => "2022-06-02"
        //     ]
        // ];


        $reviews = [
            [
                'description' => "CodeMaster è un'esperienza di apprendimento eccezionale per i programmatori. I loro progetti pratici e le sfide di programmazione mi hanno aiutato a migliorare le mie competenze di sviluppo web in modo significativo. Consigliato a tutti gli aspiranti sviluppatori.",
                'name' => 'Alessio',
                'surname' => 'Bianchi',
            ],
            [
                'description' => "WebGuru è il miglior corso di sviluppo web che abbia mai seguito. Le lezioni ben strutturate e l'approccio pratico mi hanno permesso di acquisire una solida comprensione delle tecnologie web moderne. Grande supporto della community anche!",
                'name' => 'Francesca',
                'surname' => 'Rossi',
            ],
            [
                'description' => "SitoWebFacile è fantastico per i principianti nello sviluppo web. Ho imparato a costruire il mio sito web personale senza problemi. L'interfaccia utente intuitiva e le istruzioni passo-passo hanno reso tutto facile e divertente.",
                'name' => 'Luca',
                'surname' => 'Verdi',
            ],
            [
                'description' => "FrontEndPro è una piattaforma ideale per chi vuole specializzarsi nello sviluppo front-end. Ho imparato le ultime tecniche di HTML, CSS e JavaScript, e ora sono in grado di creare interfacce utente straordinarie.",
                'name' => 'Martina',
                'surname' => 'Ferrari',
            ],
            [
                'description' => "BackEndWizard è il corso perfetto per diventare un esperto di sviluppo back-end. Grazie a loro, ho imparato a creare applicazioni web robuste e sicure utilizzando le tecnologie più recenti.",
                'name' => 'Andrea',
                'surname' => 'Rinaldi',
            ],
            [
                'description' => "WebDesignMastery mi ha aiutato a perfezionare le mie abilità di progettazione web. Ho imparato a creare layout accattivanti e responsive che catturano l'attenzione degli utenti. Un ottimo corso per aspiranti web designer.",
                'name' => 'Greta',
                'surname' => 'Esposito',
            ],
            [
                'description' => "FullStackNinja è un'ottima scuola per diventare uno sviluppatore full-stack. Ho imparato a lavorare sia con il front-end che con il back-end, permettendomi di creare applicazioni web complete da zero.",
                'name' => 'Leonardo',
                'surname' => 'Conti',
            ],
            [
                'description' => "JavaScriptMagic è un corso di approfondimento su JavaScript che mi ha aiutato a sbloccare tutto il potenziale di questo linguaggio. Ora posso creare animazioni, interazioni e funzionalità avanzate con facilità.",
                'name' => 'Camilla',
                'surname' => 'Galli',
            ],
            [
                'description' => "NodeMasters mi ha fatto scoprire il mondo di Node.js e del server-side JavaScript. Ora posso costruire applicazioni scalabili e ad alte prestazioni lato server senza problemi.",
                'name' => 'Lorenzo',
                'surname' => 'Marino',
            ],
            [
                'description' => "VueVibes è il corso perfetto per diventare un esperto di Vue.js. Le sue funzionalità intuitive e le prestazioni eccezionali mi hanno conquistato. Grazie a VueVibes, posso creare interfacce reattive e moderne.",
                'name' => 'Vittoria',
                'surname' => 'Galli',
            ],
            [
                'description' => "ReactMastery è il modo migliore per imparare React. Ora posso creare componenti riutilizzabili e costruire interfacce utente dinamiche e performanti. Grazie per questa esperienza di apprendimento fantastica!",
                'name' => 'Tommaso',
                'surname' => 'Romano',
            ],
            [
                'description' => "AngularGenius mi ha fatto innamorare di Angular. Le sue caratteristiche complete e il sistema di moduli mi hanno permesso di costruire applicazioni complesse con facilità.",
                'name' => 'Anna',
                'surname' => 'Fontana',
            ],
            [
                'description' => "TypeScriptMagic è un corso essenziale per chi lavora con TypeScript. Ora posso scrivere codice più sicuro e mantenibile, aumentando la mia produttività come sviluppatore.",
                'name' => 'Davide',
                'surname' => 'Bianco',
            ],
            [
                'description' => "PythonWebGenius mi ha introdotto al mondo dello sviluppo web con Python. Ora posso creare applicazioni web potenti utilizzando i framework Python più popolari.",
                'name' => 'Sofia',
                'surname' => 'Conti',
            ],
            [
                'description' => "RubyOnWeb è un corso completo per imparare a sviluppare applicazioni web con Ruby. Grazie a loro, ora posso creare siti web eleganti e performanti utilizzando Ruby on Rails.",
                'name' => 'Gabriele',
                'surname' => 'Rossi',
            ],
            [
                'description' => "PHPPro è il corso definitivo per diventare un esperto di sviluppo web con PHP. Le lezioni ben strutturate e i progetti pratici mi hanno fatto acquisire fiducia nel mio codice.",
                'name' => 'Caterina',
                'surname' => 'Greco',
            ],
            [
                'description' => "SQLWizard mi ha insegnato le sfumature del linguaggio SQL per l'interazione con i database. Ora posso scrivere query complesse e gestire i dati con precisione.",
                'name' => 'Emanuele',
                'surname' => 'Gatti',
            ],
            [
                'description' => "JavaJourney mi ha aiutato a diventare un programmatore Java competente. Ora posso sviluppare applicazioni robuste e scalabili utilizzando le migliori pratiche di programmazione.",
                'name' => 'Elisa',
                'surname' => 'Ricci',
            ],
            [
                'description' => "CSSMagic è un corso completo per padroneggiare CSS. Ora posso creare layout eleganti e stilizzati con facilità, migliorando l'aspetto delle mie pagine web.",
                'name' => 'Giacomo',
                'surname' => 'Lombardi',
            ],
            [
                'description' => "RubyRocks mi ha permesso di imparare Ruby in modo efficace. Grazie a loro, posso sviluppare applicazioni web creative e flessibili.",
                'name' => 'Serena',
                'surname' => 'Marini',
            ],
            [
                'description' => "BootstrapNinja mi ha trasformato in un esperto di Bootstrap. Ora posso creare interfacce responsive e moderne con facilità, risparmiando tempo prezioso nello sviluppo.",
                'name' => 'Mattia',
                'surname' => 'Rizzo',
            ],
            [
                'description' => "WordPressWizards è un'ottima guida per diventare un professionista di WordPress. Ora posso costruire siti web eleganti e funzionali senza problemi.",
                'name' => 'Aurora',
                'surname' => 'Greco',
            ],
            [
                'description' => "PHPWizard mi ha aiutato a migliorare le mie competenze di sviluppo web PHP. Ora posso costruire applicazioni web dinamiche e interattive con fiducia.",
                'name' => 'Filippo',
                'surname' => 'Marchetti',
            ],
            [
                'description' => "CSharpMastery mi ha fatto innamorare di C#. Ora posso sviluppare applicazioni Windows e web sofisticate utilizzando questo potente linguaggio di programmazione.",
                'name' => 'Giorgia',
                'surname' => 'Gatti',
            ],
            [
                'description' => "JavaWebPro è una piattaforma di apprendimento straordinaria per diventare uno sviluppatore Java web. Ora posso costruire applicazioni web scalabili e performanti.",
                'name' => 'Pietro',
                'surname' => 'Conti',
            ],
            [
                'description' => "CSSNinja mi ha aiutato a padroneggiare CSS. Ora posso creare stili unici e creativi per i miei siti web, dando loro un aspetto straordinario.",
                'name' => 'Beatrice',
                'surname' => 'Ferrari',
            ],
            [
                'description' => "RubyGenius mi ha insegnato le basi di Ruby e del framework Rails. Ora posso costruire applicazioni web flessibili e dinamiche.",
                'name' => 'Simone',
                'surname' => 'Bianchi',
            ],
            [
                'description' => "PythonMagic è un corso eccezionale per imparare Python. Ora posso sviluppare applicazioni web, script e strumenti con questo linguaggio potente.",
                'name' => 'Laura',
                'surname' => 'Romano',
            ],
            [
                'description' => "PHPWebGenius mi ha fatto innamorare dello sviluppo web con PHP. Ora posso creare siti web completi e funzionali utilizzando questo linguaggio versatile.",
                'name' => 'Dario',
                'surname' => 'Ricci',
            ],
            [
                'description' => "JavaScriptPro è un corso avanzato su JavaScript. Ora posso sviluppare applicazioni web interattive e complesse con competenza.",
                'name' => 'Ludovica',
                'surname' => 'Esposito',
            ],
            [
                'description' => "ReactGenius mi ha permesso di imparare React in modo semplice e chiaro. Ora posso costruire interfacce utente reattive e performanti con facilità.",
                'name' => 'Federico',
                'surname' => 'Marini',
            ],
            [
                'description' => "AngularPro è un corso completo per diventare un esperto di Angular. Ora posso sviluppare applicazioni web sofisticate e complesse.",
                'name' => 'Chiara',
                'surname' => 'Rossi',
            ],
            [
                'description' => "TypeScriptNinja mi ha fatto scoprire il mondo di TypeScript. Ora posso scrivere codice TypeScript robusto e manutenibile.",
                'name' => 'Marco',
                'surname' => 'Fontana',
            ],
            [
                'description' => "PythonPro è un corso essenziale per diventare uno sviluppatore Python. Ora posso costruire applicazioni web e soluzioni software con Python.",
                'name' => 'Elena',
                'surname' => 'Gallo',
            ],
        ];


        foreach ($reviews as $elem) {

            $new_review = new Review();

            $new_review->profile_id = $faker->numberBetween(1, 4);
            $new_review->vote = $faker->numberBetween(1, 5);
            $new_review->description = $elem['description'];
            $new_review->name = $elem['name'];
            $new_review->surname = $elem['surname'];
            $new_review->date = $faker->date();

            $new_review->save();
        }
    }
}
