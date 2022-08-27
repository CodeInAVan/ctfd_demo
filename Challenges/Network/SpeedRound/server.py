#!/usr/bin/env python

"""
A simple echo server
"""

import socket
import random

host = '0.0.0.0'
port = 10001
backlog = 5
size = 1024
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
s.bind((host,port))
s.listen(backlog)
while 1:
	client, address = s.accept()
	check = random.random()
	client.send("Please send this back to me:\n")
	client.send(str(check))
	client.send("\n")
	client.settimeout(0.1)
	try:
		data = client.recv(size)
		if(data):
			if (str(data) == str(check)):
				client.send("flag{Pr0g4mm1ng_1s_t3H_w4Y_4w4rd}\n")
				client.close()
			else:
				client.send("Wrong\n")
				client.close()
	except socket.timeout:
		client.send("Too Slow\n")
		client.close() 		
