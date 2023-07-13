<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Review;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'vote' => 4,
                'description' => "Ho provato una cena deliziosa in questo ristorante grazie al loro sito web. Le immagini dei piatti mi hanno fatto venire l'acquolina in bocca e la prenotazione online è stata facile. Un'ottima esperienza gastronomica!",
                'name' => 'Marco',
                'surname' => 'Rossi',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 5,
                'description' => "Style Chic è diventato il mio punto di riferimento per lo shopping di abbigliamento di tendenza. Il sito web offre una vasta selezione di capi di qualità e il processo di acquisto è semplice e veloce.",
                'name' => 'Sofia',
                'surname' => 'Bianchi',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 4.5,
                'description' => "Travel Explorer mi ha aiutato a organizzare una vacanza indimenticabile. Le informazioni dettagliate sui luoghi da visitare e le opzioni di prenotazione degli hotel hanno reso tutto molto comodo.",
                'name' => 'Luca',
                'surname' => 'Esposito',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 4,
                'description' => "Capture Moments ha presentato una collezione di fotografie stupefacenti. Ho apprezzato l'interfaccia intuitiva del sito e la possibilità di acquistare stampe di alta qualità per decorare la mia casa.",
                'name' => 'Martina',
                'surname' => 'Conti',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 5,
                'description' => "FitZone è un sito web fantastico per il fitness. Le guide dettagliate degli esercizi e i programmi personalizzati mi hanno aiutato a raggiungere i miei obiettivi. Consigliatissimo!",
                'name' => 'Andrea',
                'surname' => 'Russo',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 4.5,
                'description' => "Melody Masters ha una vasta libreria musicale. Ho trovato facilmente i brani che volevo ascoltare grazie alla loro funzione di ricerca avanzata. Buona qualità audio e navigazione fluida.",
                'name' => 'Valentina',
                'surname' => 'Ferri',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 5,
                'description' => "SmartDeals è un'ottima piattaforma per fare acquisti online. Ho trovato prezzi convenienti e una vasta gamma di prodotti. La spedizione è stata veloce e il servizio clienti eccellente.",
                'name' => 'Giorgio',
                'surname' => 'Marini',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 4,
                'description' => "NewsFlash è il mio quotidiano online preferito. Offre una copertura completa e tempestiva delle notizie di attualità. Mi tiene sempre aggiornato su tutto ciò che succede nel mondo.",
                'name' => 'Alessia',
                'surname' => 'De Luca',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 4.5,
                'description' => "Knowledge Hub è un tesoro di conoscenza. I loro corsi ben strutturati e le risorse educative mi hanno aiutato a imparare nuove competenze in modo efficace. Un'ottima piattaforma per l'apprendimento.",
                'name' => 'Matteo',
                'surname' => 'Moretti',
                'date' => "2022-06-02"
            ],
            [
                'vote' => 5,
                'description' => "ArtGallery Online è un paradiso per gli amanti dell'arte. Le opere d'arte esposte sono straordinarie e l'opzione di acquistare capolavori unici è fantastica. Un sito web che ispira.",
                'name' => 'Giulia',
                'surname' => 'Romano',
                'date' => "2022-06-02"
            ]
        ];


        foreach ($reviews as $elem) {

            $new_review = new Review();

            $new_review->vote = $elem['vote'];
            $new_review->description = $elem['description'];
            $new_review->name = $elem['name'];
            $new_review->surname = $elem['surname'];
            $new_review->date = $elem['date'];

            $new_review->save();
        }
    }
}
