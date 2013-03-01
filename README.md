Contao Extension: EfgExtendedInserttags
=======================================

Provides additional insert tags for efg stored forms. 


Installation
------------

The extension is not published in contao extension repository. Install it manually.


Tracker
-------

https://github.com/cliffparnitzky/EfgExtendedInserttags/issues


Compatibility
-------------

- min. version: Contao 2.9.5
- max. version: Contao 2.11.x


Dependency
----------

- This extension is dependent on the following extensions: [[efg]](http://contao.org/de/extension-list/view/efg.de.html)


Configuration
-------------

Activate using extended insert tags for a form and define an insert tag key and the field that should be used to identify a record.


Usage
-----

Use this insert tags with the following syntax `{{efgext::<INSERTTAG-KEY>::<FORM-METHOD>::<FIELD-NAME>}}`, eg:

~~~~
{{efgext::customer::get::name}} ... This tag will be replaced with the name of a customer from a special form.
{{efgext::document::post::title}} ... This tag will be replaced with the title of a document from a special form.
~~~~