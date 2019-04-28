# Zen-Cart-Product-Finder

## What does this mod do?
This mod provides three drop-down select boxes which are used to select products from top category - subcat01 - subcat02 - subcat03.
The second and third drop-down are populated dynamically (using jquery) as a result of the choice made in the previous box, in my case this is used as Make-Model-Year.

The mod is designed to work with this category structure:

top-category (eg Bikes) -

sub-category level 1 (eg Bike Manufacturer) -
subsub-category level 2 (eg Bike model) -
subsubsub-category level3 (eg Bike model year or year range) - which contains the products
Each subcategory is a drop-down.
As supplied in this package, the drop drowns are integrated into the header.

## Why?
To replace a long static list in a sidebox.

## How it works on my site
I have three master categories

Manufacturers: this is arranged as per the product families from my suppliers and are the master categories for all my products.
Product Types: the normal types-of-products categories. All items here are linked from the manufacturers master.
Your Bike (of motorcycle): subcategory of bike brands, then subsub of models, then subsubsub of years (such as 2001, 2002-3, 2004 etc). All items here are linked from the manufacturers master.
This mod replaces the sidebox that would show the third set of categories.
