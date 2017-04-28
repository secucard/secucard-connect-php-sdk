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

## [1.3.1] - 2017-04-28

### Fixed
- Get default User-Agent



## [1.3.0] - 2017-04-26

### Security

### Deprecated
- Pass an array for API client configuration in the constructor of the class "SecucardConnect" is deprecated.

### Added
- "User-Agent" for our statistic diagnostics
- "Accept-Language" for define the language of the error messages

### Changed
- API client configuration is now an object.

### Fixed

### Removed



## [1.2.0] - 2017-03-01 [YANKED]
Not published



## [1.1.2] - 2017-01-09
Commit-ID: 7c69043

### Changed
- Fix push service for ident service



## [1.1.1] - 2017-01-18
Commit-ID: 5fa107d

###Added
- Provider to Services.IdentRequest



## [1.1.0] - 2016-12-06
Commit-ID: 7ac3ee6

###Added
- Credit card payment



## [1.0.9] - 2016-11-29
Commit-ID: 7daf776

### Changed
- Fix fatal on cancel request



## [1.0.8] - 2016-11-29
Commit-ID: 562487e

### Changed
- Fix fatal on delete request
- Set a default value for the optional contract id param
- FIX fatal on cancel payment call




## [1.0.7] - 2016-11-23
Commit-ID: 4f6f80f

### Added
- Basket
- Invoice payment



## [1.0.6] - 2016-10-14
Commit-ID: 9fdcc06

### Added
- Basket
- Invoice payment

### Changed
- readme file

### Removed
- composer.lock file

## [1.0.5] - 2016-04-29
Commit-ID: 57989cc

### Added
- X-Action header support.

### Changed
- Add payment transaction constants.
- Removed unused model fields for payment.



## [1.0.4] - 2016-04-28
Commit-ID: 3d8185e

### Added
- Add expire time to JSON token export.

### Removed
- Remove deprecated fields "payment_requested", "payment_executed"



## [1.0.3] - 2016-04-21
Commit-ID: 7202f07

### Changed
- unknown



## [1.0.2] - 2016-04-20
Commit-ID: f08127f

### Changed
- Readme



## [1.0.1] - 2016-04-06
Commit-ID: c8923d5

###Added
- Client method for getting token JSON for JS usage.



## [1.0.0] - 2016-03-12
Commit-ID: 61d5f43

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
-  	Breaking: Introduce separate args for vendor and ids in device creden…
      
      …tials.
-  	Breaking: Upgrade libraries (Guzzle etc.), implement list scrolling, …
  
  …some refactoring.
- Add new basic service methods für actions, refactor JSON de/e…
    
    …ncoding.
- Naming corrections.
- Enable stream caching with file storage.
- Add test for storage.
- Refactor smart transactions.
-  Refactor services.
- Fix exception
- Enhance class finding method for services and resources.
- Make some classes final, improve client context.
- Some corrections and enabling response post processing by use…
  
  …r callback.
- Improve services product, support downloadable attachments.
- Fix resource meta data sampling.
- Fix POST requests and add model property filtering for JSON. …
  
  …Extend transaction model.
- Better API error message.


## [0.1.3] - 2015-10-15
Commit-ID: 17cc357

### Changed
- Correctly implemented processPush method for handling pushes



## [0.1.2] - 2015-09-22
Commit-ID: d40c9d4

### Changed
- Fix updating and deleting Models



## [0.1.1] - 2015-08-05
Commit-ID: c241859

### Added
- Added const to model Smart/Transactions

### Changed
- Rename packagist to secucard/secucard-connect



## [0.1.0] - 2015-08-04
Commit-ID: 9035f25

### Added
- Receipts for Smart/Transactions

### Changed
- Updated event.pushes object structure



## [0.0.5] - 2015-07-03
Commit-ID: 9bfdc86

### Changed
- Fix creation of Secupaydebits



## [0.0.4] - 2015-07-03
Commit-ID: 2bbec34

### Added
- "Payment" product

### Changed
- Removed invalid ids from tests



## [0.0.3] - 2015-05-13
Commit-ID: a2be050

### Added
- "Smart" product

### changed
- Updated Services/Ident* model



## [0.0.2] - 2015-02-04
Commit-ID: 5b5eb23

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
Commit-ID: 787f4fa
First release