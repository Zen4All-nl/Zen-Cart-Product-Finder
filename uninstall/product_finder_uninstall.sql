DELETE FROM admin_pages WHERE page_key='configProductFinder' LIMIT 1;
DELETE FROM configuration WHERE configuration_key LIKE 'PRODUCT_FINDER_%';
DELETE FROM configuration_group WHERE configuration_group_title = 'Product Finder Settings' LIMIT 1;