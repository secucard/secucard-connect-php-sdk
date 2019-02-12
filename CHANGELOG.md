# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased] - YYYY-MM-DD

### Security

### Deprecated

### Added

### Changed

### Fixed

### Removed

## [1.11.1] - 2019-01-28

### Added
- Smart Transaction model: new field checkout_links

## [1.11.0] - 2019-01-11

### Added
- Product Payment: UploadidentsService
- Product Payment: TransactionsService


## [1.10.1] - 2019-01-07

### Added
- Smart Transaction Service: new variable to allow PayPal payments
- Product Payment: Contract-ID parameter for the "capture" and "updateBasket" methods.


## [1.10.0] - 2018-12-21

### Added
- Product Payment: Sofort


## [1.9.5] - 2018-12-14

### Fixed
- Address Model: fixed typehint for the $geometry field


## [1.9.4] - 2018-11-07

### Added
- Smart Transaction Service: new variable to allow prepaid payments


## [1.9.3] - 2018-10-19

### Added
- Smart Transaction Service: new variable to allow invoice payments


## [1.9.2] - 2018-10-12

### Fixed
- Smart.Transaction: contract model
- Setting the storage


## [1.9.1] - 2018-10-02

### Fixed
- Allows the creation of nested directories in FileStorage


## [1.9.0] - 2018-09-17

### Added
- Methods and Models for our new "Smart-Checkout"

### Changed
- Update dependencies


## [1.8.0] - 2018-06-12

### Added
- Product Payment: Method to get a list of activated payment methods

### Changed
- Product Payment: Return type of cancel call changed from BOOL to ARRAY!

### Fixed
- Product Payment: setShippingInformation was not working correctly


## [1.7.1] - 2018-04-20

### Added
- Product Payment: Add missing basket item type "coupon"


## [1.7.0] - 2018-01-10

### Added
- Product Payment: Add payout methods
- Possibility to change the language of the payment iframe.
- Possibility to customize some labels of the payment iframe.


## [1.6.1] - 2017-11-17

### Added
- Added missing param "url_push" to the payment model for "redirect_url"


## [1.6.0] - 2017-11-03

### Added
- SEPA mandate into response of payment container creation

### Changed
- Moved CloneParams into separate file
- Moved TransferAccount into separate file


## [1.5.1] - 2017-09-18

### Changed
- Improved code style
- ApiError: parameter description
- ProductService: improved HTTP exception handling
- ProductService: moved RequestOps, RequestOptions, RequestParams and SearchParams to a separate file


## [1.5.0] - 2017-09-01

### Added
- TransactionService: type of transactions
- IdentService: getCardInfo method
- Product Ident: types of login
- MerchantCardService: validateCSC
- MerchantCardService: validatePasscode
- CardGroupService: checkPasscodeEnabled
- Product CardGroup: type of transactions
- Product MerchantCard: status of passcode


## [1.4.1] - 2017-06-06

### Fixed
- Wrong exception for optional parameters "JSON property must not be NULL".


## [1.4.0] - 2017-05-30

### Added
- PaymentService: refund method
- PaymentService: capture method
- PaymentService: updateBasket method
- PaymentService: reverseAccrual method
- PaymentService: initSubsequent method
- PaymentService: setShippingInformation method
- PaymentService: updateSubscription method
- Product Document: UploadsService
- Product Service: IdentCasesService

### Changed
- Updated dependency "guzzle" to ~6.2
- Updated dependency "jsonmapper" to ~1.1

### Fixed
- PHP 5.5 incompatibility (const array)
- Wrong parent class of class RedirectUrl
- PSR-2 Coding Style conformance

### Removed
- Removed tests, because the need to be reworked
- Remove development dependency "phpunit"


## [1.3.1] - 2017-04-28

### Fixed
- Get default User-Agent


## [1.3.0] - 2017-04-26 [YANKED]

### Deprecated
- Pass an array for API client configuration in the constructor of the class "SecucardConnect" is deprecated.

### Added
- "User-Agent" for our statistic diagnostics
- "Accept-Language" for define the language of the error messages
- Possibility to create individual sub-contracts
- Possibility to use old "apikey" from the flex.API into the basket
- Add attribute "merchant customer id" to the customer data
- Add possibility to send customer experience statistics
- Add IframeOptData and OptData for customize the checkout page
- Add possibility to get the used payment instrument data for a successful payment
- Add possibility to change the redirect urls for each request
- Add supporting of subscriptions
- Add supporting of pre-authorize payments
- Add delivery address (recipient)
- Add payment method "capture"

### Changed
- The API Client Configuration can now be filled by an object instead of an array. Setting the config as array is deprecated.


## [1.2.0] - 2017-03-01 [YANKED]
Not published


## [1.1.2] - 2017-01-09

### Changed
- Fix push service for ident service


## [1.1.1] - 2017-01-18

###Added
- Provider to Services.IdentRequest


## [1.1.0] - 2016-12-06

###Added
- Credit card payment


## [1.0.9] - 2016-11-29

### Changed
- Fix fatal on cancel request


## [1.0.8] - 2016-11-29

### Changed
- Fix fatal on delete request
- Set a default value for the optional contract id param
- FIX fatal on cancel payment call


## [1.0.7] - 2016-11-23

### Added
- Basket
- Invoice payment


## [1.0.6] - 2016-10-14

