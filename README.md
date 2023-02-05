
# MamateamCeleste

Il sito del MamateamCeleste è un sito vetrina del suddetto team che si occupa di pubbliche relazioni per diverse discoteche nella provincia di Ancona.
All'interno vengono pubblicati tutti i futuri eventi di queste discoteche con tutti i relativi dettagli.

E' un'applicazione web multipagina sviluppata in Laravel, un framework PHP che gestisce l'applicazione secondo un pattern MVC.



La homepage è una semplice pagina in cui vengono visualizzati gli eventi futuri, la storia del team e i contatti di diversi responsabili della zona.


## Installazione

Per installare l'applicazione clonare o copiare i file in un qualsiasi ambiente di sviluppo (es. [XAMPP](https://www.apachefriends.org/it/index.html))

Dopodichè esegui il comando :

```bash
  composer update
```

In seguito è necessario creare un file _.env_ che conterrà tutte le variabili di ambiente dell'applicazione.
In particolare andranno modificate le variabili:
* DB_CONNECTION
* DB_HOST
* DB_PORT
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD
Inserendo il tipo di connessione e le credenziali di accesso al database di prova che andrà creato nell'ambiente di sviluppo.

Successivamente eseguire i comandi:
```bash
  php artisan migrate

  php artisan db:seed
```
che effettuerà le _migration_ delle tabelle necessarie nel database e le popolerà con dei dati di esempio già preimpostati e modificabili.

Infine, per avviare il server di sviluppo integrato di Laravel, eseguire il comando:
```bash
  php artisan serve
```
e cliccare sul link mostrato nel terminale.