# Contribution or overriding
Are welcome. To add a new provider just add a new Handler (which extends AbstractHandler). Then implement the chunk
upload and progress.

1. Fork the project.
2. Create your bugfix/feature branch and write your (try well-commented) code.
3. Commit your changes (and your tests) and push to your branch.
4. Create a new pull request against this package's `master` branch.

## Pull Requests

- **Use the [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).**
  The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).

- **Consider our release cycle.**  We try to follow [SemVer v2.0.0](http://semver.org/). 

- **Document any change in behaviour.**  Make sure the `README.md` and any other relevant 
  documentation are kept up-to-date.

- **Create feature branches.**  Don't ask us to pull from your master branch.

- **One pull request per feature.**  If you want to do more than one thing, send multiple pull requests.
  
**Thank you!**

## Running test

* For running live test, just create `.env` with your credentials set
* To test your credentials run `PingLiveTest`
* To test import, comment `return` statement in `ImportLiveTest` 
* To test custom field create-request, comment `return` statement in `CreateRequestLiveTest` 

## Quick guide

* Create Request in same namespace concept `SmartEmailing\v3\Request\Module\Request`.
* For large module, create a wrapper that will create the requests
* For a request logic, just extend `AbstractRequest`
* To send data (json or body) use the options() method that you need to implement (see Import.php)

### Module example

```php

class Contacts {
    /**
     * @var Api
     */
    private $api;

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
    
    public function lists() {
        return $this->listsRequest()->send();
    }
    
    public function listsRequest() {
        return new ListRequest($this->api);
    }
    
    public function get($id) {
        return $this->getRequest($id)->send();
    }
    
    ....
}
```

