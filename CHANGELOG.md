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


## [1.27.0] - 2024-09-10
[1.27.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.26.0...1.27.0

### Added
- General.ContractsService: new method `updateBankAccount()`


## [1.26.0] - 2023-06-22

### Deprecated
- Payment.Model.TransferAccount: deprecated the `account_owner`, `accountnumber` and `bankcode` parameter

### Added
- Payment.PaymentService.capture(): added `additional_data` parameter (optional)
- Payment.Model.Transaction: added `shop`, `shopversion` and `moduleversion` parameter
- Payment.Model.TransferAccount: added `owner` and `bankname` parameter

### Removed
- removed debug log `'Using config: '`


## [1.25.0] - 2023-01-24

### Changed
- renamed parameter `amount` in `\SecucardConnect\Product\Payment\Service\PaymentService::cancel()` to `reduce_amount_by` (logic unchanged)
- renamed parameter `amount` in `\SecucardConnect\Product\Payment\TransactionsService::cancel()` to `reduce_amount_by` (*BREAKING* logic for invoice payment transactions changed: The given value in `reduce_amount_by` will deduct the payment by this value (like for other payment methods/endpoints before) and not be the new total amount).


## [1.24.0] - 2023-01-10

### Changed
- support `psr/log` up to version `3.x`
- support `netresearch/jsonmapper` version `4.x`
- some autocorrections for possible PHP 8.2 warnings

### Removed
- dropped support for PHP `5.6`, `7.0`, `7.1`, `7.2` and `7.3`
- dropped support `netresearch/jsonmapper` version `1.x` and `2.x`


## [1.23.0] - 2022-12-05

### Added
Function to check the live transaction status:
- `\SecucardConnect\Product\Payment\TransactionsService::checkStatus()`

### Changed
- New structure of `Payment.Model.CrowdFundingData`


## [1.22.0] - 2021-06-11

### Added
- General.ContractsService: new method `revokeAccrual()`
- Payment.ContractsService: new method `revokeAccrual()`

### Changed
- Adjusted response handling to support empty HTTP responses like `204 No Content`


## [1.21.0] - 2021-03-10

### Added
- Payment.Model.Transaction: added `demo` parameter
- Payment.Model.CrowdFundingDataProject: added `sofort` parameter
- Payment.Model.CreateSubContractRequest: added `payout_purpose` parameter
- Payment.ContractsService.createSubContract: added `contract_id` parameter (optional)

### Changed
- Smart.TransactionsService.prepare: removed transaction type validation (to support new payment methods)

### Fixed
- Payment.ContractsService.getPaymentMethods was not working

### Removed
- removed unused `GetCreditCardDataRequest` class


## [1.20.0] - 2020-09-30

### Security
- Dependency updates (for PHP 7 environments)


## [1.19.0] - 2020-09-08

### Added
- added `src/SecucardConnect/Product/Smart/Model/BaseDeliveryOptions.php ` class
- added `src/SecucardConnect/Product/Smart/Model/DeliveryOptionsCollection.php` class
- added `src/SecucardConnect/Product/Smart/Model/DeliveryOptionsShipping.php` class
- added `src/SecucardConnect/Product/Smart/Model/DeliveryOptionsTimeSlot.php` class
- `src/SecucardConnect/Product/Smart/Model/Transaction.php` added `delivery_options` property
- `src/SecucardConnect/Product/Smart/Model/Transaction.php` added `setDeliveryOptions` method

### Changed
- changed `src/SecucardConnect/Product/Smart/Model/DeliveryOptionsTimeSlot.php` const `ORDER_OPTION_COLLECTION` into `DELIVERY_OPTIONS_COLLECTION`
- changed `src/SecucardConnect/Product/Smart/Model/DeliveryOptionsTimeSlot.php` const `ORDER_OPTION_SHIPPING` into `DELIVERY_OPTIONS_SHIPPING`

### Removed
- removed `src/SecucardConnect/Product/General/Model/BaseDeliveryConfiguration.php` class
- removed `src/SecucardConnect/Product/General/Model/CheckoutOptions.php` class
- removed `src/SecucardConnect/Product/General/Model/CollectionDeliveryConfiguration.php` class
- removed `src/SecucardConnect/Product/General/Model/ShippingDeliveryConfiguration.php` class
- removed `src/SecucardConnect/Product/General/Model/OrderOptions.php` class
- removed `src/SecucardConnect/Product/Smart/Model/PickupOptions.php` class
- `src/SecucardConnect/Product/General/Model/Merchant.php` removed `order_options` and `checkout_options` properties
- `src/SecucardConnect/Product/Smart/Model/Transaction.php` removed `order_option` and `pickup_options` properties

## [1.18.0] - 2020-06-24

### Added
- Added `MissingParamsError` exception, which extends the `ApiError`
- Payment.TransactionsService: added `cancel` method
- Payment.TransactionsService: added `assignPayment` method
- Payment.TransactionsService: added `capture` method
- Payment.TransactionsService: added `updateBasket` method
- Payment.TransactionsService: added `reverseAccrual` method
- Payment.TransactionsService: added `setShippingInformation` method

### Changed
- Added small input validation to `Payment.TransactionsService` and `Payment.PaymentService` to avoid API errors.

### Removed
- Removed unused method `Payment.PaymentService.initSubsequent`
- Removed unused method `Payment.PaymentService.updateSubscription`

## [1.17.1] - 2020-06-02

### Added
- Smart.Transaction-Model: added new status constants

## [1.17.0] - 2020-05-08

### Added
- Twint integration

## [1.16.0] - 2020-04-27

### Changed
- Moving background image to another location

## [1.15.0] - 2020-03-26

### Removed
- ContainerService: removed method getCreditCardContainer

## [1.14.1] - 2020-03-13

### Added
- Payment Links model: added general link

## [1.14.0] - 2020-03-04

### Added
- General Contracts service: new method getPaymentWizardOptions()
- New type PaymentWizardContractOptions which contains Payment Wizard options configured in the contract
- New Type PaymentWizardLocalOptions which contains Payment Wizard options configured in the Smart Transaction
- Application Context model: new field iframe_opts

## [1.13.11] - 2020-02-14

### Added
- Smart Transaction Model: added new public field payment_links to have access to them inside Smart Checkout backend

## [1.13.10] - 2020-02-13

### Added
- General Merchants Model: new field checkout_options
- New type CheckoutOptions which contains Smart Checkout options for given merchant

## [1.13.9] - 2020-02-11

### Removed
- Smart Transaction Model: public field payment_links

## [1.13.8] - 2020-01-29

### Added
- Smart Transaction Model: added new public field payment_links to have access to them inside Smart Checkout backend

## [1.13.7] - 2020-01-16

### Added
- Smart Transaction Model: added new field application_context which contains values previously held in checkout_links and is_customer_readonly

### Removed
- Checkout Links Model: removed fields url_success, url_error and url_abort
- Smart Transaction Model: removed is_customer_readonly field

## [1.13.6] - 2020-01-09

### Added
- Smart Transaction Model: added new public field (intent) and constants for possible values

## [1.13.5] - 2019-09-18

### Fixed
- Smart Transaction Service: fixed abort() and cancel() function

## [1.13.4] - 2019-09-17

### Added
- Smart Transaction Service: added abort() function

## [1.13.3] - 2019-07-30

### Added
- Smart Transaction Model: added new constant for cancelled status

### Fixed
- Smart Transaction Service: cancel() function now works correctly

## [1.13.2] - 2019-07-29

### Added
- Smart Transaction Model: added new public fields (is_customer_readonly, shipping_address)

## [1.13.1] - 2019-07-11

### Added
- Smart Transaction: new field $container


## [1.13.0] - 2019-06-14

### Added
- Payment Payout: new parameters in the models "SecupayPayout" and "PayoutTransaction"

### Changed
- extend the Smart-Checkout models:
  - General/Model/BaseDeliveryConfiguration.php
  - General/Model/CollectionDeliveryConfiguration.php 
  - General/Model/Merchant.php
  - General/Model/OrderOptions.php 
  - General/Model/ShippingDeliveryConfiguration.php
  - General/Model/Store.php
  - Smart/Model/Basket.php 
  - Smart/Model/PickupOptions.php
  - Smart/Model/Product.php


## [1.12.2] - 2019-06-11

### Fixed
- Payment Invoice: add missing transfer_account & transfer_purpose response parameter


## [1.12.1] - 2019-04-25

### Added
- Transaction: new const CHECKOUT_LAST_VISITED_PAGE_PAYPAL_CHECKOUT


## [1.12.0] - 2019-03-04

### Added
- Product Payment: TransactionsService::assignPayment($paymentId, $accountingId)


## [1.11.2] - 2019-02-18

### Added
- Smart Transaction model: new field customer


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
[1.7.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/v1.7.0...1.7.1
[1.8.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.7.1...1.8.0
[1.9.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.8.0...1.9.0
[1.9.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.0...1.9.1
[1.9.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.1...1.9.2
[1.9.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.2...1.9.3
[1.9.4]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.3...1.9.4
[1.9.5]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.4...1.9.5
[1.10.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.9.5...1.10.0
[1.10.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.10.0...1.10.1
[1.11.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.10.1...1.11.0
[1.11.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.11.0...1.11.1
[1.11.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.11.1...1.11.2
[1.12.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.11.2...1.12.0
[1.12.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.12.0...1.12.1
[1.12.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.12.1...1.12.2
[1.13.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.12.2...1.13.0
[1.13.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.0...1.13.1
[1.13.2]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.1...1.13.2
[1.13.3]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.2...1.13.3
[1.13.4]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.3...1.13.4
[1.13.5]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.4...1.13.5
[1.13.6]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.5...1.13.6
[1.13.7]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.6...1.13.7
[1.13.8]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.7...1.13.8
[1.13.9]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.8...1.13.9
[1.13.10]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.9...1.13.10
[1.13.11]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.10...1.13.11
[1.14.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.13.11...1.14.0
[1.14.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.14.0...1.14.1
[1.15.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.14.1...1.15.0
[1.16.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.15.0...1.16.0
[1.17.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.16.0...1.17.0
[1.17.1]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.17.0...1.17.1
[1.18.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.17.1...1.18.0
[1.19.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.18.0...1.19.0
[1.20.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.19.0...1.20.0
[1.21.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.20.0...1.21.0
[1.22.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.21.0...1.22.0
[1.23.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.22.0...1.23.0
[1.24.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.23.0...1.24.0
[1.25.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.24.0...1.25.0
[1.26.0]:https://github.com/secucard/secucard-connect-php-sdk/compare/1.25.0...1.26.0
