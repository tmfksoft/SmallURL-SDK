SmallURL-SDK
============
The one-stop-shop for the SmallURL SDKS!


What is this REPO for!?
=======================
This repo houses some quick start 'SDKs' for SmallURL to help you get a SmallURL implementation up and running quickly without doing the work of dealing with the api. This Repo aims to contain different SDKS in different languages.

Whats here now?
===============
SmallURL PHP SDK - Created by SmallURL
SmallURL Python SDK - Created by sorch/theholder <support@sorch.info>

How do I add my own?
====================
You can drop us an Email with a link to your SDK to Support@SmallURL.in!
If it follows the guidelines and works we'll add it!

What Guidelines?
================
All SDK's must follow our API Spec.
It's pretty simple to deal with.
The API requires you to tell it what ACTION you want to deal with, it requires you to submit a KEY when required.
For an SDK to also make it into the Public REPO it MUST deal with API Replies properly, That is the standard RES and MSG from the API.
RES is either TRUE / 1 or FALSE / 0, MSG will return an Error Message when a task could not be completed.

The API replies in different Formats but MUST be talked to Via a POST or GET request with normal HTTP/URL Params.
The following reply formats are supported:

 - PHP Serialized Data
 - JSON (Best for Javascript)
 - XML (Probably best if you want to store URLS Flat File without doing anything fancy!)
 - SIMPLE (Our own little format, well its not hard to make)

You tell SmallURL what you want back via the TYPE Parameter.

The SIMPLE Reply
================
It's SIMPLE!
You can use the PHP Explode function to deal with it. Or even mIRC (Yes we added this for mIRC and other simplistic systems)

Data is returned like so:

res=false|msg=The URL was not supplied.

That's all there is to it!


Enjoy!
The SmallURL Team
