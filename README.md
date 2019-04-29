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
        
#### 3. Pohoda connector

    V proměnné například $pohodaConnectionFactory je uložena instance objektu PohodaConnectionFactory
    
    Samotné připojení inicializujeme: $connection = $pohodaConnectionFactory->create();
    
    Tímto získáme instanci objetu PohodaConnector, který obsahuje metody pro práci se systémem.
    
    Nejdříve je nutné, nastavit request, který chceme do systému poslat (metody budou detailněji popsány dále)
    
        - setListStockRequest()
        - setListOrderRequest($orderType)
        - setListInvoiceRequest($invoiceType)
        - setSendStockRequest(StockCollection $stockCollection)
        - setSendOrdersRequest(OrdersCollection $ordersCollection)
        - setSendInvoiceRequest(InvoicesCollection $invoicesCollection)
        - setCustomRequest(BaseRequest $request)
    
    Po nastavení requestu ho odešleme následující metodou
    
        - sendRequest()
        
    Po odeslání requestu je ještě možné zavolat tyto metody
    
        - hasError()
        - getError()
        - getStdClassResponse()
        - getDOMResponse()
    
#### 3.1 `setListStockRequest()`
    Metoda, která získá seznam zásob, uložených v Pohoda systému
    
    Volá se $request = $connection->setListStockRequest();
    
    Nad touto metodou se dá vyvolat ještě několik dalších metod  nebo se dá request uložit do proměnné a
    nad ním poté volat tyto metody
    
- `addFilter($name, $value)`
    - Metoda odfiltruje hodnoty podle zadaných parametrů
    - `$name` - Název filteru (názvy filtrů je možné dohledat v [oficiální dokumentaci](https://www.stormware.cz/pohoda/xml/dokladyexport/#Z%C3%A1soby))
    - `$value` - Hodnota filteru
- `addFilterStorage($storage)`
    - Metoda odfiltruje hodnoty podle názvu skladové jednotky (např. ZBOŽÍ/Léčiva)
    - `$storage` - Hodnota filteru, může být buď string nebo pole
- `addFilterLastChanges(\DateTime $lastChanges)`
    - Metoda odfiltruje hodnoty podle poslední změny daných záznamů
    - `$lastChanges` - Hodnota filteru, musí být ve instance objektu \DateTime
- `addFilterStoreIds($storeIds)`
    - Metoda odfiltruje hodnoty podle ID skladu, na kterém je zásoba uložena
    - `$storeIds` - Hodnota filteru, může být buď číslo (numerický string) nebo pole
- `addFilterStoreName($storeNames)`
    - Metoda odfiltruje hodnoty podle názvu skladu, na kterém je zásoba uložena
    - `$storeNames` - Hodnota filteru, může být buď string nebo pole
    
#### 3.2 `setListOrderRequest($orderType)`
Metoda, která získá seznam objednávek, uložených v Pohoda systému

Volá se `$request = $connection->setListOrderRequest($orderType);
`
Kde $orderType je typ objednávky, typy jsou dva a jsou uloženy ve třídě
`AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest`,
konkrétně to jsou `ListOrderRequest::ORDER_TYPE_ISSUED` a `ListOrderRequest::ORDER_TYPE_RECEIVED`

Nad touto metodou se dá vyvolat ještě několik dalších metod nebo se dá request uložit do proměnné a
nad ním poté volat tyto metody
    
- `addFilter($name, $value)`
    - Metoda odfiltruje hodnoty podle zadaných parametrů
    - `$name` - Název filteru (názvy filtrů je možné dohledat v [oficiální dokumentaci](https://www.stormware.cz/pohoda/xml/dokladyexport/#Objedn%C3%A1vky))
    - `$value` - Hodnota filteru
- `addFilterDateRange($from, $to)`
    - Metoda odfiltruje hodnoty data objednávky
    - Mohou být vyplněny oba parametry, nebo pouze jeden vybraný
    - `$from` - Hodnota filteru, může být buď null nebo instance třídy \DateTime
    - `$to` - Hodnota filteru, může být buď null nebo instance třídy \DateTime
- `addFilterCompanyName($companies)`
    - Metoda odfiltruje hodnoty podle názvu společnosti, který je uveden u objednávky
    - `$companies` - Hodnota filteru, může být buď string nebo pole
- `addFilterIns($ins)`
    - Metoda odfiltruje hodnoty podle IC spolecnosti, které je uvedeno u objednávky
    - `$ins` - Hodnota filteru, může být buď string nebo pole
    
#### 3.3 `setListInvoiceRequest($invoiceType)`
Metoda, která získá seznam objednávek, uložených v Pohoda systému

Volá se `$request = $connection->setListInvoiceRequest($invoiceType);`

Kde `$invoiceType` je typ objednávky, typy jsou dva a jsou uloženy ve třídě 
`AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest`,
konkrétně to jsou `ListInvoiceRequest::INVOICE_TYPE_ISSUED` a `ListInvoiceRequest::INVOICE_TYPE_RECEIVED`

Nad touto metodou se dá vyvolat ještě několik dalších metod nebo se dá request uložit do proměnné a
nad ním poté volat tyto metody
    
- `addFilter($name, $value)`
    - Metoda odfiltruje hodnoty podle zadaných parametrů
    - `$name` - Název filteru (názvy filtrů je možné dohledat v [oficiální dokumentaci](https://www.stormware.cz/pohoda/xml/dokladyexport/#Faktury))
    - `$value` - Hodnota filteru
- `addFilterDateRange($from, $to)`
    - Metoda odfiltruje hodnoty data objednávky
    - Mohou být vyplněny oba parametry, nebo pouze jeden vybraný
    - `$from` - Hodnota filteru, může být buď null nebo instance třídy \DateTime
    - `$to` - Hodnota filteru, může být buď null nebo instance třídy \DateTime
- `addFilterCompanyName($companies)`
    - Metoda odfiltruje hodnoty podle názvu společnosti, který je uveden u objednávky
    - `$companies` - Hodnota filteru, může být buď string nebo pole
- `addFilterIns($ins)`
    - Metoda odfiltruje hodnoty podle IC spolecnosti, které je uvedeno u objednávky
    - `$ins` - Hodnota filteru, může být buď string nebo pole
    
#### 3.4 `setSendStockRequest(StockCollection $stockCollection)`
Metoda, která odešle nové položky zásob do Pohoda systému

Volá se `$request = $connection->setSendStockRequest(StockCollection $stockCollection);`

Kde `$stockCollection` obsahuje všechny nové zásoby, které chceme do systému importovat a jedná se o instanci
třídy `AccSync\Pohoda\Collection\Stock\StockCollection`

Kolekce musí být naplněna entitami typu `AccSync\Pohoda\Entity\Stock\Stock`

Entity se snaží kopírovat strukturu definovaného [requestu pro přidání zásoby](https://www.stormware.cz/xml/samples/version_2/import/Zasoby/stock_02_v2.0.xml),
ale zároveň obsahují některé položky navíc, aby bylo možné entity použít i při vrácení seznamu zásob a uložení jej
do těchto entit.

Pro odeslání requestu pro přidání zásoby je nutné vyplnit hlavičku v instanci entity `Stock::class`, hlavička je objekt
typu `AccSync\Pohoda\Entity\Stock\StockHeader`, kde už jsou jednotlivé vlastnosti nadefinované podle dokumentace.
Vlastnosti je třeba vyplnit dle dokumentace.