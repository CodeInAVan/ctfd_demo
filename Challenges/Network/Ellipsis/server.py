import socket
import os
from _thread import *

ServerSocket = socket.socket()
host = "0.0.0.0"
port = 80
ThreadCount = 0
size = 1024

try:
    ServerSocket.bind((host, port))
except socket.error as e:
    print(str(e))

print("[+] Server started!")
ServerSocket.listen(5)

password = "whataverylongandannoyingpasswordtowinthischallenge"


def threaded_client(client):
    client.send(b"Welcome to the final challenge!\n")
    client.send(b"Please enter the password: ")
    client.settimeout(10)
    try:
        data = str(client.recv(size), encoding="utf-8").replace("\n", "")
        if data:
            count = 0
            fail = False
            print("[#] Attempt: " + str(data))
            if str(data) == str(password):
                print("[!] Someone got it!")
                client.send(b"flag{I_h0pe_y0u_autom4T3d_Th1s}\n")
                client.close()
            while count < len(password) and count < len(data):
                if str(data[count]) == str(password[count]):
                    client.send(b".")
                else:
                    fail = True
                count = count + 1
            if fail or len(data) > len(password):
                client.send(b"Wrong\n")
                client.close()
    except socket.timeout:
        client.send(b"Too Slow\n")
        client.close()


while True:
    Client, address = ServerSocket.accept()
    start_new_thread(threaded_client, (Client,))
    ThreadCount += 1
ServerSocket.close()
