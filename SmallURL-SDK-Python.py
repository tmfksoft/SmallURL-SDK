################################################################
# File: smallurl.py
# Title: smallurl.in lib
# Author: sorch/theholder <support@sorch.info>
# Version: 0.1
# Description:
#  A simple module to get/create short urls
################################################################

################################################################
# License
################################################################
# Copyright 2013 Contributing Authors
# This program is distributed under the terms of the GNU GPL.
#################################################################


import requests
import json

def smallurl(dom, key):
	"""Make the shortened url"""
	try:
		d = requests.get("http://api.smallurl.in/?action=shorten&type=json&url=%s&key=%s&anon=false" % (dom, key)).json()
		if d["res"]:
			return d["short"]
		else:
			return d["msg"]
	except:
		return None

def sinspect(dom, key):
	"""Inspect the url"""
	try:
		d  = requests.get("http://api.smallurl.in/?action=inspect&short=%s&key=%s" % (dom, key).json()
		if d["res"]:
			date = d["date"]
			user = d["user"]
			t = d["private"]
			url = d["url"]
			return [date, user, t, url]
		else:
			return d["msg"]
	except:
		return None