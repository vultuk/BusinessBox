# BusinessBox
Integration with Business in a Box API

## Implementation

### Creating an Encryption object
```
$encrypt = new Encrypt(
   '123456789',
   '123456789123456789123456789123456789123456789123456789',
)
```

### Creating a client
```
$client = Client::create([
    'title' => 'Mr',
    'first_name' => 'Bill',
    'surname' => 'Webber',
    'house_number' => '123',
    'address' => Client::combineAddress('123 Test Road', 'Testville', 'Testerton'),
    'postcode' => 'TE5 7ER',
    'telephone_no' => '01234567890',
]);
```

### Creating a product
```
$pensionProduct = Pension::create([
    'reference' => '1234567',
    'would_you_like_a_review' => 'Yes',
    'is_currently_drawing_down' => 'No',
    'estimated_pension_value' => 15000,
    'provider_name' => 'Some Pension Co',
]);
```

### Creating an appointment
```
$appointment = Appointment::create([
    new Carbon('2015-11-01 09:20'),
    'Knock Loudly'
]);
```

### Submitting to the remote API
```
$result = Remote::request(
    $client,
    $pensionProduct,
    $appointment,
    'test-api/echo',
    'http://www.myurl.com/',
    $encrypt
);
```
