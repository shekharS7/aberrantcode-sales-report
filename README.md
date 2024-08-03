# Module BmsIndia Report


### Type 1: Zip file

 - Unzip the zip file in `app/code/AberrantCode`
 - Enable the module by running `php bin/magento module:enable AberrantCode_SalesReport`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Compile by running `php bin/magento setup:di:compile`
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer
```
- Install the module composer by running `composer require aberrantcode/sales-report`
- Apply database updates by running `php bin/magento setup:upgrade`
- Compile by running `php bin/magento setup:di:compile`



## Configuration
    Product attribute Product Category created with Label A,B,C,D . First assign Some product with different 
    product category values. Then You have to place some order for updated product.  For testing perpose you can
    change the created_at to  past date (like 2023-05-01) from today date (2024-05-04)


## Specifications
    Menu 
    Content -> AberrantCode -> Report
    BMS India Report table will display for forcast Sales report
    number of product = number of line item with quantity



## Attributes

 - Product - Product Category (product_category)
 - product_category

## NOTE:
I encountered some challenges with my laptop as it is not compatible for Magento2 development , 
so I had to complete all tasks on a cloud server. Unfortunately, this meant that I was unable to perform the 
phpcodesniffer test and some unit tests due to issues such as "Config file allure/allure.config.php doesn't exist."
    Magento Version :  "2.4.6-p3"
	Php Version: 8.1.26
	
## Pending Task
Use a color gradient where red indicates fewer sales (lower numbers) and green indicates more sales
(higher numbers).
Due to time constraints not able to complete

## Screenshot
    Images include inside module folder(Report)
