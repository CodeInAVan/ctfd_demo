#!/usr/bin/env python

"""
A simple echo server
"""

import socket
import random
import itertools
import time

host = '0.0.0.0'
port = 80
backlog = 5
size = 1024
password = "smalldetails\n"
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
s.bind((host,port))
s.listen(backlog)
while 1:
	client, address = s.accept()
	client.send("======== Accessing Mainframe System ======:\n")
	client.send("You require level 1 access:\n")
	client.send("Please enter the password: ")
	client.settimeout(60)
	try:
		data = client.recv(size)
		if(data):
			for pass_letter,input_letter in itertools.izip(password,str(data)):
				if pass_letter == input_letter:
					time.sleep(1)
				else:
					client.send("Incorrect Password!\n")
					client.close()
			client.send("Correct Password!\n")
			client.send("Level 1 access granted, here is your flag{i_h4t3_th1s_ch4ll3ng3}!\n")
			client.close()
	except socket.timeout:
		client.send("Too Slow\n")
		client.close() 		
