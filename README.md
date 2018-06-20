# Flexibee client
Base and straightforward client for communication with Flexibee API.

#### Basic usage
```php
use FlexibeeClient\FlexibeeClient;
use FlexibeeClient\Registry;
use DateTime;

// Create new client
$client = new FlexibeeClient($host, $company, $username, $password);

// Every registry can be reached via
$registry = $client->registry(Registry::TYPE_ORDER_IN);
$registry2 = $client->registry('dodavatelska-smlouva');

// Possible calls from https://www.flexibee.eu/api/dokumentace/ref/urls
$result = $registry->callProperties();
$result = $registry->callReports();
$result = $registry->callCount();
$result = $registry->callRelations();
$result = $registry->callRelations(500, 'polozkyDokladu');
$result = $registry->callDetail(500);
$result = $registry->callCreate([
    'kod' => 'myCode12',
    'datVyst' => (new DateTime())->format('c'),
    'typDokl' => 'code:OBP'
]);
$result = $registry->callUpdate(500, [
    'kod' => 'myCode123',
    'datVyst' => (new DateTime())->format('c')
]);

// All properties listed at https://www.flexibee.eu/api/dokumentace/ref/urls can be used via methods
$registry->setDryRun()->setReportLang('sk'); ...

// If you want to remove property you can use
$registry->setDryRun(null);

// Everytime you call registry() method via client you get new clean instance of Registry.
```
Client **don't throw exceptions** from callXXX() methods. Everytime return <code>Result</code> class.
This class can be used like:

```php
$result = $registry->callDetail(500);
if (!$result->isOk()) {
    // some error handling code ...
}

$orderData = $result->getData()['objednavka-prijata'][0];
$orderData['id']; // Access to data
```

In base implementation only JSON format is supported. If you need any other format from https://www.flexibee.eu/api/dokumentace/ref/format-types you can implement new Result class and
register into ResultFactory. Base JSON Result implementation is in class FlexibeeClient\Result\JsonResult.