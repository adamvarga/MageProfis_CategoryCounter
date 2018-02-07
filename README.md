MageProfis_CategoryCounter
=====================
- The consideration of the count is always related to the last 7 days. Cronjob saves the value and sorted the categorie teasers in the frontend by attribute 'Category sort position'. 
- Then once a week the complete mp_categorycounter_views table is deleted, in order to create a new order can.
- You can influence the click numbers. If you would like to push a category, you can adjust it accordingly under the Category Administration / Category Sorting Tab / at Category sort position attribute. 
  The higher the number, the higher the teaser on the category page is pushed on top.

Installation Instructions
-------------------------
1. Install the module MageProfis_ChidlrenCategories https://github.com/remiebeling/MageProfis_ChildrenCategories
2. Match the collection with ->addAttributeToSort('category_position_custom', 'desc') in Children.php from ChildrenCategories Modul (With Rewrite!)
3. Install the MageProfis_CategoryCounter extension via GitHub, and deploy with modman.
4. Clear the cache, reindex all, logout from the admin panel and then login again.

Uninstallation
--------------
1. Remove all extension files from your Magento installation OR
2. Modman remove MageProfis_CategoryCounter & modman clean

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/adamvarga).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Adam Varga

