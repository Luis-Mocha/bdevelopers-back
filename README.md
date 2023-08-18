# My Developer - Back

Il progetto ***MyDeveloper*** simula una web app che permette l'interazione tra un **utente interessato** (**UI**) e uno **sviluppatore registrato** (**SR**):
- l'utente interessato ha la possibilità di cercare e contattare uno sviluppatore professionista, al fine di richiedere una consultazione o un servizio professionale. 
- lo sviluppatore registrato può creare un profilo individuale, personalizzandolo tramite la condivisione delle proprie capacità professionali e delle informazioni personali che ritiene più adatte.

Nello specico il progetto si divide nella sezione dedicata all'**UI**, il cui sviluppo è contenuto nella repository [MyDeveloper-front](https://github.com/Luis-Mocha/bdevelopers-front), e nella sezione di "back-office" dedicata allo **SR**, il cui sviluppo è contenuto in questa repository.

---

Il sito è sviluppato tramite il framework PHP **[Laravel](https://laravel.com/)** e l'implementazione di **Laravel Breeze**, per incorporare un sistema di autenticazione.

Lo sviluppatore che effettua la registrazione al sito può creare il suo *profilo sviluppatore* pubblico, inserendo dati personali, informazioni professionali utili, informazioni di contatto e collegamenti a siti o piattaforme social personali. Inoltre ha la possibilità di aggiungere una immagine di profilo e un curriculm vitae, che l'utente interessato potrà visualizzare e scaricare.
##### Tutti di dati inseriti dallo sviluppatore durante fasi di registrazione, login o modifica del profilo sono sottosposti ad una validazione server-side, oltre che client-side.

Ogni pagina è resa ***responsive*** in modo da adattarsi agli schermi di diversi dispositivi. Questo è risultato è ottenuto tramite l'utilizzo di classi responsive **Bootstrap** e di **Media Query** personalizzate.


Una volta effettutato l'accesso lo **SR** è riportato alla sua area privata dove può accedere a:
- ##### Pagina informazioni 
    - È possibile visulazzare e modificare i propri dati e contatti.
- ##### Pagina Lista Messaggi Ricevuti
- ##### Pagina Lista Recensioni Ricevute
- ##### Pagina Sponsorizzazione Profilo
    - Tramite questo pannello è possibile acquistare una sponsorizzazione
selezionando il tipo di promozione desiderata e inserendo i dettagli della carta di credito.
Il sistema di pagamento utilizzato è **[Braintree Payments](https://www.braintreepayments.com/)**. Il sistema permette agli sviluppatori di simulare pagamenti senza essere approvati formalmente e senza utilizzare vere carte di credito.