### Added
- Basket
- Invoice payment

### Changed
- readme file

### Removed
- composer.lock file


## [1.0.5] - 2016-04-29

### Added
- X-Action header support.

### Changed
- Add payment transaction constants.
- Removed unused model fields for payment.


## [1.0.4] - 2016-04-28

### Added
- Add expire time to JSON token export.

### Removed
- Remove deprecated fields "payment_requested", "payment_executed"


## [1.0.3] - 2016-04-21

### Changed
- unknown


## [1.0.2] - 2016-04-20

### Changed
- Readme


## [1.0.1] - 2016-04-06

###Added
- Client method for getting token JSON for JS usage.


## [1.0.0] - 2016-03-12

###Added
- payment services.
- Add field sepa_mandate_inform to Payment/Contracts model
-  	New: Loyalty services
-  	New: Payment services and models
-  	New: "Services" services and models
- Add media resource support for download
- Add picture support for ident requests (person/contact)

### Changed
- Added payment.customer reference to payment.container and removed it from secupaydebits
-  	Breaking: Move all to new namespaces and directories.
-  	Breaking: Move all to new namespaces and directories. Fixing tests.
-  	Test base class auth. changed
-  	Breaking: change auth api usage, start to introduce service layer, model mapping via jsonmapper
-  	Breaking: rename general model classes (singular)
- Breaking: Smart/General/Common refactored, Auth corrections, Test corrections
-  	Update: Correct getting right resource meta data.
  	Update: Correct getting right resource meta data, ignoring case
-  	Breaking: Introduce separate args for vendor and ids in device credentials.
-  	Breaking: Upgrade libraries (Guzzle etc.), implement list scrolling, some refactoring.
- Add new basic service methods für actions, refactor JSON de/encoding.
- Naming corrections.
- Enable stream caching with file storage.
- Add test for storage.
- Refactor smart transactions.
-  Refactor services.
- Fix exception
- Enhance class finding method for services and resources.
- Make some classes final, improve client context.
- Some corrections and enabling response post processing by user callback.
- Improve services product, support downloadable attachments.
- Fix resource meta data sampling.
- Fix POST requests and add model property filtering for JSON. Extend transaction model.
- Better API error message.


## [0.1.3] - 2015-10-15

### Changed
- Correctly implemented processPush method for handling pushes


## [0.1.2] - 2015-09-22

### Changed
- Fix updating and deleting Models


## [0.1.1] - 2015-08-05

### Added
- Added const to model Smart/Transactions

### Changed
- Rename packagist to secucard/secucard-connect


## [0.1.0] - 2015-08-04

### Added
- Receipts for Smart/Transactions

### Changed
- Updated event.pushes object structure


## [0.0.5] - 2015-07-03

### Changed
- Fix creation of Secupaydebits


## [0.0.4] - 2015-07-03

### Added
- "Payment" product

### Changed
- Removed invalid ids from tests


## [0.0.3] - 2015-05-13

### Added
- "Smart" product

### changed
- Updated Services/Ident* model


## [0.0.2] - 2015-02-04

### Added
- License
- Device authorization

### Changed
- Improved basic push api
- Fix problem with Reauthorizations
- Fix BaseCollection with offset loading
- Fix count() on BaseCollection object
- Fix comments for Client.php
- Fix phpunit tests for models
- Fix comments and debug output


## [0.0.1] - 2014-11-03
First release




[0.0.1]:https://github.com/secucard/secucard-connect-php-sdk/releases/tag/v0.0.1
[0.0.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.0.1...v0.0.2
[0.0.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.0.2...v0.0.3
[0.0.4]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.0.3...v0.0.4
[0.0.5]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.0.4...v0.0.5
[0.1.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.0.5...v0.1.0
[0.1.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.1.0...v0.1.1
[0.1.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.1.1...v0.1.2
[0.1.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.1.2...v0.1.3
[1.0.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v0.1.3...v1.0.0
[1.0.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.0...v1.0.1
[1.0.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.1...v1.0.2
[1.0.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.2...v1.0.3
[1.0.4]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.3...v1.0.4
[1.0.5]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.4...v1.0.5
[1.0.6]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.5...v1.0.6
[1.0.7]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.6...v1.0.7
[1.0.8]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.7...v1.0.8
[1.0.9]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.8...v1.0.9
[1.1.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.0.9...v1.1.0
[1.1.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.1.0...v1.1.1
[1.1.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.1.1...v1.1.2
[1.3.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.1.2...v1.3.1
[1.4.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.3.1...v1.4.0
[1.4.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.4.0...v1.4.1
[1.5.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.4.1...v1.5.0
[1.5.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.5.0...v1.5.1
[1.6.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.5.1...v1.6.0
[1.6.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.6.0...v1.6.1
[1.7.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.6.1...v1.7.0
[1.7.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.7.0...v1.7.1
[1.8.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.7.1...v1.8.0
[1.9.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.8.0...v1.9.0
[1.9.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.0...v1.9.1
[1.9.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.1...v1.9.2
[1.9.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.2...v1.9.3
[1.9.4]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.3...v1.9.4
[1.9.5]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.4...v1.9.5
[1.10.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.9.5...v1.10.0
[1.10.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.10.0...v1.10.1
[1.11.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.10.1...v1.11.0
[1.11.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.11.0...v1.11.1
