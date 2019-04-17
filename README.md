# acc-sync

Je PHP knihovna pro propojení účetního / skladového systému
([Pohoda](https://www.pohoda.cz/) a [FlexiBee](https://www.flexibee.eu/))
a webové aplikace.

V knihovně je zakomponováno rozšíření pro [Nette framework](https://nette.org/).

## Instalace
#### 1. Nejdříve knihovnu naistalujeme do projektu pomocí [composeru](https://getcomposer.org/).

    composer require soukupm/acc-sync

#### 2. Po té v vytvoříme instanci požadovaného konektoru.

##### 2.1 Pohoda

###### 2.1.1 Factory

    new PohodaConnectionFactory(baseUri, username, password, companyId, port = null);

###### 2.1.2 Parametry

- **baseUri** - URL na kterou se bude systém připojovat, tento parametr je povinný
- **username** - Uživatelské jméno, kterým se přihlašuje do programu (systému), tento parametr je povinný
- **password** - Heslo, kterým se přihlašuje do programu (systému), tento parametr je povinný (může být prázdný)
- **companyId** - IČO firmy, tento parametr je povinný
- **port** - Číslo portu, na kterém program (systém běží), tento parametr je nepovinný

###### 2.1.3 Nette extension 
    extensions:
        pohoda: AccSync\Pohoda\PohodaConnectionExtension
        
    pohoda:
        baseUri: 'http://localhost'
        username: '@'
        password: ''
        companyId: '12345678'
        port: 1111
##### 2.2 FlexiBee
###### 2.2.1 Factory

    new FlexiBeeConnectionFactory(baseUri, username, password, companyId, port = null);
    
###### 2.2.2 Parametry

- **baseUri** - URL na kterou se bude systém připojovat, tento parametr je povinný
- **username** - Uživatelské jméno, kterým se přihlašuje do programu (systému), tento parametr je povinný
- **password** - Heslo, kterým se přihlašuje do programu (systému), tento parametr je povinný (může být prázdný)
- **companyId** - Identifikátor firmy (např. https://demo.flexibee.eu/c/demo_sk/cenik zde je unikátní identifikátor `demo_sk`), tento parametr je povinný
- **port** - Číslo portu, na kterém program (systém běží), tento parametr je nepovinný

###### 2.2.3 Nette extension 
    extensions:
        flexibee: AccSync\FlexiBee\FlexiBeeConnectionExtension
        
    flexibee:
        baseUri: 'https://demo.flexibee.eu'
        username: 'winstrom'
        password: 'winstrom'
        companyId: 'demo_sk'
        port: null