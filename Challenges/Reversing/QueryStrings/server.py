#!/usr/bin/env python

"""
A simple echo server
"""

import socket
import random

host = '0.0.0.0'
port = 80
backlog = 5
size = 1024
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
s.bind((host,port))
s.listen(backlog)
while 1:
	client, address = s.accept()
	client.send("Welcome to the querystrings server\n")
	client.send("Please type in the password: ")
	client.settimeout(3)
	try:
		data = client.recv(size)
		if(data):
			if (str(data) == str("rdfqus\n")):
				client.send("Congratuations, you've earned a flag{R3v3rs3_th3_Pl4n3t}\n")
				client.close()
			else:
				client.send("Incorrect Password\n")
				client.close()
	except socket.timeout:
		client.send("Too Slow\n")
		client.close() 		
